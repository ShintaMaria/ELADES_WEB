<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Pengaduan</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        .kop-surat {
            position: relative;
            margin-bottom: 10px;
        }

        .kop-surat img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100px;
            height: 100px;
        }

        .kop-surat .text {
            text-align: center;
            margin-left: 0;
            padding-left: 10px; /* spasi dari kiri agar tidak ketabrak logo */
        }

        .kop-surat .text h1,
        .kop-surat .text h2,
        .kop-surat .text h3 {
            margin: 0;
            line-height: 1.2;
        }

        hr {
            border: 1px solid #000;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .judul-laporan {
            text-align: center;
            margin-top: 20px;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #333;
        }

        th, td {
            padding: 6px;
            text-align: left;
        }

        th {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>

    <div class="kop-surat">
        <img src="landingpage/assets/img/logonavbar.png" alt="Logo">
        <div class="text">
            <h2>PEMERINTAH KABUPATEN NGANJUK</h2>
            <h3>KECAMATAN NGANJUK</h3>
            <h3>DESA KAUMAN</h3>
            <p>Alamat: Jl. Gatot Subroto 100, Kode Pos: 64411</p>
        </div>
    </div>

    <hr>

    <div class="judul-laporan">
        Laporan Pengaduan Masyarakat - Bulan {{ $bulan }} Tahun {{ $tahun }}
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Pemohon</th>
                <th>Tanggal</th>
                <th>Tipe Pengaduan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($laporan as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->tanggal }}</td>
                    <td>{{ $item->kode_pengaduan }}</td>
                    <td>{{ $item->status }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align:center;">Tidak ada data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>
