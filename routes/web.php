<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeritaAcaraController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [BeritaAcaraController::class, 'showForm'])->name('welcome');
Route::post('/generate-pdf', [BeritaAcaraController::class, 'cetakPDF'])->name('generate.pdf');
Route::get('/petugas/{id}', function ($id) {
    return \App\Models\Petugas::find($id);
});
Route::get('/petugas/{id}', [BeritaAcaraController::class, 'getPetugas']);


