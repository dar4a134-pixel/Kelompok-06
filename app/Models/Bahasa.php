<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bahasa extends Model
{
    protected $table = 'bahasa';
    protected $primaryKey = 'id_bahasa';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $guarded = [];

    public function jadwalKursus()
    {
        return $this->hasMany(JadwalKursus::class, 'id_bahasa', 'id_bahasa');
    }
}
