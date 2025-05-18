<?php

namespace App\Http\Controllers\pengaduan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Infrastruktur;
use Illuminate\Support\Facades\DB;
class InfrastrukturController extends Controller
{
    public function index()
    {
        $infrastruktur = Infrastruktur::where('status', 'Diproses')->get(); // Ambil semua data
        return view('pengaduan.infrastruktur', compact('infrastruktur'));
    }
   public function selesai( $id)
{
    DB::beginTransaction();
    try {
        $infrastruktur = Infrastruktur::findOrFail($id);
        $infrastruktur->update(['status' => 'Selesai']); // Ini yang akan memicu trigger

        DB::commit();

        return redirect()->route('infrastruktur')
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
        $infrastruktur = Infrastruktur::findOrFail($id);

        // Simpan alasan ke tabel skck (trigger akan handle pengajuan_surat)
        $infrastruktur->update([
            'status' => 'Tolak',
            'alasan' => $request->input('alasan')
        ]);

        DB::commit();

        return redirect()->route('infrastruktur')
            ->with('success', 'Pengaduan Infrastruktur berhasil ditolak.');

            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()
                    ->with('error', 'Gagal menolak Pengaduan Infrastruktur: ' . $e->getMessage());
            }
        }
}