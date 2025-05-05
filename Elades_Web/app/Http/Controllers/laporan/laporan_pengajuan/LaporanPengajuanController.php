<?php
namespace App\Http\Controllers\laporan\laporan_pengajuan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LaporanPengajuanController extends Controller
{
    public function kehilangan() {
        return view('laporan_pengajuan.kehilangan_barang');
    }

    public function sktm() {
        return view('laporan_pengajuan.sktm');
    }

    public function skck() {
        return view('laporan_pengajuan.skck');
    }

    public function penghasilan() {
        return view('laporan_pengajuan.penghasilan');
    }

    public function tidakMasuk() {
        return view('laporan_pengajuan.tidak_masuk_kerja');
    }

    public function keramaian() {
        return view('laporan_pengajuan.keramaian');
    }
}
