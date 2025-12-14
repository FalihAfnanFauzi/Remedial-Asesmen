@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-custom shadow-sm">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0"><i class="fa-solid fa-pen-to-square me-2"></i>Edit Laporan Banjir</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('laporan.update', $laporan->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') <div class="mb-3">
                            <label class="form-label">Lokasi Pantauan</label>
                            <select name="lokasi_sensor_id" class="form-select" required>
                                @foreach($lokasi as $l)
                                    <option value="{{ $l->id }}" {{ $laporan->lokasi_sensor_id == $l->id ? 'selected' : '' }}>
                                        {{ $l->nama_lokasi }} ({{ $l->kecamatan }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ketinggian Air (cm)</label>
                            <input type="number" name="ketinggian_air" class="form-control" value="{{ $laporan->ketinggian_air }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deskripsi Kondisi</label>
                            <textarea name="deskripsi" class="form-control" rows="3" required>{{ $laporan->deskripsi }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ganti Bukti Foto (Opsional)</label>
                            <input type="file" name="foto_bukti" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                            <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto.</small>
                            
                            @if($laporan->foto_bukti)
                                <div class="mt-2 p-2 border rounded bg-light">
                                    <small class="d-block mb-1">Foto Saat Ini:</small>
                                    @if(str_ends_with($laporan->foto_bukti, '.pdf'))
                                        <span class="badge bg-danger">File PDF Terlampir</span>
                                    @else
                                        <img src="{{ asset('storage/'.$laporan->foto_bukti) }}" width="100" class="rounded">
                                    @endif
                                </div>
                            @endif
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('laporan.index') }}" class="btn btn-secondary">
                                <i class="fa-solid fa-arrow-left me-2"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-warning fw-bold">
                                <i class="fa-solid fa-save me-2"></i>Update Laporan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection