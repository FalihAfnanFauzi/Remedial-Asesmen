@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row">
        @if(session('success'))
        <div class="col-12 mb-3">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
        @endif

        @if($errors->any())
        <div class="col-12 mb-3">
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif

        <div class="col-md-4">
            <div class="card card-custom mb-4">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0"><i class="fa-solid fa-pen-nib me-2"></i>Buat Laporan Baru</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('laporan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label">Lokasi Pantauan</label>
                            <select name="lokasi_sensor_id" class="form-select" required>
                                <option value="">-- Pilih Titik Lokasi --</option>
                                @foreach($lokasi as $l)
                                    <option value="{{ $l->id }}">{{ $l->nama_lokasi }} ({{ $l->kecamatan }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ketinggian Air (cm)</label>
                            <input type="number" name="ketinggian_air" class="form-control" placeholder="Contoh: 150" required>
                            <small class="text-muted" style="font-size: 11px;">Status risiko akan dihitung otomatis.</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deskripsi Kondisi</label>
                            <textarea name="deskripsi" class="form-control" rows="3" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Foto Bukti (Wajib)</label>
                            <input type="file" name="foto_bukti" class="form-control" accept=".jpg,.jpeg,.png,.pdf" required>
                        </div>

                        <button type="submit" class="btn btn-smart w-100 fw-bold">
                            <i class="fa-solid fa-paper-plane me-2"></i>Kirim Laporan
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card card-custom">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0 text-dark">Riwayat Laporan Masuk</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Waktu</th>
                                    <th>Lokasi</th>
                                    <th width="25%">Deskripsi</th>
                                    <th>Tinggi Air</th>
                                    <th>Status</th>
                                    <th>Foto</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($laporans as $row)
                                <tr>
                                    <td>{{ $row->created_at->diffForHumans() }}</td>
                                    <td>
                                        <strong>{{ $row->lokasiSensor->nama_lokasi ?? 'Lokasi Dihapus' }}</strong><br>
                                        <small class="text-muted">Oleh: {{ $row->user->name }}</small>
                                    </td>
                                    <td>{{ $row->deskripsi }}</td>
                                    <td>{{ $row->ketinggian_air }} cm</td>
                                    <td>
                                        @if($row->status_risiko == 'BAHAYA')
                                            <span class="badge bg-danger">BAHAYA</span>
                                        @elseif($row->status_risiko == 'WASPADA')
                                            <span class="badge bg-warning text-dark">WASPADA</span>
                                        @else
                                            <span class="badge bg-success">NORMAL</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($row->foto_bukti)
                                            @php $ext = pathinfo($row->foto_bukti, PATHINFO_EXTENSION); @endphp
                                            @if(strtolower($ext) == 'pdf')
                                                <a href="{{ asset('storage/'.$row->foto_bukti) }}" target="_blank" class="badge bg-danger text-decoration-none">PDF</a>
                                            @else
                                                <img src="{{ asset('storage/'.$row->foto_bukti) }}" width="50" class="rounded border" onclick="window.open(this.src)" style="cursor: pointer;">
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            @if(Auth::id() == $row->user_id)
                                                <a href="{{ route('laporan.edit', $row->id) }}" class="btn btn-sm btn-outline-warning"><i class="fa-solid fa-pencil"></i></a>
                                            @endif
                                            @if(Auth::id() == $row->user_id || Auth::user()->role == 'admin')
                                                <form action="{{ route('laporan.destroy', $row->id) }}" method="POST" onsubmit="return confirm('Hapus?');">
                                                    @csrf @method('DELETE')
                                                    <button class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="7" class="text-center py-4 text-muted">Belum ada laporan.</td></tr>
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