@extends('dashboard.layouts.template')

@section('content')

<!-- Page Wrapper -->
<div id="wrapper">
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 style="margin-top: 0px;">Informasi</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Artikel Terkini</li>
        </ol>

        <!-- Notifikasi sukses -->
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <a href="{{ route('artikels.create') }}" class="btn btn-primary btn-sm">Tambah Artikel Terbaru</a>
                <div id="customSearchContainer"></div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Deskripsi</th>
                                <th>Link</th>
                                <th>Dibuat Pada</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($artikels)
                            @foreach($artikels as $artikel)
                            <tr>
                                <td>{{ $artikel->judul }}</td>
                                <td>{{ \Illuminate\Support\Str::limit($artikel->isi, 50) }}</td>
                                <td>{{ \Illuminate\Support\Str::limit($artikel->link, 50) }}</td>
                                <td>{{ $artikel->created_at ? $artikel->created_at->format('d-m-Y') : '-' }}</td>
                                <td>
                                    <!-- Tombol Edit -->
                                    <div class="mb-2">
                                    <a href="{{ route('artikels.edit', $artikel->id) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    </div>

                                    <!-- Tombol Hapus dengan Modal -->
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{ $artikel->id }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>

                                    <!-- Modal Konfirmasi Hapus -->
                                    <div class="modal fade" id="deleteModal{{ $artikel->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $artikel->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel{{ $artikel->id }}">Konfirmasi Hapus</h5>
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">Apakah Anda yakin ingin menghapus artikel ini?</div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                                    <form action="{{ route('artikels.destroy', $artikel->id) }}" method="POST">
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
</div>

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- FontAwesome (pastikan sudah ada) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<!-- Bootstrap core JavaScript-->
<script src="{{ asset('dashboard/assets/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{ asset('dashboard/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('dashboard/assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('dashboard/assets/js/sb-admin-2.min.js')}}"></script>

<!-- Page level plugins -->
<script src="{{ asset('dashboard/assets/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('dashboard/assets/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

<!-- Page level custom scripts -->
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
