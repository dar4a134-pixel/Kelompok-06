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
        Schema::create('bahasa', function (Blueprint $table) {
            $table->string('id_bahasa')->primary();
            $table->string('nama_bahasa');
            $table->enum('tingkat', ['Basic', 'Intermediate', 'Advanced']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bahasa');
    }
};
