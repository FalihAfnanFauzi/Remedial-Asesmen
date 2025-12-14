@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 mb-4">
            <h2 class="fw-bold text-dark border-start border-5 border-danger ps-3">
                👤 Profil Pengguna
            </h2>
        </div>

        <div class="col-md-4">
            <div class="card card-custom border-0 shadow-sm text-center">
                <div class="card-body py-5">
                    <div class="mb-3">
                        <div class="d-inline-block rounded-circle bg-danger text-white d-flex align-items-center justify-content-center mx-auto" style="width: 100px; height: 100px; font-size: 40px;">
                            {{ substr($user->name, 0, 1) }} </div>
                    </div>
                    
                    <h4 class="fw-bold mb-0">{{ $user->name }}</h4>
                    <span class="badge bg-secondary mb-3">{{ ucfirst($user->role) }}</span>
                    
                    <div class="text-start mt-4 px-3">
                        <p class="mb-1 text-muted"><small>Email Terdaftar:</small></p>
                        <p class="fw-bold">{{ $user->email }}</p>
                        
                        <p class="mb-1 text-muted"><small>Bergabung Sejak:</small></p>
                        <p class="fw-bold">{{ $user->created_at->format('d M Y') }}</p>
                    </div>

                    <form method="POST" action="{{ route('logout') }}" class="mt-4">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger w-100 rounded-pill">
                            <i class="fa-solid fa-right-from-bracket me-2"></i>Log Out
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card card-custom border-0 shadow-sm">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0"><i class="fa-solid fa-gear me-2"></i>Update Informasi</h5>
                </div>
                <div class="card-body">
                    
                    <form method="post" action="{{ route('profile.update') }}">
                        @csrf
                        @method('patch')

                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alamat Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                        </div>

                        <button type="submit" class="btn btn-smart px-4">
                            <i class="fa-solid fa-save me-2"></i>Simpan Perubahan
                        </button>

                        @if (session('status') === 'profile-updated')
                            <span class="text-success ms-3 fade-out"><i class="fa-solid fa-check"></i> Tersimpan!</span>
                        @endif
                    </form>

                    <hr class="my-4">

                    <h6 class="fw-bold text-danger mb-3">Ganti Password</h6>
                    <form method="post" action="{{ route('password.update') }}">
                        @csrf
                        @method('put')

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label text-muted">Password Saat Ini</label>
                                <input type="password" name="current_password" class="form-control">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label text-muted">Password Baru</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label text-muted">Konfirmasi</label>
                                <input type="password" name="password_confirmation" class="form-control">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-secondary btn-sm">
                            Update Password
                        </button>
                         @if (session('status') === 'password-updated')
                            <span class="text-success ms-3"><i class="fa-solid fa-check"></i> Password Berubah!</span>
                        @endif
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection