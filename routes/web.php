<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\Admin\LokasiController;
use Illuminate\Support\Facades\Route;

// Halaman Depan
Route::get('/', function () {
    return view('welcome');
});

// Dashboard (Akses untuk Admin & User)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// --- AREA WAJIB LOGIN ---
Route::middleware('auth')->group(function () {
    
    // 1. Profile Bawaan Laravel
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 2. CRUD LAPORAN BANJIR (User & Admin)
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::post('/laporan', [LaporanController::class, 'store'])->name('laporan.store'); // Ajax
    Route::get('/laporan/{id}/edit', [LaporanController::class, 'edit'])->name('laporan.edit'); // Form Edit
    Route::put('/laporan/{id}', [LaporanController::class, 'update'])->name('laporan.update'); // Proses Update
    Route::delete('/laporan/{id}', [LaporanController::class, 'destroy'])->name('laporan.destroy'); // Hapus

    // 3. CRUD LOKASI SENSOR (KHUSUS ADMIN)
    Route::get('/lokasi', [LokasiController::class, 'index'])->name('lokasi.index');
    Route::post('/lokasi', [LokasiController::class, 'store'])->name('lokasi.store');
    Route::get('/lokasi/{id}/edit', [LokasiController::class, 'edit'])->name('lokasi.edit'); // Form Edit
    Route::put('/lokasi/{id}', [LokasiController::class, 'update'])->name('lokasi.update'); // Proses Update
    Route::delete('/lokasi/{id}', [LokasiController::class, 'destroy'])->name('lokasi.destroy');

});

require __DIR__.'/auth.php';