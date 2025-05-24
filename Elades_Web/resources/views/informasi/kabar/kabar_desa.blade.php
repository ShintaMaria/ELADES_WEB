@extends('dashboard.layouts.template')
@section('content')

<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="mt-0">Informasi</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Kabar Desa</li>
    </ol>
<!-- Notifikasi sukses -->
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <a href="{{ route('kabardesa.create') }}" class="btn btn-primary btn-sm">Tambah Kabar Desa Baru</a>
            <div id="customSearchContainer"></div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Deskripsi</th>
                            <th>Tanggal</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @isset($kabars)
                            @foreach($kabars as $kabar)
                            <tr>
                                <td>{{ $kabar->judul }}</td>
                                <td>{{ $kabar->deskripsi }}</td>
                                <td>{{ $kabar->tanggal }}</td>
                                <td>
                                    @if($kabar->gambar)
                                        <img src="{{ asset($kabar->gambar) }}" alt="Gambar Kabar Desa" width="200">
                                    @endif
                                </td>
                                <td>
                                    <div class="mb-2">
                                    <a href="{{ route('kabardesa.edit', $kabar->id) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    </div>

                                    <!-- Tombol untuk memicu modal -->
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{ $kabar->id }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>

                                    <!-- Modal Konfirmasi Hapus -->
                                    <div class="modal fade" id="deleteModal{{ $kabar->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $kabar->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel{{ $kabar->id }}">Konfirmasi Hapus</h5>
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">Apakah Anda yakin ingin menghapus kabar desa ini?</div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                                    <form action="{{ route('kabardesa.destroy', $kabar->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                            @endforeach
                        @endisset
                    </tbody>
                </table>
            </div>
        </div>
    </div>
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

<script>
    $(document).ready(function () {
        var table = $('#dataTable').DataTable({
            lengthChange: false
        });
        $('#dataTable_filter').appendTo("#customSearchContainer");
        $('#customSearchContainer input').addClass('form-control').attr('placeholder', 'Cari data...');
        $('#customSearchContainer label').contents().filter(function () {
            return this.nodeType === 3;
        }).remove();
    });
</script>

@endsection
