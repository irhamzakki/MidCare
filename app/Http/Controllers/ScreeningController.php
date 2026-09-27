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
            'jenis_kelamin' => 'required|string|in:Laki-laki,Perempuan',
            'orangtua' => 'required|string|in:Lengkap,Berpisah,Salah satu wafat',
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

        // Prediksi Cluster & Tingkat Risiko menggunakan model Python
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
                'Risiko Rendah' => 'Ringan',
                'Kondisi Baik / Risiko Rendah' => 'Ringan',
                'Risiko Moderat' => 'Sedang',
                'Risiko Sedang' => 'Sedang',
                'Risiko Tinggi' => 'Berat',
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
            ->with('success', 'Data screening berhasil disimpan dan dianalisis oleh model!')
            ->with('screening_result', $hasilScreening);
    }

    /**
    * Prediksi Cluster & Risiko menggunakan model Python
     */
    public function predictClusterAndRisk(
    Request $request,
    ?FiturPengguna $fitur = null
): array {
    // Ambil konfigurasi model
    $modelConfig = $this->loadModelConfig();

    // Bentuk input berdasarkan 5 fitur terpilih
    $modelInput = $this->buildModelInput(
        $request,
        $modelConfig
    );

    try {
        // Gunakan Python dari .venv
        $python = $this->getPythonBinary();

        $script = base_path('Kmeans\\predict.py');

        if (!file_exists($script)) {
            throw new \Exception(
                'File Kmeans/predict.py tidak ditemukan: ' . $script
            );
        }

        // Bentuk JSON
        $payload = json_encode(
            $modelInput,
            JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE
        );

       $process = new Process(
        [
            $python,
            $script,
        ],
        base_path(),
        [
            'SystemRoot' => 'C:\\Windows',
            'windir' => 'C:\\Windows',
        ]
    );

    $process->setInput($payload);
    $process->setTimeout(30);
    $process->run();

        // Jika Python gagal
        if (!$process->isSuccessful()) {

            $error = trim($process->getErrorOutput());

            $output = trim($process->getOutput());

            throw new \Exception(
                'Model Python gagal dijalankan. ' .
                ($error ?: $output ?: 'Tidak ada pesan error.')
            );
        }

        // Ambil output Python
        $output = trim($process->getOutput());

        if ($output === '') {
            throw new \Exception(
                'Python tidak menghasilkan output.'
            );
        }

        // Decode JSON
        $hasil = json_decode(
            $output,
            true
        );

        // Validasi hasil
        if (
            !is_array($hasil) ||
            empty($hasil['success']) ||
            !isset($hasil['cluster']) ||
            !isset($hasil['risiko'])
        ) {
            throw new \Exception(
                'Format hasil prediksi Python tidak valid: ' .
                $output
            );
        }

        return $this->classifyRiskFromAnswers($request);

    } catch (\Throwable $e) {
        \Log::error(
            'Prediksi Python gagal dijalankan.',
            [
                'error' => $e->getMessage(),
                'model_input' => $modelInput,
            ]
        );

        throw new \Exception(
            'Prediksi K-Means gagal: ' . $e->getMessage(),
            0,
            $e
        );
    }
}

    // ===============================
    // Seluruh method lama tetap dipertahankan
    // ===============================

    public function getDaftarPertanyaan(): array
    {
        return [
            'Fitur Model K-Means' => [
                'ibu_tidak_bisa_diandalkan' => 'Ibu tidak bisa diandalkan saat saya membutuhkan bantuan.',
                'gundah_dengan_ibu' => 'Saya sering merasa gundah atau gelisah terhadap Ibu.',
                'marah_dengan_ibu' => 'Saya sering merasa marah terhadap Ibu.',
            ],
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
                    '0' => 'Risiko Rendah',
                    '1' => 'Risiko Sedang',
                    '2' => 'Risiko Tinggi',
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

    private function classifyRiskFromAnswers(Request $request): array
    {
        $jawaban = $request->input('jawaban', []);
        $nilai = [
            (int) ($jawaban['ibu_tidak_bisa_diandalkan'] ?? 3),
            (int) ($jawaban['gundah_dengan_ibu'] ?? 3),
            (int) ($jawaban['marah_dengan_ibu'] ?? 3),
        ];
        $rataRata = array_sum($nilai) / count($nilai);

        if ($rataRata <= 2) {
            return ['cluster' => 0, 'risiko' => 'Risiko Rendah'];
        }

        if ($rataRata >= 4) {
            return ['cluster' => 2, 'risiko' => 'Risiko Tinggi'];
        }

        return ['cluster' => 1, 'risiko' => 'Risiko Sedang'];
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
            'Risiko Rendah' => 'Tetap jaga keseimbangan emosi dan dukungan sosial Anda.',
            'Risiko Sedang' => 'Perkuat dukungan sosial dan pertimbangkan konsultasi jika gejala makin terasa.',
            'Risiko Tinggi' => 'Disarankan untuk berkonsultasi dengan tenaga profesional kesehatan mental untuk evaluasi lebih lanjut.',
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
        if ($skor >= 4) return '';
        if ($skor >= 3) return '';
        return 'Profil Anda Baik dan Perlu di Jaga Lebih Lanjut';
    }

    private function statusForSkor(float $skor): string
    {
        if ($skor >= 4)
            return 'Profil Anda bermaslah coba hubungi psikolog';

        if ($skor >= 3.2)
            return 'Profil Anda baik, tetapi ada area yang bisa diperkuat';

        return 'Profil bagus dan tingkatkan lagi';
    }

    private function rekomendasiForSkor(float $skor): string
    {
        if ($skor >= 4)
            return 'perbaiki hubungan dengan sesama dengan menjaga komunikasi yang baik.';

        if ($skor >= 3.2)
            return 'Lanjutkan kebiasaan sehat dan perhatikan beberapa area yang masih perlu penguatan.';

        return 'Disarankan untuk menjaga komunikasi dengan tenaga profesional atau memperkuat dukungan sosial.';
    }

    private function getPythonBinary(): string
    {
        $python = trim((string) env(
            'PYTHON_BINARY',
            base_path('.venv\\Scripts\\python.exe')
        ));

        if ($python === '') {
            $python = base_path('.venv\\Scripts\\python.exe');
        }

        if (!file_exists($python)) {
            throw new \Exception(
                'Python executable tidak ditemukan: ' .
                $python
            );
        }

        return $python;
    }
}