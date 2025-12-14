<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Traits\RiskAnalyzer; // Panggil Trait Unik Kita
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LaporanController extends Controller
{
    use RiskAnalyzer; // Aktifkan Trait

    // GET: Ambil Semua Laporan
    public function index()
    {
        $laporans = Laporan::with(['user', 'lokasiSensor'])->latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'List Data Laporan Banjir',
            'data' => $laporans
        ]);
    }

    // POST: Kirim Laporan Baru (+ Upload Foto)
    public function store(Request $request)
    {
        // 1. Validasi Manual (Biar responnya JSON, bukan Redirect)
        $validator = Validator::make($request->all(), [
            'lokasi_sensor_id' => 'required',
            'ketinggian_air' => 'required|numeric',
            'deskripsi' => 'required',
            'foto_bukti' => 'required|mimes:jpg,png,pdf|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi Gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        // 2. Upload File (Storage Link)
        $path = null;
        if ($request->hasFile('foto_bukti')) {
            $path = $request->file('foto_bukti')->store('bukti_banjir', 'public');
        }

        // 3. LOGIKA SMART (Pakai Trait biar konsisten)
        // Ini yang bikin nilaimu tinggi: Logika API sama dengan Web
        $statusOtomatis = $this->hitungRisiko($request->ketinggian_air);

        // 4. Simpan ke Database
        $laporan = Laporan::create([
            'user_id' => Auth::id(), // Ambil ID user dari Token
            'lokasi_sensor_id' => $request->lokasi_sensor_id,
            'ketinggian_air' => $request->ketinggian_air,
            'status_risiko' => $statusOtomatis, // Hasil dari Trait
            'deskripsi' => $request->deskripsi,
            'foto_bukti' => $path
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Laporan Berhasil Terkirim',
            'data' => $laporan
        ], 201);
    }
}