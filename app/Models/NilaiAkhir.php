<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiAkhir extends Model
{
    use HasFactory;

    protected $table = 'nilai_akhir'; 
    protected $primaryKey = 'id_nilai'; 
    public $incrementing = false; 
    protected $keyType = 'string';

    protected $guarded = [];
}