<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Surat</title>
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
    </style>
</head>
<body>
    <!-- Same content as preview.blade.php -->
    @include('surat.preview')
</body>
</html>