<?php

namespace App\Http\Controllers\surat;

use Illuminate\Http\Request;
use App\Models\IzinKerja;
use App\Models\PengajuanSurat;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class IzinKerjaController extends Controller
{
     public function index()
    {
        $izinkerja = IzinKerja::where('status', 'Diproses')->get();
        return view('surat.izin.kerja', compact('izinkerja'));
    }

    public function selesai( $id)
{
    DB::beginTransaction();
    try {
        $izinkerja = IzinKerja::findOrFail($id);
        $izinkerja->update(['status' => 'Selesai']); // Ini yang akan memicu trigger

        DB::commit();

        return redirect()->route('izinkerja')
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

        // Ambil data IzinKerja berdasarkan ID
        $izinkerja = IzinKerja::findOrFail($id);

        // Simpan alasan ke tabel kehilangan (trigger akan handle pengajuan_surat)
        $izinkerja->update([
            'status' => 'Tolak',
            'alasan' => $request->input('alasan_tolak')
        ]);

        DB::commit();

        return redirect()->route('izinkerja')
            ->with('success', 'Pengajuan izinkerja berhasil ditolak.');

            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()
                    ->with('error', 'Gagal menolak Surat izinkerja Barang: ' . $e->getMessage());
            }
        }
     public function preview($id)
    {
        $izinkerja = IzinKerja::findOrFail($id);

        // Data tambahan yang mungkin diperlukan untuk format surat
        $data = [
            'skck' => $izinkerja,
            'tanggal_surat' => now()->format('d F Y'),
            'nomor_surat' => 'Izin Kerja -' . str_pad($izinkerja->no_pengajuan, 4, '0', STR_PAD_LEFT) . '/' . now()->format('Y')
        ];

        return view('surat.preview', $data);
    }

    public function cetak($id)
    {
        $izinkerja = IzinKerja::findOrFail($id);

        // Data tambahan yang mungkin diperlukan untuk format surat
        $data = [
            'skck' => $izinkerja,
            'tanggal_surat' => now()->format('d F Y'),
            'nomor_surat' => 'izinkerja-' . str_pad($izinkerja->no_pengajuan, 4, '0', STR_PAD_LEFT) . '/' . now()->format('Y')
        ];

        // Generate PDF
        // $pdf = PDF::loadView('surat.pengantar.cetak-skck', $data);

        // Set paper size (A4)
        // $pdf->setPaper('a4', 'portrait');

        // // Return PDF sebagai download dengan nama file
        // return $pdf->stream('Surat_Pengantar_SKCK_'.$skck->nama.'.pdf');
    }
}
