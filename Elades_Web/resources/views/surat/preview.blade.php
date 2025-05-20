<!DOCTYPE html>
<html>
<head>
    <title>Surat Preview</title>
    <style>
        body { font-family: sans-serif; line-height: 1.5; }
        h2 { text-align: center; text-transform: uppercase; }
    </style>
</head>
<body>

@if ($jenis == 'skck')
   <!-- Template SKCK -->
        <div class="kop-surat">
            <img src="{{ asset('uploads/ttd/NganjukLogo.png') }}" alt="Logo Desa" width="100" style="position: absolute; left: 80px; top: 40px;"/>
            <h3>PEMERINTAH KABUPATEN NGANJUK</h3>
            <h3>KECAMATAN NGANJUK</h3>
            <h2>DESA KAUMAN</h2>
            <p>Jalan Gatot Subroto No 100</p>
        </div>
        <div class="garis"></div>
        <div class="nomor-surat">
            <h3><u>SURAT PENGANTAR SKCK</u></h3>
            <p>Nomor: {{ $data->no_pengajuan }}/SKCK/{{ date('Y') }}</p>
        </div>
        <div class="isi-surat">
            <p>Yang bertanda tangan di bawah ini Kepala Desa Kauman Kecamatan Nganjuk Kabupaten Nganjuk menerangkan bahwa:</p>
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
                    <td>Tempat Lahir</td>
                    <td>: {{ $data->tempat_lahir }}</td>
                </tr>
                <tr>
                    <td>Tanggal Lahir</td>
                    <td>: {{ $data->tanggal_lahir }}</td>
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
            <p>Bahwa yang bersangkutan benar adalah warga Desa Kauman dan surat keterangan ini diberikan sebagai pengantar untuk keperluan permohonan SKCK.</p>
            <p>Demikian surat pengantar ini dibuat dengan sebenarnya untuk dapat dipergunakan sebagaimana mestinya.</p>
        </div>

@elseif ($jenis == 'kehilangan')
    <h2>Surat Kehilangan Barang</h2>
    <p>Nama: {{ $data->nama }}</p>
    <p>Barang Hilang: {{ $data->barang_yang_hilang }}</p>
    <p>Hilang pada: {{ $data->hilang_pada_tanggal }}</p>
    <p>Tempat Kehilangan: {{ $data->tempat_kehilangan }}</p>

@elseif ($jenis == 'penghasilan')
    <h2>Surat Keterangan Penghasilan</h2>
    <p>Nama Ortu: {{ $data->nama_ortu }}</p>
    <p>Pekerjaan Ortu: {{ $data->pekerjaan_ortu }}</p>
    <p>Alamat: {{ $data->alamat_ortu }}</p>
    <p>Anak: {{ $data->nama_anak }}</p>
    <p>Keperluan: {{ $data->keperluan }}</p>

@elseif ($jenis == 'sktm')
    <h2>Surat Keterangan Tidak Mampu</h2>
    <p>Nama Anak: {{ $data->nama }}</p>
    <p>Nama Bapak: {{ $data->nama_bapak }}</p>
    <p>Nama Ibu: {{ $data->nama_ibu }}</p>
    <p>Alamat: {{ $data->alamat }}</p>
    <p>Keperluan: {{ $data->keperluan }}</p>

@elseif ($jenis == 'izin-kerja')
    <h2>Surat Izin Tidak Masuk Kerja</h2>
    <p>Nama: {{ $data->nama }}</p>
    <p>TTL: {{ $data->tempat_tanggal_lahir }}</p>
    <p>Instansi: {{ $data->instansi }}</p>
    <p>Tanggal Izin: {{ $data->tanggal_izin }}</p>
    <p>Alasan: {{ $data->alasan }}</p>

@elseif ($jenis == 'keramaian')
    <h2>Surat Izin Keramaian</h2>
    <p>Nama: {{ $data->nama }}</p>
    <p>Kegiatan: {{ $data->kegiatan }}</p>
    <p>Tanggal: {{ $data->tanggal }}</p>
    <p>Waktu: {{ $data->waktu }}</p>
    <p>Tempat: {{ $data->tempat }}</p>
@endif

    <div class="ttd">
        <p>Kauman, {{ \App\Http\Controllers\SuratController::tanggalIndo(date('Y-m-d')) }}<br>
        Lurah Kauman</p>
        <br><br><br>
        {{-- Tanda tangan dari folder uploads/ttd --}}
         <br>
        <img src="{{ asset('uploads/ttd/ttd.png') }}" width="100" style="margin-top:10px;">

        <p><u>{{ $ttd->nama }}</u><br>
        NIP: {{ $ttd->nip }}</p>
    </div>
</body>
</html>
