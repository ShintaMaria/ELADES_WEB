<?php

namespace App\Http\Controllers\laporan;

use App\Http\Controllers\Controller;
use App\Models\pengaduan;
use Illuminate\Http\Request;

class LaporanPengaduanController extends Controller
{
    public function show() {
         $laporanpengaduan = pengaduan::all();
        return view('pengaduan.laporan_pengaduan', compact('laporanpengaduan'));
    }
}
