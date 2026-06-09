<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
<<<<<<< HEAD
    // 1. Beritahu Laravel nama tabel aslinya di Workbench
    protected $table = 'mahasiswa';

    // 2. Beritahu Laravel kalau Primary Key-nya adalah NIM (bukan id)
    protected $primaryKey = 'nim';

    // 3. Matikan auto increment karena NIM kita ketik manual
    public $incrementing = false;

    // 4. Set tipe data primary key-nya string/varchar
    protected $keyType = 'string';

    // 5. Matikan timestamps jika di tabel Workbench kamu tidak ada kolom created_at & updated_at
    public $timestamps = false;
}
=======
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
>>>>>>> b16daadd262f5afaed496df480629284a339d440
