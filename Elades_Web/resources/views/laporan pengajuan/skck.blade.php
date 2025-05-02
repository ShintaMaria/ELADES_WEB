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
                <h6 class="m-0 font-weight-bold text-primary">Daftar Laporan SKCK</h6>

                <!-- Tempat baru untuk search box -->
                <div id="customSearchContainer"></div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Waktu Pengajuan</th>
                                <th>Nama Pengaju</th>
                                <th>Alamat</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($laporanSKCK)
                            @foreach($laporanSKCK as $laporan)
                            <tr id="row-{{ $laporan->id }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $laporan->created_at->format('d/m/Y H:i') }}</td>
                                <td>{{ $laporan->pengajuan }}</td>
                                <td>{{ $laporan->alamat }}</td>
                                <td id="status-{{ $laporan->id }}">{{ $laporan->status ?? 'Baru' }}</td>
                                <td>
                                    <button onclick="tolak({{ $laporan->id }})" class="btn btn-danger btn-sm">Tolak</button><br>
                                    <button onclick="ubahStatus({{ $laporan->id }}, 'Sedang Diproses')" class="btn btn-primary btn-sm">Review</button><br>
                                    <button onclick="ubahStatus({{ $laporan->id }}, 'Selesai')" class="btn btn-success btn-sm">Selesai</button>
                                </td>
                            </tr>
                            @endforeach
                            @endisset
                        </tbody>
                    </table>

                    <script>
                        function ubahStatus(id, statusBaru) {
                            fetch(`/laporan-skck/${id}/update-status`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({ status: statusBaru })
                            }).then(response => response.json()).then(data => {
                                if (data.success) {
                                    document.getElementById(`status-${id}`).innerText = statusBaru;
                                }
                            }).catch(error => console.error('Error:', error));
                        }

                        function tolak(id) {
                            let alasan = prompt("Masukkan alasan penolakan:");
                            if (alasan) {
                                fetch(`/laporan-skck/${id}/update-status`, {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    },
                                    body: JSON.stringify({ status: 'Ditolak - ' + alasan })
                                }).then(response => response.json()).then(data => {
                                    if (data.success) {
                                        document.getElementById(`status-${id}`).innerText = "Ditolak - " + alasan;
                                    }
                                }).catch(error => console.error('Error:', error));
                            }
                        }
                    </script>
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

<!-- JavaScript -->
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
