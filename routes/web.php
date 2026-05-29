<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MuhasabahController;
use App\Http\Controllers\TrackerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Muhasabah CRUD
    Route::resource('muhasabah', MuhasabahController::class);

    // Tracker
    Route::get('/tracker', [TrackerController::class, 'index'])->name('tracker.index');
    Route::get('/tracker/{tanggal}', [TrackerController::class, 'show'])->name('tracker.show');
    Route::post('/tracker/{tanggal}', [TrackerController::class, 'store'])->name('tracker.store');
});

require __DIR__.'/auth.php';