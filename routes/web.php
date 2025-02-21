<?php

use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KandidatController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
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
    Route::get('/mahasiswa/create', [AdminController::class, 'create'])->name('admin.mahasiswa.create');
    Route::post('/mahasiswa/store', [AdminController::class, 'store'])->name('admin.mahasiswa.store');
});

// Middleware untuk Mahasiswa
Route::middleware(['auth', 'can:mahasiswa'])->prefix('mahasiswa')->group(function () {
    Route::get('/dashboard', function () {
        return view('mahasiswa.dashboard');
    })->name('mahasiswa.dashboard');

    // Pendaftaran Mahasiswa
    Route::get('/pendaftaran', [MahasiswaController::class, 'create'])->name('mahasiswa.pendaftaran');

    Route::post('/pendaftaran/kandidat/store', [KandidatController::class, 'store'])->name('mahasiswa.pendaftaran.store');
});
