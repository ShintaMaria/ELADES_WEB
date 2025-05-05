<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Preview Surat</title>
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            line-height: 1.5;
            margin: 30px 60px;
            font-size: 12px;
        }
        .kop-surat {
            text-align: center;
            margin-bottom: 20px;
            margin-left: 100px;
        }
        .garis {
            border-top: 3px solid black;
            border-bottom: 1px solid black;
            height: 3px;
            margin-bottom: 20px;
        }
        .nomor-surat {
            text-align: center;
            margin-bottom: 20px;
        }
        .isi-surat {
            text-align: justify;
            margin-bottom: 20px;
        }
        .ttd {
            float: right;
            width: 250px;
            text-align: center;
        }
        table.data {
            margin: 10px 0;
        }
        table.data td {
            padding: 3px 10px 3px 0;
        }
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }
        @media print {
            @page {
                margin: 0;
            }
            body {
                margin: 1cm;
            }
        }
    </style>
</head>
<body>
    @if($kode_surat === 'sktm')
        <!-- Template SKTM -->
        <div class="kop-surat">
            <img src="{{ asset('assets/img/logonganjuk.png') }}" alt="Logo Desa" width="100" style="position: absolute; left: 80px; top: 40px;"/>
            <h3>PEMERINTAH KABUPATEN {{ strtoupper($desa->kabupaten) }}</h3>
            <h3>KECAMATAN {{ strtoupper($desa->kecamatan) }}</h3>
            <h2>DESA {{ strtoupper($desa->nama_desa) }}</h2>
            <p>{{ $desa->alamat }}</p>
        </div>
        <div class="garis"></div>
        <div class="nomor-surat">
            <h3><u>SURAT KETERANGAN TIDAK MAMPU</u></h3>
            <p>Nomor: {{ $data->no_pengajuan }}/SKTM/{{ date('Y') }}</p>
        </div>
        <div class="isi-surat">
            <p>Yang bertanda tangan di bawah ini Kepala Desa {{ $desa->nama_desa }}...</p>
            <h4>Data Ayah</h4>
            <table class="data">
                <tr>
                    <td width="200">Nama Ayah</td>
                    <td>: {{ $data->nama_bapak }}</td>
                </tr>
                <tr>
                    <td>Tempat, Tanggal Lahir</td>
                    <td>: {{ $data->tempat_tanggal_lahir_bapak }}</td>
                </tr>
                <tr>
                    <td>Pekerjaan Ayah</td>
                    <td>: {{ $data->pekerjaan_bapak }}</td>
                </tr>
                <tr>
                    <td>Alamat Ayah</td>
                    <td>: {{ $data->alamat_bapak }}</td>
                </tr>
            </table>
            <h4>Data Ibu</h4>
            <table class="data">
                <tr>
                    <td width="200">Nama Ibu</td>
                    <td>: {{ $data->nama_ibu }}</td>
                </tr>
                <tr>
                    <td>Tempat, Tanggal Lahir</td>
                    <td>: {{ $data->tempat_tanggal_lahir_ibu }}</td>
                </tr>
                <tr>
                    <td>Pekerjaan Ibu</td>
                    <td>: {{ $data->pekerjaan_ibu }}</td>
                </tr>
                <tr>
                    <td>Alamat Ibu</td>
                    <td>: {{ $data->alamat_ibu }}</td>
                </tr>
            </table>
            <h4>Data Anak</h4>
            <table class="data">
                <tr>
                    <td width="200">Nama Anak</td>
                    <td>: {{ $data->nama }}</td>
                </tr>
                <tr>
                    <td>Tempat, Tanggal Lahir</td>
                    <td>: {{ $data->tempat_tanggal_lahir_anak }}</td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>: {{ $data->jenis_kelamin_anak }}</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>: {{ $data->alamat }}</td>
                </tr>
            </table>
            <p>Demikian surat keterangan ini dibuat dengan sebenarnya untuk dapat dipergunakan sebagaimana mestinya.</p>
        </div>

    @elseif($kode_surat === 'surat_ijin')
        <!-- Template Surat Izin -->
        <div class="kop-surat">
            <img src="{{ asset('assets/img/logonganjuk.png') }}" alt="Logo Desa" width="100" style="position: absolute; left: 80px; top: 40px;"/>
            <h3>PEMERINTAH KABUPATEN {{ strtoupper($desa->kabupaten) }}</h3>
            <h3>KECAMATAN {{ strtoupper($desa->kecamatan) }}</h3>
            <h2>DESA {{ strtoupper($desa->nama_desa) }}</h2>
            <p>{{ $desa->alamat }}</p>
        </div>
        <div class="garis"></div>
        <div class="nomor-surat">
            <h3><u>SURAT IZIN</u></h3>
            <p>Nomor: {{ $data->no_pengajuan }}/IZN/{{ date('Y') }}</p>
        </div>
        <div class="isi-surat">
            <p>Yang bertanda tangan di bawah ini Kepala Desa {{ $desa->nama_desa }}, dengan ini memberikan izin kepada:</p>
            <table class="data">
                <tr>
                    <td width="200">Nama</td>
                    <td>: {{ $data->nama }}</td>
                </tr>
                <tr>
                    <td>NIK</td>
                    <td>: {{ $data->nik }}</td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>: {{ $data->jenis_kelamin }}</td>
                </tr>
                <tr>
                    <td>Tempat, Tanggal Lahir</td>
                    <td>: {{ $data->tempat_tanggal_lahir }}</td>
                </tr>
                <tr>
                    <td>Kewarganegaraan</td>
                    <td>: {{ $data->kewarganegaraan }}</td>
                </tr>
                <tr>
                    <td>Agama</td>
                    <td>: {{ $data->agama }}</td>
                </tr>
                <tr>
                    <td>Pekerjaan</td>
                    <td>: {{ $data->pekerjaan }}</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>: {{ $data->alamat }}</td>
                </tr>
                <tr>
                    <td>Tempat Kerja</td>
                    <td>: {{ $data->tempat_kerja }}</td>
                </tr>
                <tr>
                    <td>Bagian</td>
                    <td>: {{ $data->bagian }}</td>
                </tr>
                <tr>
                    <td>Tanggal Izin</td>
                    <td>: {{ \App\Http\Controllers\SuratController::tanggalIndo($data->tanggal) }}</td>
                </tr>
                <tr>
                    <td>Alasan</td>
                    <td>: {{ $data->alasan }}</td>
                </tr>
            </table>
            <p>Demikian surat izin ini dibuat dengan sebenarnya untuk dapat dipergunakan sebagaimana mestinya.</p>
        </div>

    @elseif($kode_surat === 'skck')
        <!-- Template SKCK -->
        <div class="kop-surat">
            <img src="{{ asset('assets/img/logonganjuk.png') }}" alt="Logo Desa" width="100" style="position: absolute; left: 80px; top: 40px;"/>
            <h3>PEMERINTAH KABUPATEN {{ strtoupper($desa->kabupaten) }}</h3>
            <h3>KECAMATAN {{ strtoupper($desa->kecamatan) }}</h3>
            <h2>DESA {{ strtoupper($desa->nama_desa) }}</h2>
            <p>{{ $desa->alamat }}</p>
        </div>
        <div class="garis"></div>
        <div class="nomor-surat">
            <h3><u>SURAT PENGANTAR SKCK</u></h3>
            <p>Nomor: {{ $data->no_pengajuan }}/SKCK/{{ date('Y') }}</p>
        </div>
        <div class="isi-surat">
            <p>Yang bertanda tangan di bawah ini Kepala Desa {{ $desa->nama_desa }} Kecamatan {{ $desa->kecamatan }} Kabupaten {{ $desa->kabupaten }} menerangkan bahwa:</p>
            <table class="data">
                <tr>
                    <td width="200">Nama</td>
                    <td>: {{ $data->nama }}</td>
                </tr>
                <tr>
                    <td>NIK</td>
                    <td>: {{ $data->nik }}</td>
                </tr>
                <tr>
                    <td>Tempat, Tanggal Lahir</td>
                    <td>: {{ $data->tempat_tgl_lahir }}</td>
                </tr>
                <tr>
                    <td>Kebangsaan</td>
                    <td>: {{ $data->kebangsaan }}</td>
                </tr>
                <tr>
                    <td>Agama</td>
                    <td>: {{ $data->agama }}</td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>: {{ $data->jenis_kelamin }}</td>
                </tr>
                <tr>
                    <td>Status Perkawinan</td>
                    <td>: {{ $data->status_perkawinan }}</td>
                </tr>
                <tr>
                    <td>Pekerjaan</td>
                    <td>: {{ $data->pekerjaan }}</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>: {{ $data->alamat }}</td>
                </tr>
            </table>
            <p>Bahwa yang bersangkutan benar adalah warga Desa {{ $desa->nama_desa }} dan surat keterangan ini diberikan sebagai pengantar untuk keperluan permohonan SKCK.</p>
            <p>Demikian surat pengantar ini dibuat dengan sebenarnya untuk dapat dipergunakan sebagaimana mestinya.</p>
        </div>
    @endif

    <div class="ttd">
        <p>{{ $desa->nama_desa }}, {{ \App\Http\Controllers\SuratController::tanggalIndo(date('Y-m-d')) }}<br>
        {{ $ttd === 'kepaladesa' ? 'Kepala Desa' : 'Sekretaris Desa' }} {{ $desa->nama_desa }}</p>
        <br><br><br>
        <p><u>{{ $pejabat->nama }}</u><br>
        NIP: {{ $pejabat->nip }}</p>
    </div>
</body>
</html>
