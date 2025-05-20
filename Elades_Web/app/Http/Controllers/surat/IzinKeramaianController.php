<?php

namespace App\Http\Controllers\surat;

use Illuminate\Http\Request;
use App\Models\Keramaian;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\pejabat;
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
        $pejabat = pejabat::first();
        $ttdPath = $pejabat->ttd_image ? 'uploads/ttd/'.$pejabat->ttd_image : null;

        return view('templatesurat.keramaian', [
            'mode' => 'preview',
            'keramaian' => $keramaian,
            'pejabat' => $pejabat,
            'ttdPath' => $ttdPath,
            'logoPath' => 'uploads/ttd/NganjukLogo.png'
        ]);
    }

    public function cetak($id)
    {
        $keramaian = Keramaian::findOrFail($id);
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

        $pdf = Pdf::loadView('templatesurat.keramaian', [
            'mode' => 'cetak',
            'keramaian' => $keramaian,
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

        return $pdf->download('SKCK-'.$keramaian->nama.'-'.date('Ymd').'.pdf');
    }
}
