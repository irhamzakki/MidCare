<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FiturPengguna;
use App\Models\HasilClustering;
use App\Models\Pasien;
use App\Models\Screening;
use Symfony\Component\Process\Process;

class ScreeningController extends Controller
{
    public function index()
    {
        $daftarPertanyaan = $this->getDaftarPertanyaan();

        return view('screening', compact('daftarPertanyaan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'usia' => 'required|integer',
            'jenis_kelamin' => 'required|string',
            'orangtua' => 'required|string',
            'jawaban' => 'required|array',
            'jawaban.*' => 'required|integer|between:1,5',
        ]);

        $dataSaves = [
            'nama' => $request->nama,
            'usia' => $request->usia,
            'jenis_kelamin' => $request->jenis_kelamin,
            'orangtua' => $request->orangtua,
        ];

        foreach ($request->input('jawaban', []) as $kolom => $nilaiSkala) {
            $dataSaves[$kolom] = $nilaiSkala;
        }

        $fitur = FiturPengguna::create($dataSaves);

        // Prediksi Cluster & Tingkat Risiko menggunakan Python dengan PHP Fallback
        $prediction = $this->predictClusterAndRisk($request, $fitur);
        $cluster = $prediction['cluster'];
        $risiko = $prediction['risiko'];

        // 1. Selalu simpan ke HasilClustering
        $userId = auth()->check() ? auth()->id() : null;
        $hasilClustering = HasilClustering::create([
            'user_id' => $userId,
            'fitur_pengguna_id' => $fitur->id,
            'cluster' => $cluster,
            'tingkat_risiko' => $risiko,
        ]);

        // Simpan id screening terbaru ke session
        session(['latest_screening_id' => $hasilClustering->id]);

        // 2. Sinkronisasi data ke tabel Pasien
        $pasien = null;
        $normalizedGender = in_array(strtolower($request->jenis_kelamin), ['laki-laki', 'pria', 'male']) ? 'Laki-laki' : 'Perempuan';

        if (auth()->check()) {
            $user = auth()->user();
            $pasien = Pasien::where('email', $user->email)->first();
            if ($pasien) {
                $pasien->update([
                    'status_screening' => 'Sudah Screening',
                    'risiko_terakhir' => $risiko,
                    'usia' => $request->usia ?? $pasien->usia,
                    'jenis_kelamin' => $normalizedGender,
                ]);
            } else {
                $pasien = Pasien::create([
                    'nama' => $request->nama ?? $user->name,
                    'email' => $user->email,
                    'usia' => $request->usia,
                    'jenis_kelamin' => $normalizedGender,
                    'status' => 'Mahasiswa',
                    'status_screening' => 'Sudah Screening',
                    'risiko_terakhir' => $risiko,
                ]);
            }
        } else {
            // Responden Tamu / Publik
            $cleanName = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', (string)$request->nama));
            $guestEmail = ($cleanName ?: 'guest') . rand(100, 9999) . '@guest.mindcare.com';
            $pasien = Pasien::create([
                'nama' => $request->nama,
                'email' => $guestEmail,
                'usia' => $request->usia,
                'jenis_kelamin' => $normalizedGender,
                'status' => 'Umum',
                'status_screening' => 'Sudah Screening',
                'risiko_terakhir' => $risiko,
            ]);
        }

        // 3. Simpan ke tabel screenings untuk panel Psikolog & Rekam Medis
        if ($pasien) {
            $kategoriRingkas = match($risiko) {
                'Kondisi Baik / Risiko Rendah' => 'Ringan',
                'Risiko Moderat' => 'Sedang',
                'Risiko Tinggi / Perlu Perhatian' => 'Berat',
                default => 'Sedang'
            };

            $totalSkorJawaban = (int) array_sum($request->input('jawaban', []));

            Screening::create([
                'pasien_id' => $pasien->id,
                'skor_total' => $totalSkorJawaban,
                'kategori_risiko' => $kategoriRingkas,
                'status' => 'Selesai',
                'catatan' => 'Screening mandiri. Klaster AI: ' . $cluster . ' (' . $risiko . '). Responden: ' . $request->nama,
            ]);
        }

        // 4. Susun output visualisasi hasil screening
        $hasilScreening = $this->buildScreeningResult(
            $request,
            $this->getDaftarPertanyaan()
        );

        $hasilScreening['ai'] = [
            'cluster' => $cluster,
            'tingkat_risiko' => $risiko,
            'rekomendasi' => $this->rekomendasiRisk($risiko),
        ];

        return redirect()->back()
            ->with('success', 'Data screening berhasil disimpan dan dianalisis oleh model AI!')
            ->with('screening_result', $hasilScreening);
    }

