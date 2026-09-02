<?php

namespace App\Http\Controllers\Psikolog;

use App\Http\Controllers\Controller;
use App\Models\FiturPengguna;
use App\Models\Pasien;
use App\Models\Screening;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    public function index()
    {
        $pasiens = Pasien::with(['screenings' => function ($query) {
            $query->latest();
        }])->orderBy('nama')->get();

        $pemeriksaanBulanIni = Screening::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count() 
            ?: \App\Models\HasilClustering::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count();

        $risikoTinggi = Screening::where('kategori_risiko', 'Berat')->count() 
            ?: \App\Models\HasilClustering::where('cluster', 2)->count();

        $perluTindakan = Screening::whereIn('kategori_risiko', ['Sedang', 'Berat'])->count() 
            ?: \App\Models\HasilClustering::whereIn('cluster', [1, 2])->count();

        return view('psikolog.pengguna', compact('pasiens', 'pemeriksaanBulanIni', 'risikoTinggi', 'perluTindakan'));
    }

    public function detail()
    {
        $pasiens = Pasien::withCount('screenings')
            ->with(['screenings' => function ($query) {
                $query->latest();
            }])
            ->orderBy('nama')
            ->get();

        return view('psikolog.detail', compact('pasiens'));
    }

    public function hasil()
    {
        $screenings = Screening::with('pasien')
            ->latest()
            ->take(25)
            ->get();

        $summary = Screening::selectRaw('kategori_risiko, COUNT(*) as total')
            ->groupBy('kategori_risiko')
            ->get()
            ->pluck('total', 'kategori_risiko');

        return view('psikolog.hasil', compact('screenings', 'summary'));
    }

    public function cluster()
    {
        $records = FiturPengguna::all();
        $clustered = $records->map(function ($record) {
            $average = $this->averageFiturScore($record);

            return [
                'record' => $record,
                'average' => $average,
                'cluster_label' => $this->clusterLabel($average),
            ];
        });

        $summary = $clustered->groupBy('cluster_label')->map->count();
        $topRecords = $clustered->sortByDesc('average')->take(10);

        return view('psikolog.cluster', compact('records', 'summary', 'topRecords'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pasien_id' => 'required|exists:pasiens,id',
            'catatan' => 'required|string|max:2000',
            'skor_total' => 'nullable|integer|min:0',
            'kategori_risiko' => 'nullable|in:Ringan,Sedang,Berat',
            'status' => 'nullable|string|max:50',
        ]);

        Screening::create([
            'pasien_id' => $request->pasien_id,
            'skor_total' => $request->input('skor_total', 0),
            'kategori_risiko' => $request->input('kategori_risiko', 'Ringan'),
            'status' => $request->input('status', 'Selesai'),
            'catatan' => $request->catatan,
        ]);

        return redirect()
            ->route('psikolog.pengguna')
            ->with('success', 'Catatan pemeriksaan berhasil disimpan.');
    }

    private function averageFiturScore(FiturPengguna $record): float
    {
        $fields = [
            'rasional', 'mampu_menyelesaikan_masalah_sendiri', 'mudah_putus_asa', 'emosional',
            'mengontrol_emosi', 'agresif', 'diam_marah', 'kontrol_fisik', 'emosi_tidak_terkontrol',
            'fisik_sulit_dikontrol', 'perilaku_baik_situasi_rumit', 'tenang_saat_emosi',
            'kontrol_diri_saat_emosi', 'kontrol_bicara', 'tingkah_tidak_terkontrol', 'nilai_emosi',
            'terima_peristiwa', 'cari_dukungan', 'tidak_terima_peristiwa', 'terima_peristiwa_buruk',
            'ubah_mindset', 'terima_emosi', 'tidak_malu_menangis', 'tidak_terima_emosi', 'malu_menangis',
            'ayah_hargai_perasaan', 'ayah_baik', 'ingin_ortu_berbeda', 'ayah_terima_saya',
            'senang_masukan_ayah', 'percuma_perlihatkan_ayah', 'ayah_tahu_marah', 'malu_bodoh_dengan_ayah',
            'ayah_hargai_pendapat', 'ayah_percaya_saya', 'tak_mau_merepotkan_ayah', 'ayah_bantu_pahami',
            'cerita_pada_ayah', 'kurang_perhatian_ayah', 'ayah_dorong_cerita', 'ayah_pahami_saya',
            'ayah_pahami_marah', 'percaya_ayah', 'ayah_tidak_paham', 'ayah_tidak_bisa_diandalkan', 'ayah_peduli',
            'ibu_hargai_perasaan', 'ibu_baik', 'ingin_ibu_berbeda', 'ibu_terima_saya',
            'senang_masukan_ibu', 'percuma_perlihatkan_ibu', 'ibu_tahu_marah', 'malu_bodoh_dengan_ibu',
            'gundah_dengan_ibu', 'ibu_tahu_sedikit', 'ibu_hargai_pendapat', 'ibu_percaya_saya',
            'tak_mau_repotkan_ibu', 'ibu_bantu_pahami', 'cerita_ibu', 'marah_dengan_ibu',
            'kurang_perhatian_ibu', 'ibu_dorong_cerita', 'ibu_pahami_saya', 'ibu_pahami_marah_saya',
            'percaya_ibu', 'ibu_tidak_paham', 'ibu_tidak_bisa_diandalkan', 'ibu_peduli',
        ];

        $values = collect($record->only($fields))->filter(function ($value) {
            return is_numeric($value) && $value > 0;
        })->map(fn ($value) => (int) $value);

        return $values->count() ? round($values->avg(), 2) : 0;
    }

    private function clusterLabel(float $average): string
    {
        if ($average >= 4.2) {
            return 'Profil Stabil';
        }

        if ($average >= 3.2) {
            return 'Profil Cukup Baik';
        }

        return 'Profil Butuh Perhatian';
    }
}
