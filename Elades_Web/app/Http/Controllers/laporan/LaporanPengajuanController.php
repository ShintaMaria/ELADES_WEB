<?php
namespace App\Http\Controllers\laporan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PengajuanSurat;

class LaporanPengajuanController extends Controller
{
    public function show() {
         $laporan = PengajuanSurat::all();
        return view('laporan_pengajuan.laporan', compact('laporan'));
    }
}