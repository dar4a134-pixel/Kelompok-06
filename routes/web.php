<?php

use Illuminate\Support\Facades\Route;
// Import Controller yang baru kita buat di bagian atas
use App\Http\Controllers\KursusController; 

Route::get('/', function () {
    return view('welcome');
});

// GANTI BLOK NOMOR 2 MENJADI SEPERTI INI:
Route::get('/test-data', [KursusController::class, 'index']);

// Rute untuk melihat kelas jadwal kursus
Route::get('/jadwal-kursus', [KursusController::class, 'jadwal']);