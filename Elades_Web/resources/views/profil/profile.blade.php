@extends('dashboard.layouts.plain')
@section('content')

<div class="container-fluid">
    <div class="container-xl px-4 mt-4">

        {{-- notifikasi sukses --}}
        @if(session('profile_update'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('profile_update') }}
            </div>
        @endif

        {{-- notifikasi gagal --}}
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                @foreach ($errors->all() as $error)
                    <div>{{ trim($error) }}</div>
                @endforeach
            </div>
        @endif

        @if(session('profile_gagal'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('profile_gagal') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <hr class="mt-0 mb-4">

        <div class="row">
            {{-- FOTO PROFIL --}}
            <div class="col-xl-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-header fw-bold">Foto Profil</div>
                    <div class="card-body d-flex flex-column align-items-center">

                        @if($user->gambar)
                            {{-- tampilkan gambar profil jika ada --}}
                            <img class="rounded-circle shadow-sm mb-3"
                                 src="{{ asset('storage/gambar_profil/' . $user->gambar) }}"
                                 alt="Foto Profil"
                                 style="width: 180px; height: 180px; object-fit: cover; border: 3px solid #dee2e6;">
                        @else
                            {{-- tampilkan icon user jika tidak ada gambar --}}
                            <div class="d-flex justify-content-center align-items-center rounded-circle shadow-sm mb-3"
                                 style="width: 180px; height: 180px; background-color: #e9ecef; border: 3px solid #dee2e6;">
                                <i class="fas fa-user fa-5x text-secondary"></i>
                            </div>
                        @endif

                        <div class="small text-muted mb-3">Format JPG, JPEG, atau PNG.(Maks:2MB)</div>

                        {{-- Form Upload Foto --}}
                        <form method="POST" action="{{ route('profile.updatePhoto') }}" enctype="multipart/form-data" class="w-100 px-3 mb-2">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label w-100 text-center" for="foto">Upload Foto Baru</label>
                                <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" accept="image/*" required>
                                @error('foto')
                                    <div class="invalid-feedback text-center">
                                        {{ trim($message) }}
                                    </div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between">
                                <button class="btn btn-primary w-100" type="submit">
                                    <i class="fas fa-upload me-1"></i> Upload Foto
                                </button>
                            </div>
                        </form>

                        {{-- Form Hapus Foto (dipisah) --}}
                        @if($user->gambar)
                        <form method="POST" action="{{ route('profile.deletePhoto') }}" class="mt-2 px-3 w-100">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger w-100" type="submit" onclick="return confirm('Yakin ingin menghapus foto profil?')">
                                <i class="fas fa-trash me-1"></i> Hapus Foto
                            </button>
                        </form>
                        @endif

                    </div>
                </div>
            </div>

            {{-- PENGATURAN AKUN --}}
            <div class="col-xl-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-header fw-bold">Pengaturan Akun</div>
                    <div class="card-body">

                        {{-- Email --}}
                        <div class="mb-4">
                            <label class="form-label" for="inputEmailAddress">Email</label>
                            <input class="form-control" id="inputEmailAddress" type="email" value="{{ $user->email }}" readonly>
                        </div>

                        {{-- Form Ganti Password --}}
                        <form method="POST" action="{{ route('profile.updatePassword') }}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label" for="current_password">Password Lama</label>
                                <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" required>
                                @error('current_password')
                                    <div class="invalid-feedback">
                                        {{ trim($message) }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="new_password">Password Baru</label>
                                <input type="password" name="new_password" class="form-control @error('new_password') is-invalid @enderror" required>
                                @error('new_password')
                                    <div class="invalid-feedback">
                                        {{ trim($message) }}
                                    </div>
                                @enderror
                                <div class="form-text text-muted mt-1 small">Password minimal 6 karakter</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="new_password_confirmation">Konfirmasi Password Baru</label>
                                <input type="password" name="new_password_confirmation" class="form-control @error('new_password_confirmation') is-invalid @enderror" required>
                                @error('new_password_confirmation')
                                    <div class="invalid-feedback">
                                        {{ trim($message) }}
                                    </div>
                                @enderror
                            </div>
                            <button class="btn btn-warning" type="submit">
                                <i class="fas fa-key me-1"></i> Ganti Password
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection