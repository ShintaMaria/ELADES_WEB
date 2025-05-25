@extends('dashboard.layouts.plain')
@section('content')

<div class="container-fluid">
    <div class="container-xl px-4 mt-4">

        <!-- notifikasi sukses -->
        @if(session('profile_update'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('profile_update') }}
            </div>
        @endif

        <!-- notifikasi gagal -->
        @if($errors->any())
            <div class="alert alert-danger" role="alert">
                @foreach ($errors->all() as $error)
                    <div>{{ trim($error) }}</div>
                @endforeach
            </div>
        @endif

        @if(session('profile_gagal'))
            <div class="alert alert-danger" role="alert">
                {{ session('profile_gagal') }}
            </div>
        @endif

        <hr class="mt-0 mb-4">

        <div class="row">
            <!-- FOTO PROFIL -->
            <div class="col-xl-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-header fw-bold">Foto Profil</div>
                    <div class="card-body d-flex flex-column align-items-center">

                        @if($user->gambar)
                            <!-- tampilkan gambar profil jika ada -->
                            <img class="rounded-circle shadow-sm mb-3"
                                 src="{{ asset('uploads/profilweb/' . $user->gambar) }}"
                                 style="width: 180px; height: 180px; object-fit: cover; border: 3px solid #dee2e6;">
                        @else
                            <!-- tampilkan icon user jika tidak ada gambar -->
                            <div class="d-flex justify-content-center align-items-center rounded-circle shadow-sm mb-3"
                                 style="width: 180px; height: 180px; background-color: #e9ecef; border: 3px solid #dee2e6;">
                                <i class="fas fa-user fa-5x text-secondary"></i>
                            </div>
                        @endif

                        <div class="small text-muted mb-3">Format JPG, JPEG, atau PNG.(Maks:2MB)</div>

                        <!-- Form Upload Foto -->
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

                        <!-- Form Hapus Foto (dipisah) -->
                        @if($user->gambar)
                        <!-- Tombol untuk memicu modal -->
                        <button type="button" class="btn btn-danger w-100 mt-2 px-3" data-toggle="modal" data-target="#deletePhotoModal">
                            <i class="fas fa-trash me-1"></i> Hapus Foto
                        </button>

                        <!-- Modal Konfirmasi Hapus Foto -->
                        <div class="modal fade" id="deletePhotoModal" tabindex="-1" role="dialog" aria-labelledby="deletePhotoModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deletePhotoModalLabel">Konfirmasi Hapus</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">Apakah Anda yakin ingin menghapus foto profil ini?</div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                        <form method="POST" action="{{ route('profile.deletePhoto') }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fas fa-trash me-1"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                    </div>
                </div>
            </div>

            <!-- PENGATURAN AKUN -->
            <div class="col-xl-8">
                <!-- CHART PENGGANTIAN EMAIL -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header fw-bold">Ganti Email</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('profile.updateEmail') }}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label" for="current_email">Email Saat Ini</label>
                                <input type="email" class="form-control" value="{{ $user->email }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="new_email">Email Baru</label>
                                <input type="email" name="new_email" class="form-control @error('new_email') is-invalid @enderror" required>
                                @error('new_email')
                                    <div class="invalid-feedback">
                                        {{ trim($message) }}
                                    </div>
                                @enderror
                                <div class="form-text text-muted mt-1 small">Email harus menggunakan domain @gmail.com</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="current_password">Konfirmasi Password</label>
                                <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" required>
                                @error('current_password')
                                    <div class="invalid-feedback">
                                        {{ trim($message) }}
                                    </div>
                                @enderror
                            </div>
                            <button class="btn btn-info text-white" type="submit">
                                <i class="fas fa-envelope me-1"></i> Ganti Email
                            </button>
                        </form>
                    </div>
                </div>

                <!-- CHART PENGGANTIAN PASSWORD -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header fw-bold">Ganti Password</div>
                    <div class="card-body">
                        <!-- form ganti password -->
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

<script src="{{ asset('dashboard/assets/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{ asset('dashboard/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('dashboard/assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
<script src="{{ asset('dashboard/assets/js/sb-admin-2.min.js')}}"></script>
<script src="{{ asset('dashboard/assets/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('dashboard/assets/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
@endsection