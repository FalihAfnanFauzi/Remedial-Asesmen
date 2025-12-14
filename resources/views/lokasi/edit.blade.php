@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-custom shadow-sm">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0"><i class="fa-solid fa-map-location-dot me-2"></i>Edit Titik Sensor</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('lokasi.update', $lokasi->id) }}" method="POST">
                        @csrf
                        @method('PUT') <div class="mb-3">
                            <label>Nama Lokasi / Sungai</label>
                            <input type="text" name="nama_lokasi" class="form-control" value="{{ $lokasi->nama_lokasi }}" required>
                        </div>

                        <div class="mb-3">
                            <label>Kecamatan</label>
                            <input type="text" name="kecamatan" class="form-control" value="{{ $lokasi->kecamatan }}" required>
                        </div>

                        <div class="mb-3">
                            <label>Deskripsi Singkat</label>
                            <textarea name="deskripsi" class="form-control" rows="3" required>{{ $lokasi->deskripsi }}</textarea>
                        </div>

                        <div class="d-flex justify-content-between pt-2">
                            <a href="{{ route('lokasi.index') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-warning fw-bold">
                                <i class="fa-solid fa-check me-2"></i>Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection