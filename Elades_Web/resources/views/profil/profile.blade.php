@extends('dashboard.layouts.template')
@section('content')

<div class="container-fluid">
    <div class="container-xl px-4 mt-4">

        {{-- notifikasi sukses --}}
        @if(session('profile_update'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('profile_update') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- notifikasi gagal --}}
        @if(session('profile_gagal'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('profile_gagal') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <hr class="mt-0 mb-2">
        <div class="row">
            <div class="col-xl-4">
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Foto Profil</div>
                    <div class="card-body text-center mb-2">
                        <img class="img-account-profile img-fluid rounded-circle w-100"
                             src="{{ $user->gambar ? asset('storage/gambar/' . $user->gambar) : asset('gambar/avatar_profile.jpg') }}"
                             alt="Foto Profil" style="max-width: 200px; height: auto;">
                        <div class="small font-italic text-muted mb-4">JPG atau PNG</div>
                    </div>
                </div>
            </div>

            <div class="col-xl-8">
                <div class="card mb-4">
                    <div class="card-header">Pengaturan Akun</div>
                    <div class="card-body">

                        {{-- Form Upload Foto --}}
                        <form method="POST" action="{{ route('profile.updatePhoto') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="small mb-1" for="foto">Upload Foto Baru</label>
                                <input type="file" name="foto" class="form-control" accept="image/*" required>
                            </div>
                            <button class="btn btn-primary mb-3" type="submit">
                                <i class="fas fa-upload"></i> Upload Foto
                            </button>
                        </form>

                        {{-- Tampilkan Email (readonly) --}}
                        <div class="mb-3">
                            <label class="small mb-1" for="inputEmailAddress">Email</label>
                            <input class="form-control" id="inputEmailAddress" type="email" value="{{ $user->email }}" readonly>
                        </div>

                        {{-- Form Ganti Password --}}
                        <form method="POST" action="{{ route('profile.updatePassword') }}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="small mb-1" for="current_password">Password Lama</label>
                                <input type="password" name="current_password" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="new_password">Password Baru</label>
                                <input type="password" name="new_password" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="new_password_confirmation">Konfirmasi Password Baru</label>
                                <input type="password" name="new_password_confirmation" class="form-control" required>
                            </div>
                            <button class="btn btn-warning" type="submit">
                                <i class="fas fa-key"></i> Ganti Password
                            </button>
                        </form>

                        {{-- Tombol Logout --}}
                        <form method="POST" action="{{ route('logout') }}" class="mt-3">
                            @csrf
                            <button class="btn btn-danger" type="submit">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
