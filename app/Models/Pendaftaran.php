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
}