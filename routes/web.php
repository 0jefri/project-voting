<?php

use App\Http\Controllers\KandidatBemController;
use App\Http\Controllers\PenilaianController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Session;

Route::get('/', function () {
    Session::flush(); // Hapus semua sesi pengguna
    return redirect()->route('login'); // Redirect ke halaman login
});


// Login & Logout
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Middleware untuk Admin
Route::middleware(['auth', 'can:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Kelola Mahasiswa
    Route::get('/mahasiswa', [AdminController::class, 'index'])->name('admin.mahasiswa.index');
    Route::get('/mahasiswa/import', [AdminController::class, 'import'])->name('admin.mahasiswa.import');
    Route::post('/mahasiswa/import', [AdminController::class, 'processImport'])->name('admin.mahasiswa.import.process');
    Route::get('/mahasiswa/create', [AdminController::class, 'create'])->name('admin.mahasiswa.create');
    Route::post('/mahasiswa/store', [AdminController::class, 'store'])->name('admin.mahasiswa.store');

    //kelola kandidat
    Route::get('/mahasiswa/kandidat', [KandidatBemController::class, 'index'])
        ->name('admin.mahasiswa.kandidat');

    Route::get('/kandidat/edit/{id}', [KandidatBemController::class, 'edit'])->name('admin.kandidat.edit');
    Route::patch('/kandidat/update/{id}', [KandidatBemController::class, 'update'])->name('admin.kandidat.update');
    Route::delete('/kandidat/delete/{id}', [KandidatBemController::class, 'destroy'])->name('admin.kandidat.destroy');

    //penilaian
    Route::get('/penilaian', [PenilaianController::class, 'index'])->name('admin.penilaian.index');
    Route::get('/penilaian/{id}', [PenilaianController::class, 'create'])->name('admin.kandidat.penilaian');
    Route::post('/penilaian/store', [PenilaianController::class, 'store'])->name('admin.penilaian.store');

    Route::get('/admin/kandidat/hasil-gap', [PenilaianController::class, 'hitungGAP'])->name('admin.kandidat.hasil_gap');
    Route::get('/admin/kandidat/hasil-penilaian', [PenilaianController::class, 'hitungCF_SF'])->name('admin.kandidat.hasil_penilaian');
    Route::get('/admin/kandidat/penilaian/{id}', [PenilaianController::class, 'show'])->name('admin.kandidat.penilaian.detail');
    Route::get('/admin/kandidat', [KandidatBemController::class, 'index'])->name('admin.kandidat.index');


});


// Middleware untuk Mahasiswa
Route::middleware(['auth', 'can:mahasiswa'])->prefix('mahasiswa')->group(function () {
    Route::get('/dashboard', function () {
        return view('mahasiswa.dashboard');
    })->name('mahasiswa.dashboard');

    Route::get('/mahasiswa/pendaftaran', [KandidatBemController::class, 'create'])
        ->name('mahasiswa.pendaftaran');

    Route::post('/mahasiswa/pendaftaran', [KandidatBemController::class, 'store'])
        ->name('mahasiswa.pendaftaran');
});


