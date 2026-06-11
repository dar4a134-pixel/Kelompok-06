<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensi'; 
    protected $primaryKey = 'id_absen'; 
    public $incrementing = false; 
    protected $keyType = 'string';

    protected $guarded = [];

    // ==========================================
    // HUBUNGAN RELASI BARU UNTUK DROPDOWN
    // ==========================================


    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim', 'nim');
    }

    public function jadwalKursus()
    {
        return $this->belongsTo(JadwalKursus::class, 'id_jadwal', 'id_jadwal');
    }
}