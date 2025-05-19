@extends('dashboard.layouts.template')
@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Edit Kabar Desa</h1>
    <form action="{{ route('kabardesa.update', $kabardesa->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="judul">Judul</label>
            <input type="text" name="judul" class="form-control" value="{{ $kabardesa->judul }}" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="4" required>{{ $kabardesa->deskripsi }}</textarea>
        </div>

        <div class="mb-3">
            <label for="tanggal">Tanggal</label>
            <input type="date" name="tanggal" class="form-control" value="{{ $kabardesa->tanggal }}" required>
        </div>

        <div class="mb-3">
            <label>Gambar Saat Ini</label><br>
            @if($kabardesa->gambar && file_exists(public_path($kabardesa->gambar)))
                <img src="{{ asset($kabardesa->gambar) }}" alt="Gambar Kabar Desa" width="120"><br><br>
            @endif
            <input type="file" name="gambar" class="form-control" accept="image/jpeg,image/png,image/jpg">
        </div>

        <button type="submit" class="btn btn-primary px-4">
            <i class="fas fa-save mr-1"></i> Simpan
        </button>
        <a href="{{ route('kabardesa.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
<!-- FontAwesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<!-- DataTables Scripts -->
<script src="{{ asset('dashboard/assets/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{ asset('dashboard/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('dashboard/assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
<script src="{{ asset('dashboard/assets/js/sb-admin-2.min.js')}}"></script>
<script src="{{ asset('dashboard/assets/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('dashboard/assets/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
@endsection
