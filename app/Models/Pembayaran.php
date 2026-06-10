<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran'; 
    protected $primaryKey = 'id_bayar'; 
    public $incrementing = false; 
    protected $keyType = 'string';

    protected $guarded = [];
}