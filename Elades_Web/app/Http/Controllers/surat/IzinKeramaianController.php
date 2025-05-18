<?php

namespace App\Http\Controllers\surat;

use Illuminate\Http\Request;
use App\Models\Keramaian;
use App\Models\PengajuanSurat;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class IzinKeramaianController extends Controller
{
     public function index()
    {
        $keramaian = Keramaian::where('status', 'Diproses')->get();
        return view('surat.izin.keramaian', compact('keramaian'));
    }

    public function selesai( $id)
{
    DB::beginTransaction();
    try {
        $keramaian = Keramaian::findOrFail($id);
        $keramaian->update(['status' => 'Selesai']); // Ini yang akan memicu trigger

        DB::commit();

        return redirect()->route('keramaian')
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

        // Ambil data Keramaian berdasarkan ID
        $keramaian = Keramaian::findOrFail($id);

        // Simpan alasan ke tabel Keramaian (trigger akan handle pengajuan_surat)
        $keramaian->update([
            'status' => 'Tolak',
            'alasan' => $request->input('alasan')
        ]);

        DB::commit();

        return redirect()->route('keramaian')
            ->with('success', 'Pengajuan Keramaian berhasil ditolak.');

            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()
                    ->with('error', 'Gagal menolak Surat Keramaian Barang: ' . $e->getMessage());
            }
        }
     public function preview($id)
    {
        $keramaian = Keramaian::findOrFail($id);

        // Data tambahan yang mungkin diperlukan untuk format surat
        $data = [
            'skck' => $keramaian,
            'tanggal_surat' => now()->format('d F Y'),
            'nomor_surat' => 'Keramaian Barang-' . str_pad($keramaian->no_pengajuan, 4, '0', STR_PAD_LEFT) . '/' . now()->format('Y')
        ];

        return view('surat.preview', $data);
    }

    public function cetak($id)
    {
        $keramaian = Keramaian::findOrFail($id);

        // Data tambahan yang mungkin diperlukan untuk format surat
        $data = [
            'skck' => $keramaian,
            'tanggal_surat' => now()->format('d F Y'),
            'nomor_surat' => 'Keramaian Barang-' . str_pad($keramaian->no_pengajuan, 4, '0', STR_PAD_LEFT) . '/' . now()->format('Y')
        ];

        // Generate PDF
        // $pdf = PDF::loadView('surat.pengantar.cetak-skck', $data);

        // Set paper size (A4)
        // $pdf->setPaper('a4', 'portrait');

        // // Return PDF sebagai download dengan nama file
        // return $pdf->stream('Surat_Pengantar_SKCK_'.$skck->nama.'.pdf');
    }
}