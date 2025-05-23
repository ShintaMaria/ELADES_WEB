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
            <li class="breadcrumb-item active">Pengaduan Keamanan</li>
        </ol>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <!-- Header dengan judul dan search box -->
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary"></h6>
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
                                <th>Jenis Kasus</th>
                                <th>Tanggal Kejadian</th>
                                <th>Deskripsi</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($keamanan)
                            @foreach($keamanan as $k)
                            <tr>
                                <td>{{ $k->no_pengaduan }}</td>
                                <td>{{ $k->nama }}</td>
                                <td>{{ $k->jenis_kasus }}</td>
                                <td>{{ $k->tanggal }}</td>
                                <td>{{ $k->deskripsi }}</td>
                                <td> <span class="badge badge-warning">{{ $k->status }}</span> </td>
                                <td>
                                    <button class="btn btn-primary btn-sm mb-1" data-toggle="modal" data-target="#detailModal{{ $k->no_pengaduan }}">Detail</button>
                                    <button class="btn btn-success btn-sm mb-1" data-toggle="modal" data-target="#selesaiModal{{ $k->no_pengaduan }}">Selesai</button>
                                    <button class="btn btn-danger btn-sm mb-1" data-toggle="modal" data-target="#tolakModal{{ $k->no_pengaduan }}">Tolak</button>
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
@isset($keamanan)
@foreach($keamanan as $k)
<div class="modal fade" id="detailModal{{ $k->no_pengaduan }}" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel{{ $k->no_pengaduan }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel{{ $k->no_pengaduan }}">Detail Pengaduan keamanan #{{ $k->no_pengaduan }}</h5>
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
                                <td>{{ $k->no_pengaduan }}</td>
                            </tr>
                            <tr>
                                <th>Tipe Pengaduan</th>
                                <td>{{ $k->kode_pengaduan }}</td>
                            </tr>
                            <tr>
                                <th>Nama</th>
                                <td>{{ $k->nama }}</td>
                            </tr>
                            <tr>
                                <th>NIK</th>
                                <td>{{ $k->nik }}</td>
                            </tr>
                            <tr>
                                <th>Jenis Kasus</th>
                                <td>{{ $k->jenis_kasus ?? '-' }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-bordered">
                            <tr>
                                <th>Deskripsi</th>
                                <td>{{ $k->deskripsi ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Kejadian</th>
                                <td>{{ $k->tanggal ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Waktu</th>
                                <td>{{ $k->waktu ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Lokasi Kejadian</th>
                                <td>{{ $k->lokasi_kejadian ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    @if($k->status == 'Diproses')
                                        <span class="badge badge-warning">Diproses</span>
                                    @elseif($k->status == 'selesai')
                                        <span class="badge badge-success">Selesai</span>
                                    @elseif($k->status == 'ditolak')
                                        <span class="badge badge-danger">Ditolak</span>
                                    @else
                                        <span class="badge badge-secondary">{{ $k->status }}</span>
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
                            @if(isset($k->file) && !empty($k->file))
                                @php
                                    // Handle format penyimpanan file
                                    $fileData = $k->file;
                                    
                                    // Jika format JSON array
                                    if (is_string($fileData) && Str::startsWith($fileData, '[')) {
                                        $files = json_decode($fileData, true);
                                        $file = is_array($files) ? $files[0] : $fileData;
                                    }
                                    // Jika format JSON string
                                    elseif (is_string($fileData) && Str::startsWith($fileData, '"')) {
                                        $file = json_decode($fileData);
                                    }
                                    // Jika sudah string biasa
                                    else {
                                        $file = $fileData;
                                    }
                                    
                                    // Bersihkan nama file
                                    $file = trim($file, '[]"\'');
                                    $publicPath = 'uploads/pengaduan/'.$file;
                                    $fullPath = public_path($publicPath);
                                @endphp
                                
                                @if(!empty($file) && file_exists($fullPath))
                                <div class="col-md-4 mb-3">
                                    <div class="card">
                                        <div class="card-header">Dokumen keamanan</div>
                                        <div class="card-body text-center">
                                            <img src="{{ asset($publicPath) }}"
                                                 class="img-thumbnail" style="max-height: 150px;"
                                                 alt="Dokumen keamanan"
                                                 data-toggle="modal"
                                                 data-target="#imageModal{{ $k->no_pengaduan }}_file"
                                                 style="cursor: pointer;">
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="alert alert-warning">
                                    @if(empty($file))
                                        Nama file kosong
                                    @else
                                        File tidak ditemukan: {{ $file }}<br>
                                        Path: {{ $fullPath }}<br>
                                        URL Publik: {{ asset($publicPath) }}
                                    @endif
                                </div>
                                @endif
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
@if(isset($k->file) && !empty($k->file))
    @php
        // Gunakan logika yang sama seperti di atas
        $fileData = $k->file;
        if (is_string($fileData) && Str::startsWith($fileData, '[')) {
            $files = json_decode($fileData, true);
            $file = is_array($files) ? $files[0] : $fileData;
        }
        elseif (is_string($fileData) && Str::startsWith($fileData, '"')) {
            $file = json_decode($fileData);
        }
        else {
            $file = $fileData;
        }
        $file = trim($file, '[]"\'');
        $publicPath = 'uploads/pengaduan/'.$file;
    @endphp
    <div class="modal fade" id="imageModal{{ $k->no_pengaduan }}_file" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Preview Dokumen keamanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <img src="{{ asset($publicPath) }}" class="img-fluid" alt="Dokumen keamanan">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endif

{{-- Modal Selesai --}}
<div class="modal fade" id="selesaiModal{{ $k->no_pengaduan }}" tabindex="-1" role="dialog" aria-labelledby="selesaiModalLabel{{ $k->no_pengaduan }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="POST" action="{{ route('keamanan.selesai', $k->no_pengaduan) }}">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="selesaiModalLabel{{ $k->no_pengaduan }}">Selesai Pesan Untuk Id Pengaduan : {{ $k->no_pengaduan }}</h5>
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
<div class="modal fade" id="tolakModal{{ $k->no_pengaduan }}" tabindex="-1" role="dialog" aria-labelledby="tolakModalLabel{{ $k->no_pengaduan }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="POST" action="{{ route('keamanan.tolak', $k->no_pengaduan) }}">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tolakModalLabel{{ $k->no_pengaduan }}">Tolak Pesan Untuk Id Pengaduan : {{ $k->no_pengaduan }}</h5>
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