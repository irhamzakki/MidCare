<?php

namespace App\Http\Controllers\Psikolog;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use App\Models\HasilClustering;
use App\Models\Screening;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPasien = Pasien::count();
        $totalScreening = HasilClustering::count() ?: Screening::count();
        $totalRisikoTinggi = HasilClustering::where('cluster', 2)->count();
        $totalRisikoModerat = HasilClustering::where('cluster', 1)->count();
        
        $recentScreenings = HasilClustering::with(['user', 'fiturPengguna'])
            ->latest()
            ->take(5)
            ->get();

        return view('Psikolog.dashboard', compact(
            'totalPasien',
            'totalScreening',
            'totalRisikoTinggi',
            'totalRisikoModerat',
            'recentScreenings'
        ));
    }
}
