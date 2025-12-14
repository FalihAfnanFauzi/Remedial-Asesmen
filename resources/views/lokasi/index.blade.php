@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 mb-4">
            <h2 class="fw-bold text-dark border-start border-5 border-danger ps-3">
                📍 Manajemen Titik Sensor
            </h2>
        </div>

        <div class="col-md-4">
            <div class="card card-custom mb-4">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">Tambah Titik Baru</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('lokasi.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nama Lokasi / Sungai</label>
                            <input type="text" name="nama_lokasi" class="form-control" placeholder="Cth: Bendung Katulampa" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kecamatan</label>
                            <input type="text" name="kecamatan" class="form-control" placeholder="Cth: Bogor Timur" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi Singkat</label>
                            <textarea name="deskripsi" class="form-control" rows="3" placeholder="Keterangan kondisi wilayah..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-smart w-100">
                            <i class="fa-solid fa-plus me-2"></i>Simpan Data
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card card-custom">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0 text-dark">Daftar Titik Pantau</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover mb-0 align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Nama Lokasi</th>
                                    <th>Kecamatan</th>
                                    <th width="15%" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($lokasi as $item)
                                <tr>
                                    <td>
                                        <strong>{{ $item->nama_lokasi }}</strong><br>
                                        <small class="text-muted">{{ $item->deskripsi }}</small>
                                    </td>
                                    <td>{{ $item->kecamatan }}</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            
                                            <a href="{{ route('lokasi.edit', $item->id) }}" class="btn btn-sm btn-outline-warning" title="Edit Data">
                                                <i class="fa-solid fa-pencil"></i>
                                            </a>

                                            <form action="{{ route('lokasi.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah anda yakin ingin menghapus lokasi ini? Data laporan terkait juga akan terhapus.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus Data">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center py-4 text-muted">
                                        Belum ada data lokasi sensor.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection