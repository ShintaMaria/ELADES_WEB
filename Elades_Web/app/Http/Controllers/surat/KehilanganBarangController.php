<?php

namespace App\Http\Controllers\surat;

use Illuminate\Http\Request;
use App\Models\Kehilangan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\pejabat;
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
        $pejabat = pejabat::first();
        $ttdPath = $pejabat->ttd_image ? 'uploads/ttd/ttd.png' : null;

        return view('templatesurat.kehilangan', [
            'mode' => 'preview',
            'kehilangan' => $kehilangan,
            'pejabat' => $pejabat,
            'ttdPath' => $ttdPath,
            'logoPath' => 'uploads/ttd/NganjukLogo.png'
        ]);
    }

    public function cetak($id)
    {
        $kehilangan = Kehilangan::findOrFail($id);
        $pejabat = pejabat::first();

        // Path untuk tanda tangan (pastikan menggunakan ttd.png)
        $ttdPath = public_path('uploads/ttd/ttd.png');
        $logoPath = public_path('uploads/ttd/NganjukLogo.png');

        // Verifikasi file tanda tangan
        if (!file_exists($ttdPath)) {
            Log::error("File tanda tangan tidak ditemukan di: ".$ttdPath);
            $ttdPath = null;
        }

        // Verifikasi file logo
        if (!file_exists($logoPath)) {
            Log::error("File logo tidak ditemukan di: ".$logoPath);
            $logoPath = null;
        }

        $pdf = Pdf::loadView('templatesurat.kehilangan', [
            'mode' => 'cetak',
            'kehilangan' => $kehilangan,
            'pejabat' => $pejabat,
            'ttdPath' => $ttdPath,
            'logoPath' => $logoPath
        ]);

        // Konfigurasi DomPDF yang lebih lengkap
        $pdf->setOptions([
            'isRemoteEnabled' => true,
            'isHtml5ParserEnabled' => true,
            'isPhpEnabled' => true,
            'defaultFont' => 'times',
            'chroot' => public_path(),
            'enable_remote' => true,
            'dpi' => 96,
            'isFontSubsettingEnabled' => true
        ]);

        return $pdf->download('SPKB-'.$kehilangan->nama.'-'.date('Ymd').'.pdf');
    }


}
