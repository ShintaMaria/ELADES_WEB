<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $mode === 'cetak' ? 'Cetak SKCK' : 'Preview SKCK' }}</title>

    @if($mode === 'cetak')
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        @page {
            size: A4;
            margin: 0;
        }
    </style>
    @else
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .surat-container {
            background-color: white;
            padding: 30px;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            max-width: 800px;
            margin: 0 auto;
        }
    </style>
    @endif

    <style>
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            height: 80px;
            float: left;
        }
        .header-text {
            margin: 0 auto;
            width: 70%;
        }
        .header-text p {
            margin: 0;
            line-height: 1.5;
        }
        .title {
            text-align: center;
            margin: 20px 0;
            font-weight: bold;
            text-decoration: underline;
        }
        .content {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table td {
            padding: 5px;
            vertical-align: top;
        }
        .signature {
            margin-top: 50px;
            text-align: right;
        }
        .signature-name {
            margin-top: 20px;
            text-decoration: underline;
            font-weight: bold;
        }
        .ttd-image {
            height: 100px;
            margin-bottom: 10px;
        }
        .footer-actions {
            margin-top: 30px;
            text-align: center;
        }
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="{{ $mode === 'preview' ? 'surat-container' : '' }}">
        <div class="header">
            <div class="header-text">
                <img src="{{ asset('uploads/ttd/NganjukLogo.png') }}" alt="Logo Desa" width="100" style="position: absolute; left: 80px; top: 40px;"/>
                <p>PEMERINTAH KABUPATEN NGANJUK</p>
                <p>KECAMATAN NGANJUK</p>
                <p>KELURAHAN KAUMAN</p>
                <p>Jalan Gatot Subroto Nomor: 100 Telpon: 0358-321294 Kodepos 64411</p>
            </div>
        </div>

        <div class="title">
            <p>SURAT KETERANGAN CATATAN KEPOLISIAN (SKCK)</p>
            <p>Nomor: {{ $skck->no_pengajuan }}/SKCK/{{ date('Y') }}</p>
        </div>

        <div class="content">
            <p>Yang bertanda tangan di bawah ini, menerangkan dengan sebenarnya bahwa:</p>

            <table>
                <tr>
                    <td width="30%"> Nama</td>
                    <td width="5%">:</td>
                    <td>{{ $skck->nama }}</td>
                </tr>
                <tr>
                    <td> NIK</td>
                    <td>:</td>
                    <td>{{ $skck->nik }}</td>
                </tr>
                <tr>
                    <td> Tempat/Tanggal Lahir</td>
                    <td>:</td>
                    <td>{{ $skck->tempat_lahir }}, {{ \Carbon\Carbon::parse($skck->tanggal_lahir)->format('d-m-Y') }}</td>
                </tr>
                <tr>
                    <td> Kebangsaan</td>
                    <td>:</td>
                    <td>{{ $skck->kebangsaan }}</td>
                </tr>
                <tr>
                    <td> Agama</td>
                    <td>:</td>
                    <td>{{ $skck->agama }}</td>
                </tr>
                <tr>
                    <td> Jenis Kelamin</td>
                    <td>:</td>
                    <td>{{ $skck->jenis_kelamin }}</td>
                </tr>
                <tr>
                    <td> Status Perkawinan</td>
                    <td>:</td>
                    <td>{{ $skck->status_perkawinan }}</td>
                </tr>
                <tr>
                    <td> Pekerjaan</td>
                    <td>:</td>
                    <td>{{ $skck->pekerjaan }}</td>
                </tr>
                <tr>
                    <td> Alamat</td>
                    <td>:</td>
                    <td>{{ $skck->alamat }}</td>
                </tr>
            </table>

            <p style="margin-top: 20px; text-align: justify;">
                Sepanjang pengetahuan kami, orang tersebut di atas selama bertempat tinggal di Kelurahan Kauman, Kecamatan Nganjuk, Kabupaten Nganjuk berkelakuan baik dan tidak pernah tersangkut perkara pidana.
            </p>
            <p style="text-align: justify;">
                Surat keterangan ini dibuat untuk keperluan {{ $skck->pekerjaan }} dan berlaku sejak tanggal diterbitkan sampai dengan {{ \Carbon\Carbon::now()->addMonths(3)->format('d-m-Y') }} (tiga bulan sejak diterbitkan).
            </p>
        </div>

        <div class="signature">
            <p>Nganjuk, {{ \Carbon\Carbon::now()->format('d-m-Y') }}</p>
            <p>{{ $pejabat->jabatan }}</p>

            <!-- TTD dari Upload -->
            @if($ttdPath)
                <div>
                    <img src="{{ asset($ttdPath) }}" alt="Tanda Tangan" class="ttd-image">
                </div>
            @endif

            <div class="signature-name">
                <p>{{ $pejabat->nama }}</p>
                <p>NIP. {{ $pejabat->nip }}</p>
            </div>
        </div>


        @if($mode === 'preview')
        <div class="footer-actions no-print">
            <a href="{{ route('skck', $skck->no_pengajuan) }}" class="btn btn-secondary">Kembali</a>
            @if($skck->status == 'Selesai')
                <a href="{{ route('skck.cetak', $skck->no_pengajuan) }}" class="btn btn-primary ml-2">
                    <i class="fas fa-file-pdf"></i> Cetak/Unduh PDF
                </a>
                <button onclick="window.print()" class="btn btn-info ml-2">
                    <i class="fas fa-print"></i> Print Langsung
                </button>
            @endif
        </div>
        @endif
    </div>
</body>
</html>
