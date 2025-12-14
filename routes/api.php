<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\LaporanController;

// 1. Route Public (Bisa diakses tanpa login)
Route::post('/login', [AuthController::class, 'login']);

// 2. Route Private (Harus punya Token / Login dulu)
Route::middleware('auth:sanctum')->group(function () {
    
    // Auth
    Route::post('/logout', [AuthController::class, 'logout']);
    
    // CRUD Laporan Banjir
    Route::get('/laporan', [LaporanController::class, 'index']);
    Route::post('/laporan', [LaporanController::class, 'store']);
    
});