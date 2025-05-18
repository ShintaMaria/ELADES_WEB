@extends('dashboard.layouts.template')
@section('content')
<div class="container-fluid">
    <h1>Edit Kabar Desa</h1>
    <form action="{{ route('kabardesa.update', $kabardesa->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="judul" class="form-control" value="{{ $kabardesa->judul }}" required>
        </div>
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" required>{{ $kabardesa->deskripsi }}</textarea>
        </div>
        <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control" value="{{ $kabardesa->tanggal }}" required>
        </div>
        <div class="mb-3">
            <label>Gambar Saat Ini</label><br>
            @if($kabardesa->gambar && file_exists(public_path($kabardesa->gambar)))
                <img src="{{ asset($kabardesa->gambar) }}" alt="Gambar Kabar Desa" width="200"><br>
            @endif
            <input type="file" name="gambar" class="form-control mt-2">
        </div>
        <button type="submit" class="btn btn-primary px-4">
            <i class="fas fa-save mr-2"></i>Simpan
        </button>
        <a href="{{ route('kabardesa.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
