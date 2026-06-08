<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    protected $table = 'pendaftaran';
    protected $primaryKey = 'id_daftar';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $guarded = [];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim', 'nim');
    }

    public function jadwalKursus()
    {
        return $this->belongsTo(JadwalKursus::class, 'id_jadwal', 'id_jadwal');
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'id_daftar', 'id_daftar');
    }

    public function nilaiAkhir()
    {
        return $this->hasOne(NilaiAkhir::class, 'id_daftar', 'id_daftar');
    }
}
