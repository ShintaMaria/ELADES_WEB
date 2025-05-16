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
                                {{-- <th>Tanggal Pengajuan</th> --}}
                                <th>Tipe Surat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($skck)
                            @foreach($skck as $s)
                            <tr id="row-{{ $s->id }}">
                                <td>{{ $s->no_pengajuan }}</td>
                                <td>{{ $s->nik }}</td>
                                <td>{{ $s->nama }}</td>
                                {{-- <td>{{ $s->tanggal }}</td> --}}
                                <td>{{ $s->kode_surat }}</td>
                                <td>
                                    <!-- Button Detail -->
                                    <button class="btn btn-primary btn-sm mb-1 btn-detail"
                                            data-id="{{ $s->id }}"
                                            data-toggle="modal"
                                            data-target="#detailModal">
                                        Detail
                                    </button>


                                    <!-- Button Selesai (memicu modal konfirmasi) -->
                                    <button class="btn btn-success btn-sm mb-1"
                                            data-toggle="modal"
                                            data-target="#selesaiModal"
                                            data-id="{{ $s->id }}">
                                        Selesai
                                    </button>

                                    <!-- Button Tolak -->
                                    <button class="btn btn-danger btn-sm"
                                            data-toggle="modal"
                                            data-target="#tolakModal"
                                            data-id="{{ $s->id }}">
                                        Tolak
                                    </button>
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

<!-- Modal Detail -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail Pengajuan SKCK</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>ID Pengajuan:</strong> <span id="detailId"></span></p>
                        <p><strong>Kode Surat:</strong> <span id="detailKodeSurat"></span></p>
                        <p><strong>Nama:</strong> <span id="detailNama"></span></p>
                        <p><strong>NIK:</strong> <span id="detailNik"></span></p>
                        <p><strong>Tempat Tanggal Lahir:</strong> <span id="detailTempatTglLahir"></span></p>
                        <p><strong>Kebangsaan</strong> <span id="detailKebangsaan"></span></p>
                        <p><strong>Agama:</strong> <span id="detailAgama"></span></p>
                        <p><strong>Jenis Kelamin:</strong> <span id="detailJenisKelamin"></span></p>
                        <p><strong>Status Perkawinan:</strong> <span id="detailStatusPerkawinan"></span></p>
                        <p><strong>Pekerjaan:</strong> <span id="detailPekerjaan"></span></p>
                        <p><strong>Alamat:</strong> <span id="detailAlamat"></span></p>
                    </div>
                </div>

                <div class="file-attachments">
                    <h5>Dokumen Lampiran</h5>
                    <div class="row" id="fileList">
                        <!-- File akan ditampilkan di sini -->
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <a id="btnCetak" class="btn btn-success" target="_blank">Cetak Surat</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal Preview File -->
<div class="modal fade" id="filePreviewModal" tabindex="-1" role="dialog" aria-labelledby="filePreviewModalLabel">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filePreviewModalLabel">Preview Dokumen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <iframe id="filePreviewFrame" src="" style="width:100%; height:80vh; border:none;"></iframe>
                <div id="unsupportedFile" class="d-none">
                    <p>File tidak dapat dipreview. Silahkan download untuk melihat.</p>
                    <a id="downloadFileBtn" class="btn btn-primary" download>Download File</a>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <a id="downloadFileBtnFooter" class="btn btn-primary" download>Download</a>
            </div>
        </div>
    </div>
</div>


<!-- Modal Konfirmasi Selesai -->
<div class="modal fade" id="selesaiModal" tabindex="-1" role="dialog" aria-labelledby="selesaiModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="selesaiModalLabel">Konfirmasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menerima surat tersebut?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <form id="formSelesai" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-success">Konfirmasi</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tolak -->
<div class="modal fade" id="tolakModal" tabindex="-1" role="dialog" aria-labelledby="tolakModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tolakModalLabel">Tolak Pengajuan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formTolak" method="POST" action="">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="alasan">Alasan Penolakan:</label>
                        <textarea name="alasan" class="form-control" required placeholder="Masukkan alasan penolakan"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Ya, Tolak</button>
                </div>
            </form>
        </div>
    </div>
</div>

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

