<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\LokasiSensor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class LaporanController extends Controller
{
    
    public function index() {
        if(Auth::user()->role === 'admin'){
            $laporans = Laporan::with(['user', 'lokasiSensor'])->latest()->get();
        } else {
            $laporans = Laporan::with(['lokasiSensor'])
                        ->where('user_id', Auth::id())
                        ->latest()->get();
        }
        
        $lokasi = LokasiSensor::all();
        return view('laporan.index', compact('laporans', 'lokasi'));
    }

  
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'lokasi_sensor_id' => 'required',
            'ketinggian_air' => 'required|numeric',
            'deskripsi' => 'required',
            'foto_bukti' => 'required|mimes:jpg,jpeg,png,pdf|max:2048', 
        ]);

        // Cek: Apakah request ini datang dari AJAX?
        if ($request->ajax()) {
        return response()->json(['status' => 'success', 'msg' => 'Laporan Berhasil Dikirim!']);
        }
        // Kalau bukan AJAX (submit biasa), lakukan cara lama
        return redirect()->back()->with('success', 'Laporan Berhasil Dikirim!');

        $path = $request->file('foto_bukti')->store('bukti_banjir', 'public');

        $status = $this->hitungRisikoManual($request->ketinggian_air); 

        Laporan::create([
            'user_id' => Auth::id(),
            'lokasi_sensor_id' => $request->lokasi_sensor_id,
            'ketinggian_air' => $request->ketinggian_air,
            'status_risiko' => $status,
            'deskripsi' => $request->deskripsi,
            'foto_bukti' => $path
        ]);

        return redirect()->back()->with('success', 'Laporan Berhasil Dikirim!');
    }

    public function edit($id)
    {
        $laporan = Laporan::findOrFail($id);

        if ($laporan->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses.');
        }

        $lokasi = LokasiSensor::all();
        return view('laporan.edit', compact('laporan', 'lokasi'));
    }

    public function update(Request $request, $id)
    {
        $laporan = Laporan::findOrFail($id);

        if ($laporan->user_id !== Auth::id()) {
            abort(403, 'Dilarang!');
        }

        $request->validate([
            'lokasi_sensor_id' => 'required',
            'ketinggian_air' => 'required|numeric',
            'deskripsi' => 'required',
            'foto_bukti' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048', 
        ]);

        if ($request->hasFile('foto_bukti')) {
            if($laporan->foto_bukti) {
                Storage::disk('public')->delete($laporan->foto_bukti);
            }
            $path = $request->file('foto_bukti')->store('bukti_banjir', 'public');
            $laporan->foto_bukti = $path;
        }

        $status = $this->hitungRisikoManual($request->ketinggian_air);

        $laporan->update([
            'lokasi_sensor_id' => $request->lokasi_sensor_id,
            'ketinggian_air' => $request->ketinggian_air,
            'deskripsi' => $request->deskripsi,
            'status_risiko' => $status,
        ]);

        return redirect()->route('laporan.index')->with('success', 'Laporan diperbarui!');
    }

    // --- 5. HAPUS DATA ---
    public function destroy($id)
    {
        $laporan = Laporan::findOrFail($id);

        if (Auth::user()->role !== 'admin' && $laporan->user_id !== Auth::id()) {
            abort(403, 'Anda tidak berhak.');
        }

        if($laporan->foto_bukti) {
            Storage::disk('public')->delete($laporan->foto_bukti);
        }

        $laporan->delete();

        return back()->with('success', 'Laporan dihapus.');
    }

    
    private function hitungRisikoManual($cm)
    {
        if ($cm > 200) {
            return 'BAHAYA';
        } elseif ($cm >= 150) { 
            return 'WASPADA';
        } else {
            return 'AMAN';
        }
    }
}