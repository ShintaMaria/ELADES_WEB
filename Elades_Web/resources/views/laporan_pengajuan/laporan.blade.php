@extends('dashboard/layouts.template')
@section('content')

<div id="wrapper">
    <div class="container-fluid">
        <h1 style="margin-top: 0px;">Laporan Pengajuan Surat</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Laporan Pengajuan</li>
        </ol>

        <!-- Filter Form -->
        <form action="{{ route('laporan_pengajuan.download') }}" method="GET" class="form-inline mb-4">
            <div class="form-group mr-2">
                <label for="bulan" class="mr-2">Bulan</label>
                <select name="bulan" id="bulan" class="form-control" required>
                    @foreach(range(1, 12) as $b)
                        <option value="{{ sprintf('%02d', $b) }}" {{ request('bulan') == sprintf('%02d', $b) ? 'selected' : '' }}>
                            {{ DateTime::createFromFormat('!m', $b)->format('F') }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mr-2">
                <label for="tahun" class="mr-2">Tahun</label>
                <select name="tahun" id="tahun" class="form-control" required>
                    @php $now = date('Y'); @endphp
                    @for($t = $now; $t >= $now - 5; $t--)
                        <option value="{{ $t }}" {{ request('tahun') == $t ? 'selected' : '' }}>{{ $t }}</option>
                    @endfor
                </select>
            </div>
            <div class="form-group mr-2">
                <label for="tipe" class="mr-2">Tipe Surat</label>
                <select name="tipe" id="tipe" class="form-control">
                    <option value="">Semua</option>
                    @php
                        $tipeList = \App\Models\PengajuanSurat::distinct()->pluck('kode_surat');
                    @endphp
                    @foreach ($tipeList as $tipe)
                        <option value="{{ $tipe }}" {{ request('tipe') == $tipe ? 'selected' : '' }}>{{ $tipe }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-download fa-sm text-white-50"></i> Unduh Laporan
            </button>
        </form>

        <!-- Tabel -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary"></h6>
                <div id="customSearchContainer"></div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama Pemohon</th>
                                <th>Tanggal Pengajuan</th>
                                <th>Tipe Surat</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($laporan)
                            @foreach($laporan as $ps)
                            <tr>
                                <td>{{ $ps->id }}</td>
                                <td>{{ $ps->nama }}</td>
                                <td>{{ $ps->tanggal }}</td>
                                <td>{{ $ps->kode_surat }}</td>
                                <td>
                                    @if($ps->status == 'Diproses')
                                        <span class="badge badge-warning">Diproses</span>
                                    @elseif($ps->status == 'Selesai')
                                        <span class="badge badge-success">Selesai</span>
                                    @elseif($ps->status == 'Tolak')
                                        <span class="badge badge-danger">Tolak</span>
                                    @else
                                        <span class="badge badge-secondary">{{ $ps->status }}</span>
                                    @endif
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
<style>
    /* Atur posisi pencarian ke kanan */
    div.dataTables_filter {
        float: right;
        text-align: right;
    }
</style>
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
