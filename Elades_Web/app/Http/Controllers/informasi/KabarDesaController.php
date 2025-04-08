<?php

namespace App\Http\Controllers\informasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KabarDesa;
use Illuminate\Support\Facades\Storage; // tambahkan ini!

class KabarDesaController extends Controller
{
    public function index()
    {
        $kabars = KabarDesa::all();
        return view('informasi.kabar.kabar_desa', compact('kabars'));
    }

    public function create()
    {
        return view('informasi.kabar.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'tanggal' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $gambar = null;
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->store('gambar_kabar', 'public');
        }

        KabarDesa::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
            'gambar' => $gambar,
        ]);

        return redirect()->route('kabardesa.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit(KabarDesa $kabardesa)
    {
        return view('informasi.kabar.edit', compact('kabardesa'));
    }

    public function update(Request $request, KabarDesa $kabardesa)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'tanggal' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            if ($kabardesa->gambar) {
                Storage::disk('public')->delete($kabardesa->gambar);
            }
            $kabardesa->gambar = $request->file('gambar')->store('gambar_kabar', 'public');
        }

        $kabardesa->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
            'gambar' => $kabardesa->gambar,
        ]);

        return redirect()->route('kabardesa.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(KabarDesa $kabardesa)
    {
        if ($kabardesa->gambar) {
            Storage::disk('public')->delete($kabardesa->gambar);
        }
        $kabardesa->delete();

        return redirect()->route('kabardesa.index')->with('success', 'Data berhasil dihapus.');
    }
}
