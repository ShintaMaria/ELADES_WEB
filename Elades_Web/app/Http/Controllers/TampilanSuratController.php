<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengajuanSurat;
class TampilanSuratController extends Controller
{
    //menampilkan view pengajuan surat kehilangan barang
    public function kehilangan()
    {
        $kehilangan =PengajuanSurat::where('kode_surat', 'kehilangan')->get();
        return view('surat.pengantar.barang', compact('kehilangan'));
    }
    public function penghasilan()
    {
        $kehilangan =PengajuanSurat::where('kode_surat', 'penghasilan')->get();
        return view('surat.pengantar.penghasilan', compact('penghasilan'));
    }
    //menampilkan view pengajuan surat izin keramaian
    public function keramaian()
    {
        $keramaian =PengajuanSurat::where('kode_surat', 'keramaian')->get();
        return view('surat.izin.keramaian', compact('keramaian'));
    }
    //menampilkan view pengajuan surat skck
    public function skck()
    {
        $skck =PengajuanSurat::where('kode_surat', 'skck')->get();
        return view('surat.pengantar.skck', compact('skck'));
}
}
