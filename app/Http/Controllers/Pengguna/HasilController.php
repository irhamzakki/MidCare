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
        $user = auth()->user();

        // 1. Ambil riwayat hasil clustering user
        $hasil = $user
            ->hasilClusterings()
            ->with('fiturPengguna')
            ->latest()
            ->get();

        // 2. Jika user baru dan belum memiliki record terhubung, cek screening terbaru dari session atau nama yang cocok
        if ($hasil->isEmpty()) {
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

            $hasil = $user
                ->hasilClusterings()
                ->with('fiturPengguna')
                ->latest()
                ->get();
        }

        $recentResult = $hasil->first();

        return view('pengguna.hasil', compact('hasil', 'recentResult'));
    }

    // Menampilkan detail hasil screening
    public function show($id)
    {
        $user = auth()->user();

        // Role Admin dan Psikolog dapat melihat detail semua responden
        if (in_array($user->role ?? '', ['admin', 'psikolog'])) {
            $hasil = HasilClustering::with('fiturPengguna')->findOrFail($id);
        } else {
            // Pasien dapat melihat screening miliknya atau screening yang dicocokkan
            $hasil = HasilClustering::with('fiturPengguna')->findOrFail($id);

            if ($hasil->user_id !== null && $hasil->user_id !== $user->id) {
                abort(403, 'Anda tidak memiliki akses ke hasil screening ini.');
            }
        }

        return view('pengguna.hasil-detail', compact('hasil'));
    }
}
