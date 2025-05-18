@extends('dashboard/layouts.template')
@section('content')

<!-- Page Wrapper -->
<div id="wrapper">
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 style="margin-top: 0px;">Layanan Aspirasi</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Pengaduan Infrastruktur</li>
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
                                <th>Nama</th>
                                <th>Jenis Infrastruktur</th>
                                <th>Tanggal Kejadian</th>
                                <th>Deskripsi</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($infrastruktur)
                            @foreach($infrastruktur as $i)
                            <tr>
                                <td>{{ $i->no_pengaduan }}</td>
                                <td>{{ $i->nama }}</td>
                                <td>{{ $i->jenis_infrastruktur }}</td>
                                <td>{{ $i->tanggal_kejadian }}</td>
                                <td>{{ $i->deskripsi }}</td>
                                 <td> <span class="badge badge-warning">{{ $i->status }}</span> </td>
                                <td>
                                    <!-- Tombol yang membuka modal detail -->
                                    <button class="btn btn-primary btn-sm mb-1" data-toggle="modal" data-target="#detailModal{{ $i->no_pengaduan }}">Detail</button>
                                     <button class="btn btn-success btn-sm mb-1" data-toggle="modal" data-target="#selesaiModal{{ $i->no_pengaduan }}">Selesai</button>
                                    <button class="btn btn-danger btn-sm mb-1" data-toggle="modal" data-target="#tolakModal{{ $i->no_pengaduan }}">Tolak</button>
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
    <!-- /.container-fluid -->
</div>
<!-- End of Page Wrapper -->

<!-- Modal Detail untuk setiap pengajuan -->
@isset($infrastruktur)
@foreach($infrastruktur as $i)
<div class="modal fade" id="detailModal{{ $i->no_pengaduan }}" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel{{ $i->no_pengaduan }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel{{ $i->no_pengaduan }}">Detail Pengaduan Infrastruktur #{{ $i->no_pengaduan }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-bordered">
                            <tr>
                                <th>No Pengaduan</th>
                                <td>{{ $i->no_pengaduan }}</td>
                            </tr>
                            <tr>
                                <th>Tipe Pengaduan</th>
                                <td>{{ $i->kode_pengaduan }}</td>
                            </tr>
                            <tr>
                                <th>Nama</th>
                                <td>{{ $i->nama }}</td>
                            </tr>
                            <tr>
                                <th>NIK</th>
                                <td>{{ $i->nik }}</td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td>{{ $i->alamat ?? '-' }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-bordered">
                            <tr>
                                <th>Jenis Infrastruktur</th>
                                <td>{{ $i->jenis_infrastruktur ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Kejadian</th>
                                <td>{{ $i->tanggal_kejadian ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Deskripsi</th>
                                <td>{{ $i->deskripsi ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Lokasi</th>
                                <td>{{ $i->lokasi ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    @if($i->status == 'Diproses')
                                        <span class="badge badge-warning">Diproses</span>
                                    @elseif($i->status == 'selesai')
                                        <span class="badge badge-success">Selesai</span>
                                    @elseif($i->status == 'ditolak')
                                        <span class="badge badge-danger">Ditolak</span>
                                    @else
                                        <span class="badge badge-secondary">{{ $i->status }}</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-12">
                        <h6 class="font-weight-bold">Dokumen Pendukung:</h6>
                        <div class="row">
                            @if(isset($i->file) && !empty($i->file))
                            <div class="col-md-4 mb-3">
                                <div class="card">
                                    <div class="card-header">Dokumen Infrastruktur</div>
                                    <div class="card-body text-center">
                                        <img src="{{ asset('uploads/pengaduan/'.$i->file) }}"
                                             class="img-thumbnail" style="max-height: 150px;"
                                             alt="Dokumen infrastruktur"
                                             data-toggle="modal"
                                             data-target="#imageModal{{ $i->no_pengaduan }}_file"
                                             style="cursor: pointer;">
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-between">
            </div>
        </div>
    </div>
</div>

<!-- Modal Preview Gambar -->
@if(isset($i->file) && !empty($i->file))
<div class="modal fade" id="imageModal{{ $i->no_pengaduan }}_file" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Preview Dokumen Infrastruktur</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img src="{{ asset('uploads/pengaduan/'.$i->file) }}" class="img-fluid" alt="Dokumen Infrastruktur">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endif
{{-- Modal Selesai --}}
<div class="modal fade" id="selesaiModal{{ $i->no_pengaduan }}" tabindex="-1" role="dialog" aria-labelledby="selesaiModalLabel{{ $i->no_pengaduan }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="POST" action="{{ route('infrastruktur.selesai', $i->no_pengaduan) }}">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="selesaiModalLabel{{ $i->no_pengaduan }}">Selesai Pesan Untuk Id Pengaduan : {{ $i->no_pengaduan }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="alasan">Apakah anda yakin ingin mengonfirmasi pengaduan ini?</label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Ya, Selesai</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Modal Tolak -->
<div class="modal fade" id="tolakModal{{ $i->no_pengaduan }}" tabindex="-1" role="dialog" aria-labelledby="tolakModalLabel{{ $i->no_pengaduan }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="POST" action="{{ route('infrastruktur.tolak', $i->no_pengaduan) }}">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tolakModalLabel{{ $i->no_pengaduan }}">Tolak Pesan Untuk Id Pengaduan : {{ $i->no_pengaduan }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="alasan">Alasan:</label>
                    <textarea name="alasan" class="form-control" required placeholder="Masukkan alasan penolakan"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Ya, Tolak</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endforeach
@endisset

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Bootstrap core JavaScript-->
<script src="{{ asset('dashboard/assets/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{ asset('dashboard/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ session('error') }}',
            confirmButtonColor: '#d33',
            confirmButtonText: 'Tutup'
        });
    @endif

</script>

@endsection
