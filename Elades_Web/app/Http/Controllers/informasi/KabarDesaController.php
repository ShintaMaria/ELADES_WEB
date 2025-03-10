<?php

namespace App\Http\Controllers\informasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KabarDesa; // Pastikan model ini dipanggil

class KabarDesaController extends Controller
{
    public function index()
    {
        // Ambil semua data dari tabel kabardesa
        $kabars = KabarDesa::all();

        // Kirim data ke view
        return view('informasi.kabar.kabar_desa', compact('kabars'));
    }
}