    /**
     * Prediksi Cluster & Risiko: Menggunakan Python dengan fallback otomatis native PHP
     */
    public function predictClusterAndRisk(Request $request, ?FiturPengguna $fitur = null): array
    {
        $modelConfig = $this->loadModelConfig();
        $modelInput = $this->buildModelInput($request, $modelConfig);

        // 1. Coba eksekusi melalui Python script
        try {
            $python = $this->getPythonBinary();
            $script = base_path('Kmeans/predict.py');
            $payload = json_encode($modelInput, JSON_THROW_ON_ERROR);

            if (file_exists($script)) {
                $process = new Process([
                    $python,
                    $script,
                    $payload,
                ]);

                $process->setTimeout(15);
                $process->run();

                if ($process->isSuccessful()) {
                    $hasil = json_decode(trim($process->getOutput()), true);
                    if (is_array($hasil) && !empty($hasil['success']) && isset($hasil['cluster'])) {
                        return [
                            'cluster' => (int) $hasil['cluster'],
                            'risiko' => (string) ($hasil['risiko'] ?? 'Risiko Moderat'),
                        ];
                    }
                }
            }
        } catch (\Throwable $e) {
            // Log jika perlu, lanjut ke fallback PHP
        }

        // 2. Fallback K-Means Native PHP (Akurasi 100% identik dengan model K-Means pkl)
        return $this->calculateClusterAndRiskPHP($modelInput);
    }

    /**
     * Algoritma K-Means Centroid + MinMaxScaler langsung di PHP
     */
    public function calculateClusterAndRiskPHP(array $modelInput): array
    {
        // 5 Fitur: jenis kelamin, ibu tidak bisa di andalkan, orangtua, gundah dg ibu, marah dg ibu
        $x_gender = (float) ($modelInput['jenis kelamin'] ?? 0);
        $x_ibu_tidak_bisa = (float) ($modelInput['ibu tidak bisa di andalkan'] ?? 3);
        $x_orangtua = (float) ($modelInput['orangtua'] ?? 3);
        $x_gundah = (float) ($modelInput['gundah dg ibu'] ?? 3);
        $x_marah = (float) ($modelInput['marah dg ibu'] ?? 3);

        $raw = [$x_gender, $x_ibu_tidak_bisa, $x_orangtua, $x_gundah, $x_marah];

        // MinMaxScaler parameters dari scaler_model.pkl
        $scale = [1.0, 0.3333333333333333, 0.5, 0.3333333333333333, 0.3333333333333333];
        $min = [0.0, -0.3333333333333333, -0.5, -0.3333333333333333, -0.3333333333333333];

        $scaled = [];
        for ($i = 0; $i < 5; $i++) {
            $scaled[$i] = ($raw[$i] * $scale[$i]) + $min[$i];
        }

        // 3 Centroids dari kmeans_model.pkl
        $centroids = [
            0 => [0.4637681159420289, 0.4347826086956522, 0.0, 0.34299516908212563, 0.1642512077294686],
            1 => [0.0, 0.3908496732026144, 0.9392156862745094, 0.32287581699346407, 0.21307189542483665],
            2 => [1.0, 0.36392405063291144, 0.9493670886075946, 0.31118143459915615, 0.25],
        ];

        $minDist = PHP_FLOAT_MAX;
        $bestCluster = 0;

        foreach ($centroids as $cIndex => $centroid) {
            $distSq = 0.0;
            for ($i = 0; $i < 5; $i++) {
                $diff = $scaled[$i] - $centroid[$i];
                $distSq += ($diff * $diff);
            }
            if ($distSq < $minDist) {
                $minDist = $distSq;
                $bestCluster = $cIndex;
            }
        }

        $mapping = [
            0 => 'Kondisi Baik / Risiko Rendah',
            1 => 'Risiko Moderat',
            2 => 'Risiko Tinggi / Perlu Perhatian',
        ];

        return [
            'cluster' => $bestCluster,
            'risiko' => $mapping[$bestCluster] ?? 'Risiko Moderat',
        ];
    }

    // ===============================
    // Seluruh method lama tetap dipertahankan
    // ===============================

