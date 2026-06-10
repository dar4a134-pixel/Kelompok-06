<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    // 1. Beritahu Laravel nama tabel aslinya di Workbench
    protected $table = 'mahasiswa';

    // 2. Beritahu Laravel kalau Primary Key-nya adalah NIM (bukan id)
    protected $primaryKey = 'nim';

    // 3. Matikan auto increment karena NIM kita ketik manual
    public $incrementing = false;

    // 4. Set tipe data primary key-nya string/varchar
    protected $keyType = 'string';
    
    // 5. Matikan timestamps jika di tabel tidak ada kolom created_at & updated_at
    public $timestamps = false;

    // 6. Mengizinkan semua kolom untuk diisi (Mass Assignment)
    protected $guarded = [];

    // Relasi ke tabel Pendaftaran
    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class, 'nim', 'nim');
    }

    // Relasi ke tabel Absensi
    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'nim', 'nim');
    }
}