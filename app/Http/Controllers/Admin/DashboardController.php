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
        $totalScreening = Pasien::where('status_screening', 'Sudah Screening')->count();
        $totalEdukasi = Edukasi::count();
        $totalArtikel = Artikel::count();

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
            'screeningTerbaru',
            'artikelTerbaru',
            'edukasiTerbaru'
        ));
    }
}