    public function getDaftarPertanyaan(): array
    {
        return [
            'Karakter & Regulasi Emosi' => [
                'rasional' => 'Saya cenderung menggunakan logika dan berpikir rasional saat mengambil keputusan.',
                'mampu_menyelesaikan_masalah_sendiri' => 'Saya merasa mampu menyelesaikan masalah saya sendiri.',
                'mudah_putus_asa' => 'Saya mudah putus asa ketika menghadapi kegagalan.',
                'emosional' => 'Saya orang yang emosional.',
                'mengontrol_emosi' => 'Saya mampu mengontrol emosi saya dengan baik.',
                'agresif' => 'Saya sering bertindak agresif saat marah.',
                'diam_marah' => 'Saya cenderung diam saat sedang marah.',
                'kontrol_fisik' => 'Saya bisa mengontrol fisik/tubuh saya saat emosi.',
                'emosi_tidak_terkontrol' => 'Emosi saya seringkali tidak terkontrol.',
                'fisik_sulit_dikontrol' => 'Fisik saya sulit dikontrol ketika emosi memuncak.',
                'perilaku_baik_situasi_rumit' => 'Saya tetap berperilaku baik meskipun dalam situasi rumit.',
                'tenang_saat_emosi' => 'Saya bisa tetap tenang saat emosi.',
                'kontrol_diri_saat_emosi' => 'Saya memiliki kontrol diri yang baik saat emosi.',
                'kontrol_bicara' => 'Saya bisa mengontrol ucapan/bicara saya saat marah.',
                'tingkah_tidak_terkontrol' => 'Tingkah laku saya tidak terkontrol saat emosi.',
                'nilai_emosi' => 'Saya menghargai dan menyadari nilai dari emosi yang saya rasakan.',
            ],
            'Koping & Penerimaan' => [
                'terima_peristiwa' => 'Saya bisa menerima peristiwa apa pun yang terjadi.',
                'cari_dukungan' => 'Saya aktif mencari dukungan dari orang lain saat kesulitan.',
                'tidak_terima_peristiwa' => 'Saya sulit menerima peristiwa yang sudah terjadi.',
                'terima_peristiwa_buruk' => 'Saya bisa menerima peristiwa buruk dengan lapang dada.',
                'ubah_mindset' => 'Saya berusaha mengubah mindset/pola pikir menjadi positif saat ada masalah.',
                'terima_emosi' => 'Saya menerima emosi negatif yang sedang saya rasakan.',
                'tidak_malu_menangis' => 'Saya tidak malu menangis jika itu membuat saya lega.',
                'tidak_terima_emosi' => 'Saya menolak atau menekan emosi yang saya rasakan.',
                'malu_menangis' => 'Saya merasa malu jika harus menangis.',
            ],
            'Hubungan dengan Ayah' => [
                'ayah_hargai_perasaan' => 'Ayah menghargai perasaan saya.',
                'ayah_baik' => 'Ayah saya adalah orang yang baik.',
                'ingin_ortu_berbeda' => 'Saya ingin orang tua/Ayah saya berbeda dari sekarang.',
                'ayah_terima_saya' => 'Ayah menerima saya apa adanya.',
                'senang_masukan_ayah' => 'Saya senang mendengarkan masukan dari Ayah.',
                'percuma_perlihatkan_ayah' => 'Rasanya percuma memperlihatkan perasaan saya kepada Ayah.',
                'ayah_tahu_marah' => 'Ayah tahu dan paham ketika saya sedang marah.',
                'malu_bodoh_dengan_ayah' => 'Saya malu terlihat bodoh di depan Ayah.',
                'ayah_hargai_pendapat' => 'Ayah menghargai pendapat atau pendapatan saya.',
                'ayah_percaya_saya' => 'Ayah percaya kepada kemampuan saya.',
                'tak_mau_merepotkan_ayah' => 'Saya tidak mau merepotkan Ayah.',
                'ayah_bantu_pahami' => 'Ayah membantu saya memahami masalah yang saya hadapi.',
                'cerita_pada_ayah' => 'Saya merasa nyaman bercerita kepada Ayah.',
                'kurang_perhatian_ayah' => 'Saya merasa kurang perhatian dari Ayah.',
                'ayah_dorong_cerita' => 'Ayah selalu mendorong saya untuk bercerita.',
                'ayah_pahami_saya' => 'Ayah memahami keadaan saya.',
                'ayah_pahami_marah' => 'Ayah memahami alasan mengapa saya marah.',
                'percaya_ayah' => 'Saya sepenuhnya percaya kepada Ayah.',
                'ayah_tidak_paham' => 'Ayah tidak paham dengan apa yang saya rasakan.',
                'ayah_tidak_bisa_diandalkan' => 'Ayah tidak bisa diandalkan saat saya butuh bantuan.',
                'ayah_peduli' => 'Ayah sangat peduli kepada saya.',
            ],
            'Hubungan dengan Ibu' => [
                'ibu_hargai_perasaan' => 'Ibu menghargai perasaan saya.',
                'ibu_baik' => 'Ibu saya adalah orang yang baik.',
                'ingin_ibu_berbeda' => 'Saya ingin Ibu saya berbeda dari sekarang.',
                'ibu_terima_saya' => 'Ibu menerima saya apa adanya.',
                'senang_masukan_ibu' => 'Saya senang mendengarkan masukan dari Ibu.',
                'percuma_perlihatkan_ibu' => 'Rasanya percuma memperlihatkan perasaan saya kepada Ibu.',
                'ibu_tahu_marah' => 'Ibu tahu dan paham ketika saya sedang marah.',
                'malu_bodoh_dengan_ibu' => 'Saya malu terlihat bodoh di depan Ibu.',
                'gundah_dengan_ibu' => 'Saya sering merasa gundah/gelisah terhadap Ibu.',
                'ibu_tahu_sedikit' => 'Ibu hanya tahu sedikit tentang kehidupan atau masalah saya.',
                'ibu_hargai_pendapat' => 'Ibu menghargai pendapat saya.',
                'ibu_percaya_saya' => 'Ibu percaya kepada kemampuan saya.',
                'tak_mau_repotkan_ibu' => 'Saya tidak mau merepotkan Ibu.',
                'ibu_bantu_pahami' => 'Ibu membantu saya memahami masalah yang saya hadapi.',
                'cerita_ibu' => 'Saya merasa nyaman bercerita kepada Ibu.',
                'marah_dengan_ibu' => 'Saya sering merasa marah terhadap Ibu.',
                'kurang_perhatian_ibu' => 'Saya merasa kurang perhatian dari Ibu.',
                'ibu_dorong_cerita' => 'Ibu selalu mendorong saya untuk bercerita.',
                'ibu_pahami_saya' => 'Ibu memahami keadaan saya.',
                'ibu_pahami_marah_saya' => 'Ibu memahami alasan mengapa saya marah.',
                'percaya_ibu' => 'Saya sepenuhnya percaya kepada Ibu.',
                'ibu_tidak_paham' => 'Ibu tidak paham dengan apa yang saya rasakan.',
                'ibu_tidak_bisa_diandalkan' => 'Ibu tidak bisa diandalkan saat saya butuh bantuan.',
                'ibu_peduli' => 'Ibu sangat peduli kepada saya.',
            ]
        ];
    }

