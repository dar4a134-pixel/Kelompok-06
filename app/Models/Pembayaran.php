<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';
    protected $primaryKey = 'id_bayar';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $guarded = [];

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'id_daftar', 'id_daftar');
    }
}
