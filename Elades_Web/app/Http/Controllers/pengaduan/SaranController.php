<?php

namespace App\Http\Controllers\pengaduan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Saran;
class SaranController extends Controller
{
    public function index()
    {
        $saran = Saran::all(); // Ambil semua data
        return view('pengaduan.saran', compact('saran'));
    }
   public function selesai( $id)
{
    DB::beginTransaction();
    try {
        $saran = Saran::findOrFail($id);
        $saran->update(['status' => 'Selesai']); // Ini yang akan memicu trigger

        DB::commit();

        return redirect()->route('saran')
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
        $saran = Saran::findOrFail($id);

        // Simpan alasan ke tabel skck (trigger akan handle pengajuan_surat)
        $saran->update([
            'status' => 'Tolak',
            'alasan' => $request->input('alasan')
        ]);

        DB::commit();

        return redirect()->route('saran')
            ->with('success', 'Pengaduan Saran berhasil ditolak.');

            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()
                    ->with('error', 'Gagal menolak Pengaduan Saran: ' . $e->getMessage());
            }
        }
}