@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Detail Pengajuan Surat</h5>
                    <small>Dashboard / Pengajuan Surat / Detail Pengajuan Surat</small>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <h4 class="text-center mb-4">SURAT PENGANTAR SKCK</h4>

                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-end">ID Pengajuan</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" value="{{ $pengajuan->id }}" readonly>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-end">NIK</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" value="{{ $pengajuan->skck->nik }}" readonly>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-end">Nama Lengkap</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" value="{{ $pengajuan->skck->nama }}" readonly>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-end">Alamat</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" value="{{ $pengajuan->skck->alamat }}" readonly>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-end">Tempat Tgl Lahir</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" value="{{ $pengajuan->skck->tempat_tgl_lahir }}" readonly>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-end">Kebangsaan</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" value="{{ $pengajuan->skck->kebangsaan }}" readonly>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-end">Agama</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" value="{{ $pengajuan->skck->agama }}" readonly>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-end">Jenis Kelamin</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" value="{{ $pengajuan->skck->jenis_kelamin }}" readonly>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-end">Status Perkawinan</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" value="{{ $pengajuan->skck->status_perkawinan }}" readonly>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-end">Pekerjaan</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" value="{{ $pengajuan->skck->pekerjaan }}" readonly>
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <a href="{{ route('pengajuan-surat.skck.edit', $pengajuan->id) }}" class="btn btn-primary">
                                Edit Data
                            </a>
                        </div>
                    </div>

                    <hr>

                    <div class="text-center">
                        <h5>Mengetahui</h5>
                        <div class="d-flex justify-content-center gap-3 mt-3">
                            <a href="{{ route('pengajuan-surat.skck.preview', $pengajuan->id) }}" class="btn btn-info">
                                Preview
                            </a>
                            <a href="{{ route('pengajuan-surat.skck.cetak', $pengajuan->id) }}" class="btn btn-success" target="_blank">
                                Cetak
                            </a>
                        </div>
                    </div>

                    <hr>

                    <div class="mt-4">
                        <h5>Preview File</h5>
                        @if($pengajuan->ktp_file)
                            <p>File Surat</p>
                            <a href="{{ asset('storage/' . $pengajuan->ktp_file) }}" class="btn btn-outline-primary" target="_blank">
                                File Tersedia - Buka File
                            </a>
                        @else
                            <p class="text-muted">Tidak ada file yang diunggah</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
