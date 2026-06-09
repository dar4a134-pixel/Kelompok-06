<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ViewJadwal extends Model
{
    // Arahkan langsung ke nama VIEW di MySQL Workbench
    protected $table = 'view_informasi_jadwal';
    
    // Karena view tidak punya primary key tunggal, set null & false
    protected $primaryKey = null;
    public $incrementing = false;
    public $timestamps = false;
}