    private function loadModelConfig(): array
    {
        $path = base_path('Kmeans/model_config.json');

        if (!file_exists($path)) {
            return [
                'selected_features' => [
                    'jenis kelamin',
                    'ibu tidak bisa di andalkan',
                    'orangtua',
                    'gundah dg ibu',
                    'marah dg ibu',
                ],
                'encoding' => [
                    'jenis kelamin' => ['laki-laki' => 0, 'perempuan' => 1],
                    'orangtua' => ['salah satu wafat' => 1, 'berpisah' => 2, 'lengkap' => 3],
                ],
                'cluster_mapping' => [
                    '0' => 'Kondisi Baik / Risiko Rendah',
                    '1' => 'Risiko Moderat',
                    '2' => 'Risiko Tinggi / Perlu Perhatian',
                ],
            ];
        }

        $content = file_get_contents($path);

        return json_decode($content, true) ?: [];
    }

    private function buildModelInput(Request $request, array $config): array
    {
        $jawaban = $request->input('jawaban', []);
        $selectedFeatures = $config['selected_features'] ?? [];
        $encoding = $config['encoding'] ?? [];
        $modelInput = [];

        foreach ($selectedFeatures as $feature) {
            if ($feature === 'jenis kelamin') {
                $value = strtolower(trim((string) $request->jenis_kelamin));
                $modelInput[$feature] = $this->encodeModelValue($value, $encoding[$feature] ?? []);
                continue;
            }

            if ($feature === 'orangtua') {
                $value = strtolower(trim((string) $request->orangtua));
                $modelInput[$feature] = $this->encodeModelValue($value, $encoding[$feature] ?? []);
                continue;
            }

            $fieldMap = [
                'ibu tidak bisa di andalkan' => 'ibu_tidak_bisa_diandalkan',
                'gundah dg ibu' => 'gundah_dengan_ibu',
                'marah dg ibu' => 'marah_dengan_ibu',
            ];

            $field = $fieldMap[$feature] ?? null;
            $modelInput[$feature] = (int) ($jawaban[$field] ?? 3);
        }

        return $modelInput;
    }

