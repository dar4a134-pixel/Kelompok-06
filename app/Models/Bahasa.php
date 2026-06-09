<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bahasa extends Model
{
    protected $table = 'bahasa';
    protected $primaryKey = 'id_bahasa';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
}