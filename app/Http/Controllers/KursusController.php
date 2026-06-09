<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\ViewJadwal; // 1. Import model ViewJadwal di atas

class KursusController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::all();
        return view('mahasiswa_index', compact('mahasiswa'));
    }

    // 2. Tambahkan fungsi baru ini
    public function jadwal()
    {
        // Mengambil data jadwal yang sudah otomatis ter-JOIN dari MySQL Workbench
        $jadwal = ViewJadwal::all();
        
        return view('jadwal_index', compact('jadwal'));
    }
}