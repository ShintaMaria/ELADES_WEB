@extends('dashboard/layouts.template')
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

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <!-- Header dengan judul dan search box -->
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <a href="#" class="btn btn-primary btn-sm">Tambah Artikel Terbaru</a>
                    <!-- Tempat baru untuk search box -->
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
                    <td>{{ Str::limit($artikel->isi, 50) }}</td>
                    <td>{{ Str::limit($artikel->link, 50) }}</td>
                    <td>{{ $artikel->created_at ? $artikel->created_at->format('d-m-Y') : '-' }}</td>
                    <td>
                        
                    <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                    <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                    </td>
                </tr>
                @endforeach
                @endisset
            </tbody>
        </table>
    </div>
</div>


        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

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
                lengthChange: false // Menghilangkan opsi "Show X entries"
            });

            // Memindahkan search box ke dalam #customSearchContainer
            $('#dataTable_filter').appendTo("#customSearchContainer");

            // Menyesuaikan tampilan search box agar lebih rapi
            $('#customSearchContainer input').addClass('form-control').attr('placeholder', 'Cari data...');
            $('#customSearchContainer label').contents().filter(function () {
                return this.nodeType === 3;
            }).remove(); // Menghapus label default DataTables
        });
    </script>

@endsection


