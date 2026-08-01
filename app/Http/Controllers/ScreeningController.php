<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FiturPengguna; // Pastikan Model FiturPengguna sudah ada

class ScreeningController extends Controller
{
    // Fungsi menampilkan halaman kuesioner/screening
    public function index()
    {
        $daftarPertanyaan = $this->getDaftarPertanyaan();

        return view('screening', compact('daftarPertanyaan'));
    }

    // Fungsi menyimpan data jawaban ke database
    public function store(Request $request)
    {
        // 1. Validasi data profil dasar dan jawaban kuesioner
        $request->validate([
            'nama' => 'required|string|max:100',
            'usia' => 'required|integer',
            'jenis_kelamin' => 'required|string',
            'orangtua' => 'required|string',
            'jawaban' => 'required|array',
            'jawaban.*' => 'required|integer|between:1,5',
        ]);

        // 2. Siapkan data yang akan disimpan
        $dataSaves = [
            'nama' => $request->nama,
            'usia' => $request->usia,
            'jenis_kelamin' => $request->jenis_kelamin,
            'orangtua' => $request->orangtua,
        ];

        // 3. Gabungkan jawaban kuesioner ke dalam data penyimpanan
        foreach ($request->input('jawaban', []) as $kolom => $nilaiSkala) {
            $dataSaves[$kolom] = $nilaiSkala;
        }

        // 4. Simpan ke database
        FiturPengguna::create($dataSaves);

        $hasilScreening = $this->buildScreeningResult($request, $this->getDaftarPertanyaan());

        if (auth()->check()) {
            return redirect()->route('screening')
                ->with('success', 'Data screening berhasil disimpan! Anda dapat melihat hasil rinci di halaman Hasil.')
                ->with('screening_result', $hasilScreening);
        }

        return redirect()->route('screening')
            ->with('success', 'Data screening berhasil disimpan! Berikut hasil profiling singkat berdasarkan jawaban Anda.')
            ->with('screening_result', $hasilScreening);
    }

    private function getDaftarPertanyaan(): array
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
                'ayah_hargai_pendapat' => 'Ayah menghargai pendapat saya.',
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
            ],
        ];
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

                $nilai = (int) $jawaban[$keyKolom];
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

        $nilaiTotal = $jumlahKategori > 0 ? round($totalSkorKategori / $jumlahKategori, 2) : 0;

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
        if ($skor >= 4) {
            return 'Kuat';
        }

        if ($skor >= 3) {
            return 'Cukup';
        }

        return 'Perlu perhatian';
    }

    private function statusForSkor(float $skor): string
    {
        if ($skor >= 4) {
            return 'Profil Anda terlihat kuat dan stabil';
        }

        if ($skor >= 3.2) {
            return 'Profil Anda cukup baik, tetapi ada area yang bisa diperkuat';
        }

        return 'Profil Anda memerlukan perhatian lebih lanjut';
    }

    private function rekomendasiForSkor(float $skor): string
    {
        if ($skor >= 4) {
            return 'Tetap jaga keseimbangan emosi dan dukungan sosial.';
        }

        if ($skor >= 3.2) {
            return 'Lanjutkan kebiasaan sehat dan perhatikan beberapa area yang masih perlu penguatan.';
        }

        return 'Disarankan untuk berdiskusi dengan tenaga profesional atau memperkuat dukungan sosial.';
    }
}