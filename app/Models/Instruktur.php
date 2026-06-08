<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instruktur extends Model
{
    protected $table = 'instruktur';
    protected $primaryKey = 'id_instruktur';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $guarded = [];

    public function jadwalKursus()
    {
        return $this->hasMany(JadwalKursus::class, 'id_instruktur', 'id_instruktur');
    }
}