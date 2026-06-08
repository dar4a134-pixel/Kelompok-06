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
        Schema::create('jadwal_kursus', function (Blueprint $table) {
            $table->string('id_jadwal')->primary();
            $table->string('id_bahasa');
            $table->string('id_instruktur');
            $table->string('hari');
            $table->time('jam');
            $table->timestamps();

            $table->foreign('id_bahasa')->references('id_bahasa')->on('bahasa')->onDelete('cascade');
            $table->foreign('id_instruktur')->references('id_instruktur')->on('instruktur')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_kursus');
    }
};
