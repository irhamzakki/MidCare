<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\HasilClustering;
use App\Models\Artikel;
use App\Models\Edukasi;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $totalScreeningSaya = HasilClustering::where('user_id', $user->id)->count();
        
        $latestScreening = HasilClustering::where('user_id', $user->id)
            ->with('fiturPengguna')
            ->latest()
            ->first();
            
        $riwayatScreening = HasilClustering::where('user_id', $user->id)
            ->with('fiturPengguna')
            ->latest()
            ->take(5)
            ->get();
            
        $totalArtikel = Artikel::count();
        $totalEdukasi = Edukasi::count();

        return view('Pasien.dashboard', compact(
            'totalScreeningSaya',
            'latestScreening',
            'riwayatScreening',
            'totalArtikel',
            'totalEdukasi'
        ));
    }
}
