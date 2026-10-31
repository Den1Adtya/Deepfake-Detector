<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DetectionController;
use App\Models\Prediction;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $userId = Auth::id();
    $total = Prediction::count();
    $fake = Prediction::where('label', 'FAKE')->count();
    $real = Prediction::where('label', 'REAL')->count();
    
    // Hitung statistik untuk Chart.js
    $totalScans = Prediction::where('user_id', $userId)->count();
    $totalFake = Prediction::where('user_id', $userId)->where('label', 'FAKE')->count();
    $totalReal = Prediction::where('user_id', $userId)->where('label', 'REAL')->count();

    return view('dashboard', compact('totalScans', 'totalFake', 'totalReal'));
})->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Menampilkan halaman riwayat deteksi
    Route::get('/history', [DetectionController::class, 'history'])->name('detect.history');
    // Menampilkan detail spesifik dari satu riwayat
    Route::get('/history/{id}', [DetectionController::class, 'show'])->name('detect.show');
    Route::get('/trending', [DetectionController::class, 'trending'])->name('detect.trending');
});

require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {
    // Menampilkan halaman upload
    Route::get('/detect', function () {
        return view('detect');
    })->name('detect.index');

    // Memproses gambar yang diunggah
    Route::post('/detect', [DetectionController::class, 'detect'])->name('detect.process');
});