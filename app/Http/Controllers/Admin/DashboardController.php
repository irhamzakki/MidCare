<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use App\Models\Edukasi;
use App\Models\Artikel;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPasien = Pasien::count();
        $totalScreening = \App\Models\HasilClustering::count() ?: Pasien::where('status_screening', 'Sudah Screening')->count();
        $totalEdukasi = Edukasi::count();
        $totalArtikel = Artikel::count();

        $recentScreenings = \App\Models\HasilClustering::with(['user', 'fiturPengguna'])
            ->latest()
            ->take(5)
            ->get();

        $screeningTerbaru = Pasien::latest()
            ->take(5)
            ->get();

        $artikelTerbaru = Artikel::latest()
            ->take(3)
            ->get();

        $edukasiTerbaru = Edukasi::latest()
            ->take(3)
            ->get();

        return view('Admin.dashboard', compact(
            'totalPasien',
            'totalScreening',
            'totalEdukasi',
            'totalArtikel',
            'recentScreenings',
            'screeningTerbaru',
            'artikelTerbaru',
            'edukasiTerbaru'
        ));
    }

    public function laporan()
    {
        $totalPasien = Pasien::count();
        $totalKuesioner = \App\Models\FiturPengguna::count();
        $totalHasilCluster = \App\Models\HasilClustering::count();
        $totalPsikolog = \App\Models\User::where('role', 'psikolog')->count();
        $totalArtikel = Artikel::count();
        $totalEdukasi = Edukasi::count();

        $cluster0Count = \App\Models\HasilClustering::where('cluster', 0)->count();
        $cluster1Count = \App\Models\HasilClustering::where('cluster', 1)->count();
        $cluster2Count = \App\Models\HasilClustering::where('cluster', 2)->count();

        $recentScreenings = \App\Models\HasilClustering::with(['user', 'fiturPengguna'])
            ->latest()
            ->take(10)
            ->get();

        $fiturPenggunaSample = \App\Models\FiturPengguna::latest()->take(10)->get();

        return view('admin.laporan', compact(
            'totalPasien',
            'totalKuesioner',
            'totalHasilCluster',
            'totalPsikolog',
            'totalArtikel',
            'totalEdukasi',
            'cluster0Count',
            'cluster1Count',
            'cluster2Count',
            'recentScreenings',
            'fiturPenggunaSample'
        ));
    }

    public function dataset()
    {
        $dataset = \App\Models\FiturPengguna::latest()->paginate(25);
        $totalData = \App\Models\FiturPengguna::count();

        return view('admin.dataset', compact('dataset', 'totalData'));
    }
}