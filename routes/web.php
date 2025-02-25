<?php

use App\Http\Controllers\KandidatBemController;
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


