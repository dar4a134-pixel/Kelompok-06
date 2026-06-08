<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalKursus extends Model
{
    protected $table = 'jadwal_kursus';
    protected $primaryKey = 'id_jadwal';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $guarded = [];

    public function bahasa()
    {
        return $this->belongsTo(Bahasa::class, 'id_bahasa', 'id_bahasa');
    }

    public function instruktur()
    {
        return $this->belongsTo(Instruktur::class, 'id_instruktur', 'id_instruktur');
    }

    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class, 'id_jadwal', 'id_jadwal');
    }

    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'id_jadwal', 'id_jadwal');
    }
}
