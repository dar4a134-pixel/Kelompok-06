<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    // Memaksa Laravel membaca tabel 'pendaftaran' buatan timmu
    protected $table = 'pendaftaran'; 

    // Memaksa Laravel tahu bahwa primary key-nya adalah id_daftar
    protected $primaryKey = 'id_daftar'; 

    // Matikan auto-increment angka karena id_daftar diisi manual pake string/teks
    public $incrementing = false; 

    // Kasih tahu jenis datanya adalah string
    protected $keyType = 'string';

    // Mengizinkan semua kolom diisi (CRUD) tanpa error mass-assignment
    protected $guarded = []; 

    // ==========================================
    // TALI PENGHUBUNG (RELASI) BARU DI BAWAH INI
    // ==========================================

    /**
     * Hubungan ke tabel Mahasiswa (Satu pendaftaran dimiliki oleh satu mahasiswa)
     */
    public function mahasiswa()
    {
        // Parameter: Model tujuan, foreign key di pendaftaran, primary key di mahasiswa
        return $this->belongsTo(Mahasiswa::class, 'nim', 'nim');
    }

    /**
     * Hubungan ke tabel Jadwal Kursus (Satu pendaftaran punya satu jadwal)
     */
    public function jadwalKursus()
    {
        // Parameter: Model tujuan, foreign key di pendaftaran, primary key di jadwal_kursus
        return $this->belongsTo(JadwalKursus::class, 'id_jadwal', 'id_jadwal');
    }
}