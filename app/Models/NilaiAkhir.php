<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NilaiAkhir extends Model
{
    protected $table = 'nilai_akhir';
    protected $primaryKey = 'id_nilai';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $guarded = [];

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'id_daftar', 'id_daftar');
    }
}