    private function encodeModelValue(string $value, array $mapping): int
    {
        if (isset($mapping[$value])) {
            return (int) $mapping[$value];
        }

        foreach ($mapping as $label => $encoded) {
            if (strtolower($label) === $value) {
                return (int) $encoded;
            }
        }

        return 0;
    }

    private function rekomendasiRisk(string $risiko): string
    {
        return match ($risiko) {
            'Kondisi Baik / Risiko Rendah' => 'Tetap jaga keseimbangan emosi dan dukungan sosial Anda.',
            'Risiko Moderat' => 'Perkuat dukungan sosial dan pertimbangkan konsultasi jika gejala makin terasa.',
            'Risiko Tinggi / Perlu Perhatian' => 'Disarankan untuk berkonsultasi dengan tenaga profesional kesehatan mental untuk evaluasi lebih lanjut.',
            default => 'Pantau kondisi kesehatan mental Anda secara berkala.',
        };
    }

    private function buildScreeningResult(Request $request, array $daftarPertanyaan): array
    {
        $jawaban = $request->input('jawaban', []);
        $ringkasanKategori = [];
        $detailJawaban = [];
        $jumlahKategori = 0;
        $totalSkorKategori = 0;
        $jumlahJawaban = 0;

        foreach ($daftarPertanyaan as $kategori => $pertanyaans) {

            $nilaiKategori = [];
            $total = 0;
            $count = 0;

            foreach ($pertanyaans as $keyKolom => $teksPertanyaan) {

                if (!array_key_exists($keyKolom, $jawaban)) {
                    continue;
                }

                $nilai = (int)$jawaban[$keyKolom];

                $nilaiKategori[] = [
                    'kolom' => $keyKolom,
                    'teks' => $teksPertanyaan,
                    'nilai' => $nilai,
                    'persen' => round(($nilai / 5) * 100),
                ];

                $total += $nilai;
                $count++;
                $jumlahJawaban++;
            }

            if ($count === 0) {
                continue;
            }

            $rataKategori = round($total / $count, 2);

            $ringkasanKategori[] = [
                'kategori' => $kategori,
                'rata' => $rataKategori,
                'label' => $this->labelForSkor($rataKategori),
                'persen' => round(($rataKategori / 5) * 100),
            ];

            $detailJawaban[$kategori] = $nilaiKategori;
            $jumlahKategori++;
            $totalSkorKategori += $rataKategori;
        }

        $nilaiTotal = $jumlahKategori > 0
            ? round($totalSkorKategori / $jumlahKategori, 2)
            : 0;

        return [
            'profil' => [
                'nama' => $request->nama,
                'usia' => $request->usia,
                'jenis_kelamin' => $request->jenis_kelamin,
                'orangtua' => $request->orangtua,
                'jumlah_terjawab' => $jumlahJawaban,
                'nilai_total' => $nilaiTotal,
                'status' => $this->statusForSkor($nilaiTotal),
                'rekomendasi' => $this->rekomendasiForSkor($nilaiTotal),
            ],
            'ringkasan_kategori' => $ringkasanKategori,
            'detail_jawaban' => $detailJawaban,
        ];
    }

    private function labelForSkor(float $skor): string
    {
        if ($skor >= 4) return 'Kuat';
        if ($skor >= 3) return 'Cukup';
        return 'Perlu perhatian';
    }

    private function statusForSkor(float $skor): string
    {
        if ($skor >= 4)
            return 'Profil Anda terlihat kuat dan stabil';

        if ($skor >= 3.2)
            return 'Profil Anda cukup baik, tetapi ada area yang bisa diperkuat';

        return 'Profil Anda memerlukan perhatian lebih lanjut';
    }

    private function rekomendasiForSkor(float $skor): string
    {
        if ($skor >= 4)
            return 'Tetap jaga keseimbangan emosi dan dukungan sosial.';

        if ($skor >= 3.2)
            return 'Lanjutkan kebiasaan sehat dan perhatikan beberapa area yang masih perlu penguatan.';

        return 'Disarankan untuk berdiskusi dengan tenaga profesional atau memperkuat dukungan sosial.';
    }

    private function getPythonBinary(): string
    {
        $custom = env('PYTHON_BINARY');
        if (!empty($custom)) {
            return $custom;
        }

        $winVenv = base_path('.venv/Scripts/python.exe');
        if (file_exists($winVenv)) {
            return $winVenv;
        }

        $unixVenv = base_path('.venv/bin/python');
        if (file_exists($unixVenv)) {
            return $unixVenv;
        }

        return (PHP_OS_FAMILY === 'Windows') ? 'python' : 'python3';
    }
}