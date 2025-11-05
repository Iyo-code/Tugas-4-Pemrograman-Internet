<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\FakultasController;

// ================================
// 🏠 Halaman Awal (Guest)
// ================================
Route::get('/', function () {
    return view('welcome');
});

// ================================
// 📊 Dashboard (Login diperlukan)
// ================================
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ================================
// 👤 Profil User (Bawaan Breeze)
// ================================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ================================
// 👥 USER BIASA (READ ONLY)
// ================================
// User login biasa hanya bisa melihat data (tanpa bisa CRUD)
Route::middleware(['auth'])->group(function () {
    Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
    Route::get('/prodi', [ProdiController::class, 'index'])->name('prodi.index');
    Route::get('/fakultas', [FakultasController::class, 'index'])->name('fakultas.index');
});

// ================================
// 🧩 ADMIN (CRUD LENGKAP)
// ================================
// Hanya user dengan role 'admin' yang bisa mengakses route di bawah
Route::middleware(['auth', 'admin'])->group(function () {

    // ---------- 📚 CRUD Mahasiswa ----------
    Route::get('/mahasiswa/create', [MahasiswaController::class, 'create'])->name('mahasiswa.create');
    Route::post('/mahasiswa', [MahasiswaController::class, 'store'])->name('mahasiswa.store');
    Route::get('/mahasiswa/{mahasiswa}/edit', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');
    Route::patch('/mahasiswa/{mahasiswa}', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
    Route::delete('/mahasiswa/{mahasiswa}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');
    Route::get('/get-prodi/{fakultas_id}', [MahasiswaController::class, 'getProdiByFakultas']);

    // ---------- 🏫 CRUD Prodi ----------
    Route::post('/prodi', [ProdiController::class, 'store'])->name('prodi.store');
    Route::get('/prodi/{prodi}/edit', [ProdiController::class, 'edit'])->name('prodi.edit');
    Route::patch('/prodi/{prodi}', [ProdiController::class, 'update'])->name('prodi.update');
    Route::delete('/prodi/{prodi}', [ProdiController::class, 'destroy'])->name('prodi.destroy');

    // ---------- 🏛️ CRUD Fakultas ----------
    Route::get('/fakultas', [FakultasController::class, 'index'])->name('fakultas.index');
    Route::post('/fakultas', [FakultasController::class, 'store'])->name('fakultas.store');
    Route::get('/fakultas/{fakultas}/edit', [FakultasController::class, 'edit'])->name('fakultas.edit');
    Route::patch('/fakultas/{fakultas}', [FakultasController::class, 'update'])->name('fakultas.update');
    Route::delete('/fakultas/{fakultas}', [FakultasController::class, 'destroy'])->name('fakultas.destroy');
});

// ================================
// 🔐 Route Otentikasi (Breeze)
// ================================
require __DIR__.'/auth.php';
