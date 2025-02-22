<?php

use App\Http\Controllers\MahasiswaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

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
    Route::post('/mahasiswa/import', [AdminController::class, 'processImport'])->name('admin.mahasiswa.import.process');
    Route::get('/mahasiswa/create', [AdminController::class, 'create'])->name('admin.mahasiswa.create');
    Route::post('/mahasiswa/store', [AdminController::class, 'store'])->name('admin.mahasiswa.store');
});

// Middleware untuk Mahasiswa
Route::middleware(['auth', 'can:mahasiswa'])->prefix('mahasiswa')->group(function () {
    Route::get('/dashboard', function () {
        return view('mahasiswa.dashboard');
    })->name('mahasiswa.dashboard');

    Route::get('/mahasiswa/pendaftaran', [MahasiswaController::class, 'create'])->name('mahasiswa.pendaftaran');
});


