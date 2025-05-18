<?php

namespace App\Http\Controllers\surat;

use Illuminate\Http\Request;
use App\Models\PenghasilanOrtu;
use App\Models\PengajuanSurat;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PenghasilanController extends Controller
{
     public function index()
    {
        $PenghasilanOrtu = PenghasilanOrtu::where('status', 'Diproses')->get();
        return view('surat.keterangan.penghasilan', compact('PenghasilanOrtu'));
    }

    public function selesai( $id)
{
    DB::beginTransaction();
    try {
        $PenghasilanOrtu = PenghasilanOrtu::findOrFail($id);
        $PenghasilanOrtu->update(['status' => 'Selesai']); // Ini yang akan memicu trigger

        DB::commit();

        return redirect()->route('penghasilan')
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

        // Ambil data PenghasilanOrtu berdasarkan ID
        $PenghasilanOrtu = PenghasilanOrtu::findOrFail($id);

        // Simpan alasan ke tabel PenghasilanOrtu (trigger akan handle pengajuan_surat)
        $PenghasilanOrtu->update([
            'status' => 'Tolak',
            'alasan' => $request->input('alasan')
        ]);

        DB::commit();

        return redirect()->route('penghasilan')
            ->with('success', 'Pengajuan PenghasilanOrtu berhasil ditolak.');

            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()
                    ->with('error', 'Gagal menolak Surat PenghasilanOrtu Barang: ' . $e->getMessage());
            }
        }
     public function preview($id)
    {
        $PenghasilanOrtu = PenghasilanOrtu::findOrFail($id);

        // Data tambahan yang mungkin diperlukan untuk format surat
        $data = [
            'skck' => $PenghasilanOrtu,
            'tanggal_surat' => now()->format('d F Y'),
            'nomor_surat' => 'PenghasilanOrtu Barang-' . str_pad($PenghasilanOrtu->no_pengajuan, 4, '0', STR_PAD_LEFT) . '/' . now()->format('Y')
        ];

        return view('surat.preview', $data);
    }

    public function cetak($id)
    {
        $PenghasilanOrtu = PenghasilanOrtu::findOrFail($id);

        // Data tambahan yang mungkin diperlukan untuk format surat
        $data = [
            'skck' => $PenghasilanOrtu,
            'tanggal_surat' => now()->format('d F Y'),
            'nomor_surat' => 'PenghasilanOrtu Barang-' . str_pad($PenghasilanOrtu->no_pengajuan, 4, '0', STR_PAD_LEFT) . '/' . now()->format('Y')
        ];

        // Generate PDF
        // $pdf = PDF::loadView('surat.pengantar.cetak-skck', $data);

        // Set paper size (A4)
        // $pdf->setPaper('a4', 'portrait');

        // // Return PDF sebagai download dengan nama file
        // return $pdf->stream('Surat_Pengantar_SKCK_'.$skck->nama.'.pdf');
    }
}