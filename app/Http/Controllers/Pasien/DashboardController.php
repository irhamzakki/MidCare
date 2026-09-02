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

        // Jika belum ada record terhubung, hubungkan screening terbaru dari session atau nama
        $existingCount = HasilClustering::where('user_id', $user->id)->count();
        if ($existingCount === 0) {
            $latestScreeningId = session('latest_screening_id');
            if ($latestScreeningId) {
                HasilClustering::where('id', $latestScreeningId)
                    ->whereNull('user_id')
                    ->update(['user_id' => $user->id]);
            } else {
                HasilClustering::whereNull('user_id')
                    ->whereHas('fiturPengguna', function ($q) use ($user) {
                        $q->where('nama', $user->name);
                    })
                    ->latest()
                    ->take(1)
                    ->update(['user_id' => $user->id]);
            }
        }
        
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
