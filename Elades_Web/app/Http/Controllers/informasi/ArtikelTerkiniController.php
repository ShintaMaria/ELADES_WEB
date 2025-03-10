<?php

namespace App\Http\Controllers\informasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Artikel;

class ArtikelTerkiniController extends Controller
{
    public function index()
    {
        $artikels = Artikel::latest()->get(); // Ambil semua data artikel terbaru
        return view('informasi.artikel.artikel_terkini', compact('artikels'));
    }

    public function create()
    {
        return view('informasi.artikel.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'link' => 'nullable|url'
        ]);

        Artikel::create($request->all());

        return redirect()->route('artikel_terkini.index')->with('success', 'Artikel berhasil ditambahkan.');
    }

    public function edit(Artikel $artikel)
    {
        return view('informasi.artikel.edit', compact('artikel'));
    }

    public function update(Request $request, Artikel $artikel)
    {
        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'link' => 'nullable|url'
        ]);

        $artikel->update($request->all());

        return redirect()->route('artikel_terkini.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(Artikel $artikel)
    {
        $artikel->delete();
        return redirect()->route('artikel_terkini.index')->with('success', 'Artikel berhasil dihapus.');
    }
}
