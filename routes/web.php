<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScreeningController;
use App\Http\Controllers\Admin\ScreeningController as AdminScreeningController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EdukasiController;
use App\Http\Controllers\Admin\PasienController;
use App\Http\Controllers\Admin\ArtikelController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Psikolog\DashboardController as PsikologDashboardController;
use App\Http\Controllers\Psikolog\PasienController as PsikologPasienController;
use App\Http\Controllers\Pasien\DashboardController as PasienDashboardController;
use App\Http\Controllers\Pengguna\HasilController;
use App\Http\Controllers\Admin\KuesionerController;

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

// Akses publik/pasien ke Cek Kesehatan Mental
Route::middleware(['auth', 'role:pasien'])->group(function () {
    Route::get('/pasien/cek-kesehatan-mental', [ScreeningController::class, 'index'])->name('pasien.cek-kesehatan-mental');
});


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
| ROLE: PASIEN (COMPATIBILITY)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth','role:pasien'])->prefix('pengguna')->name('pengguna.')->group(function () {
    Route::get('/kuesioner', function () {
        $fiturPenggunas = \App\Models\FiturPengguna::latest()->get();

        return view('pengguna.kuesioner', compact('fiturPenggunas'));
    })->name('kuesioner');
    Route::get('/hasil', [HasilController::class, 'index'])->name('hasil');
    Route::get('/hasil/{id}', [HasilController::class, 'show'])->name('hasil.show');
    Route::get('/riwayat', function () { return view('pengguna.riwayat'); })->name('riwayat');
});
use App\Http\Controllers\Admin\PsikologController;

Route::middleware(['auth','role:admin'])
->prefix('admin')
->group(function(){

Route::get(
'/pasien/create',
[PasienController::class,'create']
)
->name('admin.pasien.create');

Route::post(
'/pasien/store',
[PasienController::class,'store']
)
->name('admin.pasien.store');

Route::post(
'/psikolog/store',
[PsikologController::class,'store']
)
->name('admin.psikolog.store');

});


/*
|--------------------------------------------------------------------------
| ROLE: PSIKOLOG
|--------------------------------------------------------------------------
*/
Route::middleware(['auth','role:psikolog'])->prefix('psikolog')->name('psikolog.')->group(function () {
    Route::get('/dashboard', [PsikologDashboardController::class, 'index'])->name('dashboard');
    Route::get('/pengguna', [PsikologPasienController::class, 'index'])->name('pengguna');
    Route::get('/detail', [PsikologPasienController::class, 'detail'])->name('detail');
    Route::get('/hasil', [PsikologPasienController::class, 'hasil'])->name('hasil');
    Route::get('/cluster', [PsikologPasienController::class, 'cluster'])->name('cluster');
    Route::post('/pengguna/note', [PsikologPasienController::class, 'store'])->name('pengguna.store');
    Route::get('/rekomendasi', function () { return view('psikolog.rekomendasi'); })->name('rekomendasi');
});

// ROUTES KHUSUS PASIEN (RBAC)
Route::middleware(['auth','role:pasien'])->prefix('pasien')->name('pasien.')->group(function () {
    Route::get('/dashboard', [PasienDashboardController::class, 'index'])->name('dashboard');
    Route::get('/tes', function () { return view('pasien.tes'); })->name('tes');
    Route::get('/hasil', function () { return view('pasien.hasil'); })->name('hasil');
    Route::get('/riwayat', function () { return view('pasien.riwayat'); })->name('riwayat');
    Route::get('/rekomendasi', function () { return view('pasien.rekomendasi'); })->name('rekomendasi');
});


/*
|--------------------------------------------------------------------------
| ROLE: ADMIN (MANAGEMENT & FITUR DATA)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->name('Admin.')->group(function () {
    
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

    // Manajemen Psikolog
    Route::prefix('Psikolog')->name('Psikolog.')->group(function () {
        Route::get('/Psikolog', [\App\Http\Controllers\Admin\PsikologController::class, 'index'])->name('index');
    });

    // Manajemen Artikel
    Route::prefix('Artikel')->name('Artikel.')->group(function () {
        Route::get('/Artikel', [ArtikelController::class, 'index'])->name('Artikel');
        Route::get('/Tambah', [ArtikelController::class, 'create'])->name('Tambah');
        Route::post('/Simpan', [ArtikelController::class, 'store'])->name('store');
    });

    // Manajemen User - dibuat oleh Admin
    Route::get('/users', function () { return view('Admin.users'); })->name('users');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');

    // Menu View Statis Tambahan Admin

    Route::get('/kuesioner', [KuesionerController::class, 'index'])
    ->name('admin.kuesioner.index');
    Route::get('/kuesioner/{id}/detail',
    [KuesionerController::class, 'show']
)->name('pengguna.hasil-detail');
    Route::get('/dataset', function () { return view('admin.dataset'); })->name('dataset');
    Route::get('/laporan', function () { return view('admin.laporan'); })->name('laporan');
});


/*
|--------------------------------------------------------------------------
| AUTH ROUTES (BREEZE)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';