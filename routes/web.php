<?php

use Illuminate\Support\Facades\Route;
// Import Controller yang baru kita buat di bagian atas
use App\Http\Controllers\KursusController; 

Route::get('/', function () {
    return view('welcome');
});
