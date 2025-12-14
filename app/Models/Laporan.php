<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    // MATIKAN PROTEKSI MASS ASSIGNMENT
    // (Agar kita bisa simpan data pakai Laporan::create([]) )
    protected $guarded = []; 

    // Relasi ke User (Pelapor)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Lokasi Sensor
    public function lokasiSensor()
    {
        return $this->belongsTo(LokasiSensor::class);
    }
}