<!-- Page level untuk java scripts -->
<script>
    $(document).ready(function () {
        $('#dataTable').DataTable({
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

        // Handle untuk tombol detail
       // Handle untuk tombol detail
    $(document).on('click', '.btn-detail', function() {
    var id = $(this).data('id'); // Ambil ID dari data-id
    var modal = $('#detailModal');

    // Tampilkan loading state
    modal.find('.modal-body').html('<div class="text-center py-4"><i class="fas fa-spinner fa-spin fa-3x"></i><p>Memuat data...</p></div>');

    $.ajax({
        url: '/skck/' + id, // Pastikan URL ini sesuai dengan route Laravel
        method: 'GET',
        dataType: 'json',
        success: function(response) {
        console.log(response);
            if (response.success) {
                var data = response.data;

                // Isi data dasar
                $('#detailId').text(data.no_pengajuan);
                $('#detailKodeSurat').text(data.kode_surat);
                $('#detailNama').text(data.nama);
                $('#detailNik').text(data.nik);
                $('#detailTempatTglLahir').text(data.tempat_tgl_lahir);
                $('#detailKebangsaan').text(data.kebangsaan);
                $('#detailAgama').text(data.agama);
                $('#detailJenisKelamin').text(data.jenis_kelamin);
                $('#detailStatusPerkawinan').text(data.status_perkawinan);
                $('#detailPekerjaan').text(data.pekerjaan);
                $('#detailAlamat').text(data.alamat);

                // Isi file lampiran
                var fileHtml = '';
                if (data.file && data.file.length > 0) {
                    data.file.forEach(function(file) {
                        var fileUrl = '/storage/' + file.path; // Pastikan path ini sesuai
                        var fileIcon = getFileIcon(file.mime_type);

                        fileHtml += `
                            <div class="col-md-4 mb-3">
                                <div class="card file-card">
                                    <div class="card-body text-center">
                                        <i class="${fileIcon} fa-3x mb-2"></i>
                                        <p class="file-name">${file.original_name}</p>
                                        <button class="btn btn-sm btn-primary preview-file"
                                                data-url="${fileUrl}"
                                                data-type="${file.mime_type}">
                                            Preview
                                        </button>
                                    </div>
                                </div>
                            </div>
                        `;
                    });
                } else {
                    fileHtml = '<div class="col-12"><p>Tidak ada dokumen lampiran</p></div>';
                }
                $('#fileList').html(fileHtml);

                // Set URL untuk cetak
                $('#btnCetak').attr('href', '/skck/' + id + '/cetak');
            } else {
                modal.find('.modal-body').html('<div class="alert alert-danger">'+response.message+'</div>');
            }
        },
        error: function(xhr) {
         console.log(xhr);
            var errorMessage = 'Terjadi kesalahan saat memuat data';
            if (xhr.responseJSON && xhr.responseJSON.message) {
                errorMessage = xhr.responseJSON.message;
            }
            modal.find('.modal-body').html('<div class="alert alert-danger">'+errorMessage+'</div>');
        }
    });
});

        // Handle preview file
        $(document).on('click', '.preview-file', function() {
            var fileUrl = $(this).data('url');
            var fileType = $(this).data('type');
            var previewable = isFilePreviewable(fileType);

            if (previewable) {
                $('#filePreviewFrame').attr('src', fileUrl).removeClass('d-none');
                $('#unsupportedFile').addClass('d-none');
            } else {
                $('#filePreviewFrame').addClass('d-none');
                $('#unsupportedFile').removeClass('d-none');
                $('#downloadFileBtn').attr('href', fileUrl);
            }

            $('#downloadFileBtnFooter').attr('href', fileUrl);
            $('#filePreviewModalLabel').text('Preview: ' + $(this).siblings('.file-name').text());
            $('#filePreviewModal').modal('show');
        });
        // Fungsi untuk menentukan icon berdasarkan tipe file
        function getFileIcon(mimeType) {
            if (mimeType.includes('image/')) return 'fas fa-file-image';
            if (mimeType.includes('pdf')) return 'fas fa-file-pdf';
            if (mimeType.includes('word')) return 'fas fa-file-word';
            if (mimeType.includes('excel') || mimeType.includes('spreadsheet')) return 'fas fa-file-excel';
            if (mimeType.includes('powerpoint') || mimeType.includes('presentation')) return 'fas fa-file-powerpoint';
            return 'fas fa-file';
        }

        // Fungsi untuk menentukan apakah file bisa dipreview
        function isFilePreviewable(mimeType) {
            return mimeType.includes('pdf') ||
                   mimeType.includes('image/') ||
                   mimeType.includes('text/') ||
                   mimeType.includes('word') ||
                   mimeType.includes('excel') ||
                   mimeType.includes('powerpoint');
        }
    });
        // Handle tombol selesai (set action form sebelum modal muncul)
        $('#selesaiModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var form = $(this).find('form');
            form.attr('action', '/skck/' + id + '/selesai');
        });

        // Handle tombol tolak (set action form sebelum modal muncul)
        $('#tolakModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var form = $(this).find('form');
            form.attr('action', '/skck/' + id + '/tolak');
        });

        // Handle submit form selesai (AJAX)
        $('#formSelesai').on('submit', function(e) {
            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');
            var id = url.split('/')[2]; // Ambil ID dari URL

            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(),
                success: function(response) {
                    $('#selesaiModal').modal('hide');
                    $('#row-' + id).remove(); // Hapus baris dari tabel
                    showAlert('success', 'Surat berhasil diselesaikan');
                },
                error: function() {
                    showAlert('danger', 'Terjadi kesalahan');
                }
            });
        });

        // Handle submit form tolak (AJAX)
        $('#formTolak').on('submit', function(e) {
            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');
            var id = url.split('/')[2]; // Ambil ID dari URL

            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(),
                success: function(response) {
                    $('#tolakModal').modal('hide');
                    $('#row-' + id).remove(); // Hapus baris dari tabel
                    showAlert('success', 'Surat berhasil ditolak');
                },
                error: function() {
                    showAlert('danger', 'Terjadi kesalahan');
                }
            });
        });

        // Fungsi untuk menampilkan alert
        function showAlert(type, message) {
            var alertHtml = '<div class="alert alert-' + type + ' alert-dismissible fade show" role="alert">' +
                           message +
                           '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                           '<span aria-hidden="true">&times;</span>' +
                           '</button></div>';

            $('.card-body').prepend(alertHtml);

            // Hilangkan alert setelah 5 detik
            setTimeout(function() {
                $('.alert').alert('close');
            }, 5000);
        }
    });
</script>
<style>
    .file-card {
        transition: transform 0.2s;
        height: 100%;
    }
    .file-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .file-name {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
@endsection
