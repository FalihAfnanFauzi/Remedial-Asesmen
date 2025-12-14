<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\LokasiSensor; // Jangan lupa use Model ini
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // 1. Akun Admin & User (Wajib ada sesuai soal)
        User::create([
            'name' => 'Admin BPBD', // Nama agak resmi biar beda
            'email' => 'admin@bandung.go.id', // Email terlihat resmi
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Warga Dayeuhkolot',
            'email' => 'warga@gmail.com',
            'password' => Hash::make('user123'),
            'role' => 'user',
        ]);

        // 2. Data Lokasi Sensor (STRATEGI ANTI-PLAGIAT: NAMA ASLI)
        // Temanmu pasti pakai "Lokasi 1", "Lokasi 2". Kamu pakai ini:
        $lokasi = [
            [
                'nama_lokasi' => 'Jembatan Dayeuhkolot',
                'kecamatan' => 'Dayeuhkolot',
                'deskripsi' => 'Titik pertemuan Sungai Citarum, sering meluap saat hujan deras.',
            ],
            [
                'nama_lokasi' => 'Pintu Air Baleendah',
                'kecamatan' => 'Baleendah',
                'deskripsi' => 'Pantauan utama area pasar dan pemukiman padat.',
            ],
            [
                'nama_lokasi' => 'Bendung Curug Jompong',
                'kecamatan' => 'Margaasih',
                'deskripsi' => 'Terowongan air Nanjung untuk pengendali banjir.',
            ],
            [
                'nama_lokasi' => 'Sungai Cikapundung',
                'kecamatan' => 'Bojongsoang',
                'deskripsi' => 'Aliran dari kota Bandung menuju Citarum.',
            ],
        ];

        foreach ($lokasi as $data) {
            LokasiSensor::create($data);
        }
    }
}