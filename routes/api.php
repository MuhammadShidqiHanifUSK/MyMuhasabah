<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MuhasabahController;
use App\Http\Controllers\Api\TrackerController;
use App\Http\Controllers\Api\DashboardController;

// Public routes (tidak perlu login)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])
    ->middleware(['signed'])
    ->name('api.verification.verify');

// Protected routes (perlu login + email terverifikasi)
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    // Auth
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index']);

    // Muhasabah
    Route::apiResource('muhasabah', MuhasabahController::class);
    Route::get('/muhasabah/tanggal/{tanggal}', [MuhasabahController::class, 'byTanggal']);

    // Tracker
    Route::get('/tracker', [TrackerController::class, 'index']);
    Route::get('/tracker/{tanggal}', [TrackerController::class, 'show']);
    Route::post('/tracker/{tanggal}', [TrackerController::class, 'store']);
});