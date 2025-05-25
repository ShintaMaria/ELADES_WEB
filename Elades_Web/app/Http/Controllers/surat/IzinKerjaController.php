<?php

namespace App\Http\Controllers\surat;

use Illuminate\Http\Request;
use App\Models\IzinKerja;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\pejabat;
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
            'alasan_tolak' => 'required|string|max:255'
        ]);

        // Ambil data IzinKerja berdasarkan ID
        $izinkerja = IzinKerja::findOrFail($id);

        // Simpan alasan ke tabel kehilangan (trigger akan handle pengajuan_surat)
        $izinkerja->update([
            'status' => 'Tolak',
            'alasan_tolak' => $request->input('alasan_tolak')
        ]);

        DB::commit();

        return redirect()->route('izinkerja')
            ->with('success', 'Pengajuan Izin Kerja berhasil ditolak.');

            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()
                    ->with('error', 'Gagal menolak Surat Izin Kerja: ' . $e->getMessage());
            }
        }
     public function preview($id)
    {
        $izinkerja = IzinKerja::findOrFail($id);
        $pejabat = pejabat::first();
        $ttdPath = $pejabat->ttd_image ? 'uploads/ttd/ttd.png' : null;

        return view('templatesurat.izinkerja', [
            'mode' => 'preview',
            'izinkerja' => $izinkerja,
            'pejabat' => $pejabat,
            'ttdPath' => $ttdPath,
            'logoPath' => 'uploads/ttd/NganjukLogo.png'
        ]);
    }

    public function cetak($id)
    {
        $izinkerja = IzinKerja::findOrFail($id);
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

        $pdf = Pdf::loadView('templatesurat.izinkerja', [
            'mode' => 'cetak',
            'izinkerja' => $izinkerja,
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

        return $pdf->download('IzinKerja-'.$izinkerja->nama.'-'.date('Ymd').'.pdf');
    }
}
