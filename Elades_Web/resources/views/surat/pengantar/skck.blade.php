@extends('dashboard/layouts.template')
@section('content')

<!-- Page Wrapper -->
<div id="wrapper">
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 style="margin-top: 0px;">Layanan Surat Pengantar SKCK</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Pengantar SKCK</li>
        </ol>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <!-- Header dengan judul dan search box -->
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary"></h6>

                <!-- Tempat baru untuk search box -->
                <div id="customSearchContainer"></div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css"/>
                            <tr>
                                <th>ID</th>
                                <th>NIK</th>
                                <th>Nama Pemohon</th>
                                <th>Tanggal Pengajuan</th>
                                <th>Tipe Surat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($skck)
                            @foreach($skck as $s)
                            <tr>
                                <td>{{ $s->id }}</td>
                                <td>{{ $s->nik }}</td>
                                <td>{{ $s->nama }}</td>
                                <td>{{ $s->tanggal }}</td>
                                <td>{{ $s->kode_surat }}</td>
                                <td>{{ $s->aksi }}
                                    <a href="{{ route('skck.show', $s->id) }}" class="btn btn-primary btn-sm mb-1">Detail</a>

                                    <form action="{{ route('skck.selesai', $s->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm mb-1">Selesai</button>
                                    </form>

                                    <!-- Tombol yang membuka modal -->
                                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#tolakModal{{ $s->id }}">Tolak
                                    </button>

                                </td>
                            </tr>
                            <!-- Modal Tolak -->
                            <div class="modal fade" id="tolakModal{{ $s->id }}" tabindex="-1" role="dialog" aria-labelledby="tolakModalLabel{{ $s->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <form method="POST" action="{{ route('skck.tolak', $s->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="tolakModalLabel{{ $s->id }}">Tolak Pesan Untuk Id Surat : {{ $s->id }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <label for="alasan">Alasan:</label>
                                        <textarea name="alasan" class="form-control" required placeholder="Masukkan alasan penolakan"></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-danger">Ya, Tolak</button>
                                    </div>
                                    </div>
                                </form>
                                </div>
                            </div>

                            @endforeach
                            @endisset
                        </tbody>
                    </table>

                </div>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('dashboard/assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('dashboard/assets/js/sb-admin-2.min.js')}}"></script>

<!-- Page level plugins -->
<script src="{{ asset('dashboard/assets/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('dashboard/assets/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

<!-- Page level untuk java scripts -->
<script>
    $(document).ready(function () {
      $('#dataTable').DataTable({
        "lengthMenu": [5, 10, 15, 20, 25],  // Dropdown: pilihan jumlah entri
        "pageLength": 5, // Default jumlah yang ditampilkan saat pertama kali
        "language": {
          "lengthMenu": "Tampilkan _MENU_",
          "search": "Cari:",
          "zeroRecords": "Data tidak ditemukan",
          "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
          "infoEmpty": "Tidak ada data tersedia",
          "infoFiltered": "(disaring dari total _MAX_ entri)"
        }
      });
    });
  </script>


@endsection
