<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScreeningController;
use App\Http\Controllers\Admin\ScreeningController as AdminScreeningController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EdukasiController;
use App\Http\Controllers\Admin\PasienController;
use App\Http\Controllers\Admin\ArtikelController;

/*
|--------------------------------------------------------------------------
| HALAMAN PUBLIK
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/Edukasi', function () {
    return view('Edukasi');
})->name('Edukasi');

Route::get('/artikel', function () {
    return view('artikel');
})->name('artikel');

Route::get('/profil', function () {
    return view('profil');
})->name('profil');

Route::get('/kontak', function () {
    return view('kontak');
})->name('kontak');

// Halaman Kuesioner Publik
Route::get('/screening', [ScreeningController::class, 'index'])->name('screening');
Route::post('/screening', [ScreeningController::class, 'store'])->name('screening.store');
Route::redirect('/screaning', '/screening');


/*
|--------------------------------------------------------------------------
| AUTENTIKASI GLOBAL (USER PROFILE)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| ROLE: PENGGUNA
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('pengguna')->name('pengguna.')->group(function () {
    Route::get('/kuesioner', function () { return view('pengguna.kuesioner'); })->name('kuesioner');
    Route::get('/hasil', function () { return view('pengguna.hasil'); })->name('hasil');
    Route::get('/riwayat', function () { return view('pengguna.riwayat'); })->name('riwayat');
});


/*
|--------------------------------------------------------------------------
| ROLE: PSIKOLOG
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('psikolog')->name('psikolog.')->group(function () {
    Route::get('/dashboard', function () { return view('psikolog.dashboard'); })->name('dashboard');
    Route::get('/pengguna', function () { return view('psikolog.pengguna'); })->name('pengguna');
    Route::get('/rekomendasi', function () { return view('psikolog.rekomendasi'); })->name('rekomendasi');
});


/*
|--------------------------------------------------------------------------
| ROLE: ADMIN (MANAGEMENT & FITUR DATA)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->prefix('admin')->name('Admin.')->group(function () {
    
    // Dashboard Utama Admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Fitur Cek Kesehatan Mental (CekMel) - Panel Admin
    Route::prefix('CekMel')->name('CekMel.')->group(function () {
        Route::get('/', [AdminScreeningController::class, 'index'])->name('CekMel');
        Route::post('/store', [AdminScreeningController::class, 'store'])->name('store');
    });

    // Manajemen Edukasi
    Route::prefix('Edukasi')->name('Edukasi.')->group(function () {
        Route::get('/Edukasi', [EdukasiController::class, 'index'])->name('Edukasi');
        Route::post('/Edukasi', [EdukasiController::class, 'store'])->name('store');
        Route::put('/Edukasi/{edukasi}', [EdukasiController::class, 'update'])->name('update');
        Route::delete('/Edukasi/{edukasi}', [EdukasiController::class, 'destroy'])->name('destroy');
    });

    // Manajemen Pasien
    Route::prefix('Pasien')->name('Pasien.')->group(function () {
        Route::get('/Pasien', [PasienController::class, 'index'])->name('Pasien');
        Route::post('/Pasien', [PasienController::class, 'store'])->name('store');
    });

    // Manajemen Artikel
    Route::prefix('Artikel')->name('Artikel.')->group(function () {
        Route::get('/Artikel', [ArtikelController::class, 'index'])->name('Artikel');
        Route::get('/Tambah', [ArtikelController::class, 'create'])->name('Tambah');
        Route::post('/Simpan', [ArtikelController::class, 'store'])->name('store');
    });

    // Menu View Statis Tambahan Admin
    Route::get('/users', function () { return view('admin.users'); })->name('users');
    Route::get('/kuesioner', function () { return view('admin.kuesioner'); })->name('kuesioner');
    Route::get('/dataset', function () { return view('admin.dataset'); })->name('dataset');
    Route::get('/laporan', function () { return view('admin.laporan'); })->name('laporan');
});


/*
|--------------------------------------------------------------------------
| AUTH ROUTES (BREEZE)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';