<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $mode === 'cetak' ? 'Cetak Surat Izin Tidak Masuk Kerja' : 'Preview Surat Izin Tidak Masuk Kerja' }}</title>
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            margin: 0;
            padding: 0;
            line-height: 1.5;
        }

        .surat-container {
            max-width: 800px;
            margin: 0 auto;
            @if($mode === 'preview')
                background-color: white;
                padding: 30px;
                border: 1px solid #ddd;
                box-shadow: 0 0 10px rgba(0,0,0,0.1);
            @endif
        }

        /* Kop Surat Table Layout */
        .kop-surat {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            border-bottom: 2px solid #000;
        }

        .kop-surat td {
            vertical-align: middle;
            padding: 0;
        }

        .logo-cell {
            width: 80px;
            padding-right: 15px;
        }

        .logo-cell img {
            width: 100%;
            height: auto;
            display: block;
        }

        .text-cell {
            text-align: center;
            padding: 5px 0;
        }

        .text-cell p {
            margin: 0;
            padding: 0;
            line-height: 1.3;
        }

        .text-cell p:first-child {
            font-weight: bold;
            font-size: 15px;
            margin-bottom: 3px;
        }

        .text-cell p:last-child {
            font-size: 13px;
            margin-top: 3px;
        }

        .title {
            text-align: center;
            margin: 20px 0;
            font-weight: bold;
            text-decoration: underline;
        }

        .content {
            margin-bottom: 20px;
            font-size: 14px;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
        }

        .data-table td {
            padding: 5px;
            vertical-align: top;
        }

        .signature {
            margin-top: 50px;
            text-align: right;
        }

        .signature-name {
            margin-top: 10px;
            text-decoration: underline;
            font-weight: bold;
        }

        .ttd-image {
            height: 80px;
            margin-bottom: 10px;
            object-fit: contain;
        }

        .footer-actions {
            margin-top: 30px;
            text-align: center;
        }

        @media print {
            body {
                padding: 0 !important;
                margin: 0 !important;
            }
            .surat-container {
                max-width: 100% !important;
                margin: 0 auto !important;
                padding: 0 !important;
                box-shadow: none !important;
                border: none !important;
            }
            .no-print {
                display: none;
            }
            .kop-surat {
                page-break-inside: avoid;
            }
        }

        @if($mode === 'cetak')
        <style>
            @page {
                size: A4;
                margin: 20mm 15mm;
                margin-top: 15mm;
            }
        </style>
        @endif
    </style>
</head>
<body>
    <div class="surat-container">
        <!-- Kop Surat using Table for perfect alignment -->
        <table class="kop-surat">
            <tr>
                <td class="logo-cell">
                    <img src="{{ $mode === 'preview' ? asset('uploads/ttd/NganjukLogo.png') : 'file://' . str_replace('\\', '/', $logoPath) }}"
                         alt="Logo Kabupaten">
                </td>
                <td class="text-cell">
                    <p>PEMERINTAH KABUPATEN NGANJUK</p>
                    <p>KECAMATAN NGANJUK</p>
                    <p>KELURAHAN KAUMAN</p>
                    <p>Jalan Gatot Subroto Nomor: 100 Telpon: 0358-321294 Kodepos 64411</p>
                </td>
            </tr>
        </table>

        <!-- Document title -->
        <div class="title">
            <p>SURAT IZIN TIDAK MASUK KERJA</p>
            <p>Nomor: {{ $izinkerja->no_pengajuan }}/SITMK/{{ date('Y') }}</p>
        </div>

        <!-- Content -->
        <div class="content">
            <p class="justify-text">Yang bertanda tangan di bawah ini, menerangkan bahwa:</p>

            <table class="data-table">
                <tr>
                    <td width="30%">Nama</td>
                    <td width="5%">:</td>
                    <td>{{ ucfirst(strtolower($izinkerja->nama)) }}</td>
                </tr>
                <tr>
                    <td>Tempat/Tanggal Lahir</td>
                    <td>:</td>
                    <td>{{ $izinkerja->tempat_tanggal_lahir }}</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>{{ ucfirst(strtolower($izinkerja->alamat)) }}</td>
                </tr>
                <tr>
                    <td>Instansi/Perusahaan</td>
                    <td>:</td>
                    <td>{{ $izinkerja->instansi }}</td>
                </tr>
            </table>

            <p class="justify-text" style="margin-top: 20px;">
                Dengan ini kami memberikan izin kepada yang bersangkutan untuk tidak masuk kerja pada:
            </p>

            <table class="data-table">
                <tr>
                    <td width="30%">Tanggal Izin</td>
                    <td width="5%">:</td>
                    <td>{{ $izinkerja->tanggal_izin }}</td>
                </tr>
                <tr>
                    <td>Alasan</td>
                    <td>:</td>
                    <td>{{ $izinkerja->alasan }}</td>
                </tr>
            </table>

            <p class="justify-text" style="margin-top: 20px;">
                Demikian surat izin ini dibuat dengan sebenarnya untuk dipergunakan sebagaimana mestinya. Terima kasih atas perhatian dan kerjasamanya.
            </p>
        </div>

        <!-- Signature section -->
        <div class="signature">
            <p>Nganjuk, {{ \Carbon\Carbon::now()->format('d-m-Y') }}</p>
            <p>{{ $pejabat->jabatan }}</p>

            @if($ttdPath && file_exists($ttdPath))
                <div>
                    @if($mode === 'preview')
                        <img src="{{ asset('uploads/ttd/ttd.png') }}" alt="Tanda Tangan" class="ttd-image">
                    @else
                        <img src="file://{{ str_replace('\\', '/', $ttdPath) }}" alt="Tanda Tangan" class="ttd-image">
                    @endif
                </div>
            @else
                <div style="height: 80px; margin-bottom: 10px; border-bottom: 1px solid #000;">
                    <!-- Placeholder jika tanda tangan tidak ditemukan -->
                    <span style="color: #999;">[Tanda tangan tidak tersedia]</span>
                </div>
            @endif

            <div class="signature-name">
                <p>{{ $pejabat->nama }}</p>
                <p>NIP. {{ $pejabat->nip }}</p>
            </div>
        </div>

        <!-- Actions for preview mode -->
        @if($mode === 'preview')
        <div class="footer-actions no-print">
            <a href="{{ route('izinkerja', $izinkerja->no_pengajuan) }}" class="btn btn-secondary">Kembali</a>
            @if($izinkerja->status == 'Selesai')
                <a href="{{ route('izinkerja.cetak', $izinkerja->no_pengajuan) }}" class="btn btn-primary ml-2">
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
