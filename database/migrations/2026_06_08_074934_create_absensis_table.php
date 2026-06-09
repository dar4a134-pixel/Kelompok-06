<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('absensi', function (Blueprint $table) {
            $table->string('id_absen')->primary();
            $table->string('id_jadwal');
            $table->string('nim');
            $table->date('tgl_pertemuan');
            $table->enum('status_hadir', ['Hadir', 'Izin', 'Alpa']);
            $table->timestamps();

            $table->foreign('id_jadwal')->references('id_jadwal')->on('jadwal_kursus')->onDelete('cascade');
            $table->foreign('nim')->references('nim')->on('mahasiswa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi');
    }
};
