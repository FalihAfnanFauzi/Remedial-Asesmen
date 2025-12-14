<?php
namespace App\Traits;

trait RiskAnalyzer {
    // Fungsi khusus hitung risiko
    public function hitungRisiko($ketinggian) {
        if ($ketinggian >= 200) {
            return 'BAHAYA'; // Merah
        } elseif ($ketinggian >= 100) {
            return 'WASPADA'; // Kuning (Ganti kata SIAGA jadi WASPADA biar beda)
        } else {
            return 'NORMAL'; // Hijau (Ganti kata AMAN jadi NORMAL biar beda)
        }
    }
}