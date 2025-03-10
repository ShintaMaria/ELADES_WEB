@extends('dashboard.layouts.template')

@section('content')
<div class="container">
    <h1>Tambah Artikel</h1>
    <form action="{{ route('artikels.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" class="form-control" id="judul" name="judul" required>
        </div>
        <div class="mb-3">
            <label for="isi" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="isi" name="isi" required></textarea>
        </div>
        <div class="mb-3">
            <label for="link" class="form-label">Link</label>
            <input type="url" class="form-control" id="link" name="link">
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
