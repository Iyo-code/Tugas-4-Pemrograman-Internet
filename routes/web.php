<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\FakultasController;
use App\Http\Controllers\ProdiController;

// Redirect root ke daftar mahasiswa
Route::get('/', function () {
    return redirect()->route('index');
});

// Resource utama Mahasiswa (CRUD)
Route::resource('mahasiswa', MahasiswaController::class);
Route::resource('fakultas', FakultasController::class)->parameters([
    'fakultas' => 'fakultas'
]);
Route::resource('prodi', ProdiController::class);

// AJAX: ambil data prodi berdasarkan fakultas
Route::get('/get-prodi/{fakultas_id}', [MahasiswaController::class, 'getProdiByFakultas'])
     ->name('getProdiByFakultas');
