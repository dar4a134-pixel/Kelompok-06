<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $table = 'absensi';
    protected $primaryKey = 'id_absen';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $guarded = [];

    public function jadwalKursus()
    {
        return $this->belongsTo(JadwalKursus::class, 'id_jadwal', 'id_jadwal');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim', 'nim');
    }
}
