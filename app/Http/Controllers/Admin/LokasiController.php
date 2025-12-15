<?php

namespace App\Http\Controllers\Admin; 

use App\Http\Controllers\Controller;
use App\Models\LokasiSensor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LokasiController extends Controller
{
    // --- 1. Tampilkan Daftar & Form Tambah ---
    public function index()
    {
        // SATPAM: Usir kalau bukan admin
        if (Auth::user()->role !== 'admin') { abort(403, 'ANDA BUKAN ADMIN!'); }

        $lokasi = LokasiSensor::all();
        return view('lokasi.index', compact('lokasi'));
    }

    // --- 2. Simpan Lokasi Baru ---
    public function store(Request $request)
    {
        if (Auth::user()->role !== 'admin') { abort(403, 'ANDA BUKAN ADMIN!'); }

        $request->validate([
            'nama_lokasi' => 'required',
            'kecamatan' => 'required',
            'deskripsi' => 'required'
        ]);

        LokasiSensor::create($request->all());

        return redirect()->back()->with('success', 'Lokasi berhasil ditambahkan');
    }

    // --- 3. Form Edit Lokasi ---
    public function edit($id)
    {
        if (Auth::user()->role !== 'admin') { abort(403, 'ANDA BUKAN ADMIN!'); }

        $lokasi = LokasiSensor::findOrFail($id);
        return view('lokasi.edit', compact('lokasi'));
    }

    // --- 4. Proses Update Lokasi ---
    public function update(Request $request, $id)
    {
        if (Auth::user()->role !== 'admin') { abort(403, 'ANDA BUKAN ADMIN!'); }

        $request->validate([
            'nama_lokasi' => 'required',
            'kecamatan' => 'required',
            'deskripsi' => 'required'
        ]);

        $lokasi = LokasiSensor::findOrFail($id);
        $lokasi->update($request->all());

        return redirect()->route('lokasi.index')->with('success', 'Data Lokasi Berhasil Diupdate!');
    }

    // --- 5. Hapus Lokasi ---
    public function destroy($id)
    {
        if (Auth::user()->role !== 'admin') { abort(403, 'ANDA BUKAN ADMIN!'); }

        LokasiSensor::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Lokasi dihapus');
    }
}