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
        Schema::create('lokasi_sensors', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lokasi'); // [cite: 32]
            $table->string('kecamatan');   // [cite: 33]
            $table->text('deskripsi')->nullable(); // [cite: 34]
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lokasi_sensors');
    }
};