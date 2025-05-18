<?php

namespace App\Http\Controllers\pengaduan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keamanan;
use Illuminate\Support\Facades\DB;
class KeamananController extends Controller
{
      public function index()
    {
        $keamanan = Keamanan::where('status', 'Diproses')->get(); // Ambil semua data
        return view('pengaduan.keamanan', compact('keamanan'));
    }
   public function selesai( $id)
{
    DB::beginTransaction();
    try {
        $keamanan = Keamanan::findOrFail($id);
        $keamanan->update(['status' => 'Selesai']); // Ini yang akan memicu trigger

        DB::commit();

        return redirect()->route('keamanan')
            ->with('success', 'Status berhasil diupdate');

    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()
            ->with('error', 'Gagal: ' . $e->getMessage());
    }
}

    public function tolak(Request $request, $id)
    {
   DB::beginTransaction();

        try {
        // Validasi alasan harus diisi
        $request->validate([
            'alasan' => 'required|string|max:255'
        ]);

        // Ambil data SKCK berdasarkan ID
        $keamanan = Keamanan::findOrFail($id);

        // Simpan alasan ke tabel skck (trigger akan handle pengajuan_surat)
        $keamanan->update([
            'status' => 'Tolak',
            'alasan' => $request->input('alasan')
        ]);

        DB::commit();

        return redirect()->route('keamanan')
            ->with('success', 'Pengaduan Keamanan berhasil ditolak.');

            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()
                    ->with('error', 'Gagal menolak Pengaduan Keamanan: ' . $e->getMessage());
            }
        }
}
