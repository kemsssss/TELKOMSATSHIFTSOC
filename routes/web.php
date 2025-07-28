<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeritaAcaraController;
use App\Http\Controllers\PetugasController;
use App\Models\Petugas;

Route::get('/', [BeritaAcaraController::class, 'showForm'])->name('welcome');
Route::post('/generate-pdf', [BeritaAcaraController::class, 'cetakPDF'])->name('generate.pdf');

// Tambahan untuk AJAX jika dibutuhkan (bukan untuk web UI)
Route::get('/api/petugas/{id}', function ($id) {
    return Petugas::findOrFail($id);
});

// Resource utama Petugas
Route::resource('petugas', PetugasController::class);

