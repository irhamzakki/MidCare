<?php

namespace App\Http\Controllers\Pengguna;

use App\Http\Controllers\Controller;
use App\Models\HasilClustering;
use Illuminate\Http\Request;

class HasilController extends Controller
{
    // Menampilkan hasil screening pengguna yang login
    public function index()
    {
        $hasil = auth()->user()
            ->hasilClusterings()
            ->with('fiturPengguna')
            ->latest()
            ->get();

        $recentResult = $hasil->first();

        return view('pengguna.hasil', compact('hasil', 'recentResult'));
    }

    // Menampilkan detail hasil screening
    public function show($id)
    {
        $hasil = HasilClustering::where('user_id', auth()->id())
            ->with('fiturPengguna')
            ->findOrFail($id);

        return view('pengguna.hasil-detail', compact('hasil'));
    }
}
