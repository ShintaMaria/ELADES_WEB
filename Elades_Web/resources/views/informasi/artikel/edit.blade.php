@extends('dashboard.layouts.template')

@section('content')
<div class="container">
    <h1>Edit Artikel</h1>
    <form action="{{ route('artikels.update', $artikel->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" class="form-control" id="judul" name="judul" value="{{ $artikel->judul }}" required>
        </div>
        <div class="mb-3">
            <label for="isi" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="isi" name="isi" required>{{ $artikel->isi }}</textarea>
        </div>
        <div class="mb-3">
            <label for="link" class="form-label">Link</label>
            <input type="url" class="form-control" id="link" name="link" value="{{ $artikel->link }}">
        </div>
        <button type="submit" class="btn btn-primary px-4">
            <i class="fas fa-save mr-2"></i>Simpan
        </button>
        <a href="{{ route('artikels.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
