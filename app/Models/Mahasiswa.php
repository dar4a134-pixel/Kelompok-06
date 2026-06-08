<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'nim';
    public $incrementing = false;
    protected $keyType = 'string';
    
    protected $guarded = [];

    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class, 'nim', 'nim');
    }

    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'nim', 'nim');
    }
}
