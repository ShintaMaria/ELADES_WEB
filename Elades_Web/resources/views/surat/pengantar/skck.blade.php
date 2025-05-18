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
                                <th>Tipe Surat</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($skck)
                            @foreach($skck as $s)
                            <tr>
                                <td>{{ $s->no_pengajuan }}</td>
                                <td>{{ $s->nik }}</td>
                                <td>{{ $s->nama }}</td>
                                <td>{{ $s->kode_surat }}</td>
                                 <td> <span class="badge badge-warning">{{ $s->status }}</span> </td>
                                <td>
                                    <!-- Tombol yang membuka modal detail -->
                                    <button class="btn btn-primary btn-sm mb-1" data-toggle="modal" data-target="#detailModal{{ $s->no_pengajuan }}">Detail</button>
                                     <button class="btn btn-success btn-sm mb-1" data-toggle="modal" data-target="#selesaiModal{{ $s->no_pengajuan }}">Selesai</button>
                                    <button class="btn btn-danger btn-sm mb-1" data-toggle="modal" data-target="#tolakModal{{ $s->no_pengajuan }}">Tolak</button>
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
@isset($skck)
@foreach($skck as $s)
<div class="modal fade" id="detailModal{{ $s->no_pengajuan }}" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel{{ $s->no_pengajuan }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel{{ $s->no_pengajuan }}">Detail Pengajuan SKCK #{{ $s->no_pengajuan }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-bordered">
                            <tr>
                                <th>No Pengajuan</th>
                                <td>{{ $s->no_pengajuan }}</td>
                            </tr>
                            <tr>
                                <th>NIK</th>
                                <td>{{ $s->nik }}</td>
                            </tr>
                            <tr>
                                <th>Nama Pemohon</th>
                                <td>{{ $s->nama }}</td>
                            </tr>
                            <tr>
                                <th>Tipe Surat</th>
                                <td>{{ $s->kode_surat }}</td>
                            </tr>
                            <tr>
                                <th>Tempat Lahir</th>
                                <td>{{ $s->tempat_lahir ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Lahir</th>
                                <td>{{ $s->tanggal_lahir ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Jenis Kelamin</th>
                                <td>{{ $s->jenis_kelamin ?? '-' }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-bordered">
                            <tr>
                                <th>Alamat</th>
                                <td>{{ $s->alamat ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Agama</th>
                                <td>{{ $s->agama ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Status Perkawinan</th>
                                <td>{{ $s->status_perkawinan ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Pekerjaan</th>
                                <td>{{ $s->pekerjaan ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Kebangsaan</th>
                                <td>{{ $s->kebangsaan ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Username</th>
                                <td>{{ $s->username ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    @if($s->status == 'Diproses')
                                        <span class="badge badge-warning">Diproses</span>
                                    @elseif($s->status == 'selesai')
                                        <span class="badge badge-success">Selesai</span>
                                    @elseif($s->status == 'ditolak')
                                        <span class="badge badge-danger">Ditolak</span>
                                    @else
                                        <span class="badge badge-secondary">{{ $s->status }}</span>
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
                            @if(isset($s->file) && !empty($s->file))
                            <div class="col-md-4 mb-3">
                                <div class="card">
                                    <div class="card-header">Dokumen SKCK</div>
                                    <div class="card-body text-center">
                                        <img src="{{ asset('uploads/pengajuan/'.$s->file) }}"
                                             class="img-thumbnail" style="max-height: 150px;"
                                             alt="Dokumen SKCK"
                                             data-toggle="modal"
                                             data-target="#imageModal{{ $s->no_pengajuan }}_file"
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
                <div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
                {{-- <div>
                    <button type="button" class="btn btn-info" onclick="previewSurat({{ $s->no_pengajuan }})">Preview</button>
                    <button type="button" class="btn btn-primary" onclick="cetakSurat({{ $s->no_pengajuan }})">Cetak</button>
                </div> --}}
                <div>
                    <a href="{{ route('skck.preview', $s->no_pengajuan) }}" target="_blank" class="btn btn-info">Preview</a>
                    <a href="{{ route('skck.cetak', $s->no_pengajuan) }}" target="_blank" class="btn btn-primary">Cetak</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Preview Gambar -->
@if(isset($s->file) && !empty($s->file))
<div class="modal fade" id="imageModal{{ $s->no_pengajuan }}_file" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Preview Dokumen SKCK</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img src="{{ asset('uploads/pengajuan/'.$s->file) }}" class="img-fluid" alt="Dokumen SKCK">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endif
{{-- Modal Selesai --}}
<div class="modal fade" id="selesaiModal{{ $s->no_pengajuan }}" tabindex="-1" role="dialog" aria-labelledby="selesaiModalLabel{{ $s->no_pengajuan }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="POST" action="{{ route('skck.selesai', $s->no_pengajuan) }}">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="selesaiModalLabel{{ $s->no_pengajuan }}">Selesai Pesan Untuk Id Surat : {{ $s->no_pengajuan }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="alasan">Apakah anda yakin ingin mengonfirmasi surat ini?</label>
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
<div class="modal fade" id="tolakModal{{ $s->no_pengajuan }}" tabindex="-1" role="dialog" aria-labelledby="tolakModalLabel{{ $s->no_pengajuan }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="POST" action="{{ route('skck.tolak', $s->no_pengajuan) }}">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tolakModalLabel{{ $s->no_pengajuan }}">Tolak Pesan Untuk Id Surat : {{ $s->no_pengajuan }}</h5>
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

    // Fungsi untuk preview surat
    function previewSurat(id) {
        // Buka halaman preview di tab baru
        window.open('{{ url("skck/preview") }}/' + id, '_blank');
    }

    // Fungsi untuk cetak surat
    function cetakSurat(id) {
        // Buka halaman cetak di tab baru
        window.open('{{ url("skck/cetak") }}/' + id, '_blank');
    }

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
