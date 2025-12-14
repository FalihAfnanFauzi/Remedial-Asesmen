@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card card-custom bg-white border-start border-5 border-danger p-4">
            <h3>Selamat Datang, {{ Auth::user()->name }}!</h3>
            <p class="text-muted mb-0">
                Anda login sebagai: <strong>{{ ucfirst(Auth::user()->role) }}</strong>. 
                Sistem pemantauan banjir Kabupaten Bandung siap digunakan.
            </p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-custom bg-danger text-white mb-3">
            <div class="card-body text-center">
                <h1 class="display-4 fw-bold"><i class="fa-solid fa-triangle-exclamation"></i> 2</h1>
                <p class="mb-0">Titik Status BAHAYA</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-custom bg-warning text-dark mb-3">
            <div class="card-body text-center">
                <h1 class="display-4 fw-bold"><i class="fa-solid fa-bell"></i> 5</h1>
                <p class="mb-0">Titik Status WASPADA</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-custom bg-success text-white mb-3">
            <div class="card-body text-center">
                <h1 class="display-4 fw-bold"><i class="fa-solid fa-check-circle"></i> 12</h1>
                <p class="mb-0">Titik Status NORMAL</p>
            </div>
        </div>
    </div>

    <div class="col-md-6 mt-2">
        <a href="{{ route('laporan.index') }}" class="text-decoration-none">
            <div class="card card-custom h-100 hover-shadow">
                <div class="card-body text-center py-5">
                    <i class="fa-solid fa-bullhorn fa-3x text-danger mb-3"></i>
                    <h4 class="text-dark">Buat Laporan Banjir</h4>
                    <p class="text-muted">Laporkan kondisi terkini di lokasi anda beserta foto bukti.</p>
                </div>
            </div>
        </a>
    </div>

    @if(Auth::user()->role == 'admin')
    <div class="col-md-6 mt-2">
        <a href="{{ url('/lokasi') }}" class="text-decoration-none"> <div class="card card-custom h-100 hover-shadow">
                <div class="card-body text-center py-5">
                    <i class="fa-solid fa-map-location-dot fa-3x text-primary mb-3"></i>
                    <h4 class="text-dark">Kelola Titik Sensor</h4>
                    <p class="text-muted">Tambah atau update data lokasi sensor banjir (Khusus Admin).</p>
                </div>
            </div>
        </a>
    </div>
    @endif
</div>
@endsection