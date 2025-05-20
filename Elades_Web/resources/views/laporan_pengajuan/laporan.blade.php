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
        <form id="filterForm" class="form-inline mb-4">
            <div class="form-group mr-2">
                <label for="bulan" class="mr-2">Bulan</label>
                <select name="bulan" id="bulan" class="form-control">
                    <option value="">Semua</option>
                    @php
                        $bulanIndo = [
                            1 => 'Januari',
                            2 => 'Februari',
                            3 => 'Maret',
                            4 => 'April',
                            5 => 'Mei',
                            6 => 'Juni',
                            7 => 'Juli',
                            8 => 'Agustus',
                            9 => 'September',
                            10 => 'Oktober',
                            11 => 'November',
                            12 => 'Desember'
                        ];
                    @endphp
                    @foreach(range(1, 12) as $b)
                        <option value="{{ sprintf('%02d', $b) }}" {{ request('bulan') == sprintf('%02d', $b) ? 'selected' : '' }}>
                            {{ $bulanIndo[$b] }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mr-2">
                <label for="tahun" class="mr-2">Tahun</label>
                <select name="tahun" id="tahun" class="form-control">
                    <option value="">Semua</option>
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
            <button type="button" id="downloadBtn" class="btn btn-primary">
                <i class="fas fa-download fa-sm text-white-50"></i> Unduh Laporan
            </button>
        </form>

        <!-- Modal Konfirmasi Download -->
        <div class="modal fade" id="downloadModal" tabindex="-1" role="dialog" aria-labelledby="downloadModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="downloadModalLabel">Perhatian</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Laporan hanya dapat di unduh dengan priode satu bulan. Anda harus memilih <strong>bulan</strong> dan <strong>tahun</strong> tertentu untuk mengunduh laporan.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>

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

<script>
    $(document).ready(function () {
        var table = $('#dataTable').DataTable({
            "lengthMenu": [5, 10, 15, 20, 25],
            "pageLength": 5,
            "language": {
                "lengthMenu": "Tampilkan _MENU_",
                "search": "Cari:",
                "zeroRecords": "Data tidak ditemukan",
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                "infoEmpty": "Tidak ada data tersedia",
                "infoFiltered": "(disaring dari total _MAX_ entri)"
            }
        });

        $('#bulan, #tahun, #tipe').change(function() {
            var bulan = $('#bulan').val();
            var tahun = $('#tahun').val();
            var tipe = $('#tipe').val();
            
            table.columns().search('').draw();
            
            table.rows().every(function() {
                var row = this.node();
                var rowDate = $(row).find('td:eq(2)').text();
                var rowBulan = rowDate.split('-')[1];
                var rowTahun = rowDate.split('-')[0];
                var rowTipe = $(row).find('td:eq(3)').text();
                
                var showRow = true;
                
                if (bulan && rowBulan != bulan) {
                    showRow = false;
                }
                
                if (tahun && rowTahun != tahun) {
                    showRow = false;
                }

                if (tipe && rowTipe != tipe) {
                    showRow = false;
                }
                
                this.nodes().to$().toggle(showRow);
            });
            
            table.draw();
        });

        $('#downloadBtn').click(function() {
            var bulan = $('#bulan').val();
            var tahun = $('#tahun').val();
            var tipe = $('#tipe').val();
            
            if (!bulan || !tahun) {
                $('#downloadModal').modal('show');
                return false;
            }
            
            var url = "{{ route('laporan_pengajuan.download') }}";
            url += "?bulan=" + bulan + "&tahun=" + tahun;
            if (tipe) {
                url += "&tipe=" + tipe;
            }
            
            window.location.href = url;
        });
    });
</script>
@endsection