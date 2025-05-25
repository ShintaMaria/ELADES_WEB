<?php

namespace App\Http\Controllers\informasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Statistik;
class StatistikController extends Controller
{
    public function index()
    {
        $statistik = Statistik::first(); 
        return view('informasi.statistik.statistikk', compact('statistik'));
    }
    public function edit()
    {
        $statistik = Statistik::first(); 
        // ambil data dari database 
        return view('informasi.statistik.statistik_edit', compact('statistik'));
    }
    public function update(Request $request)
    {
        // validasi data
        $request->validate([
            'total_jiwa' => 'required|integer',
            'jumlah_kk' => 'required|integer',
            'jumlah_dusun' => 'required|integer',
            'luas_wilayah' => 'required|numeric',
        ]);

        // update ke database
        $statistik = Statistik::first(); 
        $statistik->update($request->all());

        return redirect()->route('statistik')->with('success', 'Data statistik berhasil diperbarui.');
    }
}
