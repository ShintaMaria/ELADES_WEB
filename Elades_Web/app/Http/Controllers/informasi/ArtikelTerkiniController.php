<?php

namespace App\Http\Controllers\informasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\artikel;
class ArtikelTerkiniController extends Controller
{
    public function index()
    {
        $artikels = Artikel::latest()->get(); // Ambil semua data artikel terbaru
        return view('informasi.artikel_terkini', compact('artikels'));
    }
}
