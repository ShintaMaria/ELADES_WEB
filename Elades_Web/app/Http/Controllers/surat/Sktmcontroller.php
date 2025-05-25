<?php

namespace App\Http\Controllers\surat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sktm;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\pejabat;
use Illuminate\Support\Facades\DB;

class SktmController extends Controller
{
     public function index()
    {
        $sktm = Sktm::where('status', 'Diproses')->get();
        return view('surat.keterangan.sktm', compact('sktm'));
    }

    public function selesai( $id)
{
    DB::beginTransaction();
    try {
        $sktm = Sktm::findOrFail($id);
        $sktm->update(['status' => 'Selesai']); // Ini yang akan memicu trigger

        DB::commit();

        return redirect()->route('sktm')
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

        // Ambil data Sktm berdasarkan ID
        $sktm = Sktm::findOrFail($id);

        // Simpan alasan ke tabel Sktm (trigger akan handle pengajuan_surat)
        $sktm->update([
            'status' => 'Tolak',
            'alasan' => $request->input('alasan')
        ]);

        DB::commit();

        return redirect()->route('sktm')
            ->with('success', 'Pengajuan Sktm berhasil ditolak.');

            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()
                    ->with('error', 'Gagal menolak Surat sktm Barang: ' . $e->getMessage());
            }
        }
     public function preview($id)
    {
        $sktm = Sktm::findOrFail($id);
        $pejabat = pejabat::first();
        $ttdPath = $pejabat->ttd_image ? 'uploads/ttd/ttd.png' : null;

        return view('templatesurat.sktm', [
            'mode' => 'preview',
            'sktm' => $sktm,
            'pejabat' => $pejabat,
            'ttdPath' => $ttdPath,
            'logoPath' => 'uploads/ttd/NganjukLogo.png'
        ]);
    }

    public function cetak($id)
    {
        $sktm = Sktm::findOrFail($id);
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

        $pdf = Pdf::loadView('templatesurat.sktm', [
            'mode' => 'cetak',
            'sktm' => $sktm,
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

        return $pdf->download('SKTM-'.$sktm->nama.'-'.date('Ymd').'.pdf');
    }
}
