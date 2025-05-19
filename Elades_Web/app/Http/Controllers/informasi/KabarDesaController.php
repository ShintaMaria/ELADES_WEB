<?php

namespace App\Http\Controllers\informasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KabarDesa;

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
            'gambar' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ], [
            'gambar.image' => 'File yang diunggah harus berupa gambar.',
            'gambar.mimes' => 'Format gambar harus jpeg, jpg, atau png.',
            'gambar.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        $gambar = null;
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/gambar_kabar_desa'), $namaFile);
            $gambar = 'uploads/gambar_kabar_desa/' . $namaFile;
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
            'gambar' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ], [
            'gambar.image' => 'File yang diunggah harus berupa gambar.',
            'gambar.mimes' => 'Format gambar harus jpeg, jpg, atau png.',
            'gambar.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($kabardesa->gambar && file_exists(public_path($kabardesa->gambar))) {
                unlink(public_path($kabardesa->gambar));
            }

            $file = $request->file('gambar');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/gambar_kabar_desa'), $namaFile);
            $kabardesa->gambar = 'uploads/gambar_kabar_desa/' . $namaFile;
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
        if ($kabardesa->gambar && file_exists(public_path($kabardesa->gambar))) {
            unlink(public_path($kabardesa->gambar));
        }

        $kabardesa->delete();

        return redirect()->route('kabardesa.index')->with('success', 'Data berhasil dihapus.');
    }
}
