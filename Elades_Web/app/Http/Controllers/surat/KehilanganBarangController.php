<?php

namespace App\Http\Controllers\surat;

use Illuminate\Http\Request;
use App\Models\Kehilangan;
use App\Models\PengajuanSurat;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class KehilanganBarangController extends Controller
{
     public function index()
    {
        $kehilangan = Kehilangan::where('status', 'Diproses')->get();
        return view('surat.pengantar.barang', compact('kehilangan'));
    }

    public function selesai( $id)
{
    DB::beginTransaction();
    try {
        $kehilangan = Kehilangan::findOrFail($id);
        $kehilangan->update(['status' => 'Selesai']); // Ini yang akan memicu trigger

        DB::commit();

        return redirect()->route('kehilangan')
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

        // Ambil data kehilangan berdasarkan ID
        $kehilangan = Kehilangan::findOrFail($id);

        // Simpan alasan ke tabel kehilangan (trigger akan handle pengajuan_surat)
        $kehilangan->update([
            'status' => 'Tolak',
            'alasan' => $request->input('alasan')
        ]);

        DB::commit();

        return redirect()->route('kehilangan')
            ->with('success', 'Pengajuan Kehilangan berhasil ditolak.');

            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()
                    ->with('error', 'Gagal menolak Surat Kehilangan Barang: ' . $e->getMessage());
            }
        }
     public function preview($id)
    {
        $kehilangan = Kehilangan::findOrFail($id);

        // Data tambahan yang mungkin diperlukan untuk format surat
        $data = [
            'skck' => $kehilangan,
            'tanggal_surat' => now()->format('d F Y'),
            'nomor_surat' => 'Kehilangan Barang-' . str_pad($kehilangan->no_pengajuan, 4, '0', STR_PAD_LEFT) . '/' . now()->format('Y')
        ];

        return view('surat.preview', $data);
    }

    public function cetak($id)
    {
        $kehilangan = Kehilangan::findOrFail($id);

        // Data tambahan yang mungkin diperlukan untuk format surat
        $data = [
            'skck' => $kehilangan,
            'tanggal_surat' => now()->format('d F Y'),
            'nomor_surat' => 'Kehilangan Barang-' . str_pad($kehilangan->no_pengajuan, 4, '0', STR_PAD_LEFT) . '/' . now()->format('Y')
        ];

        // Generate PDF
        // $pdf = PDF::loadView('surat.pengantar.cetak-skck', $data);

        // Set paper size (A4)
        // $pdf->setPaper('a4', 'portrait');

        // // Return PDF sebagai download dengan nama file
        // return $pdf->stream('Surat_Pengantar_SKCK_'.$skck->nama.'.pdf');
    }


}