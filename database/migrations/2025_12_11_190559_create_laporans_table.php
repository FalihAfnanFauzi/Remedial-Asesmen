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
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            // Foreign Key Style: Gunakan constrained() agar terlihat modern & beda dari yang manual
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // [cite: 47]
            $table->foreignId('lokasi_sensor_id')->constrained('lokasi_sensors')->onDelete('cascade'); // [cite: 48]

            $table->integer('ketinggian_air'); // [cite: 49]
            $table->string('status_risiko');   // [cite: 51]
            $table->text('deskripsi');         // [cite: 52]
            $table->string('foto_bukti')->nullable(); // [cite: 54]
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};