<?php

namespace App\Http\Controllers\surat;

use Illuminate\Http\Request;
use App\Models\PenghasilanOrtu;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\pejabat;
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
        $pejabat = pejabat::first();
        $ttdPath = $pejabat->ttd_image ? 'uploads/ttd/ttd.png' : null;

        return view('templatesurat.penghasilan', [
            'mode' => 'preview',
            'PenghasilanOrtu' => $PenghasilanOrtu,
            'pejabat' => $pejabat,
            'ttdPath' => $ttdPath,
            'logoPath' => 'uploads/ttd/NganjukLogo.png'
        ]);
    }

    public function cetak($id)
    {
        $PenghasilanOrtu = PenghasilanOrtu::findOrFail($id);
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

        $pdf = Pdf::loadView('templatesurat.penghasilan', [
            'mode' => 'cetak',
            'PenghasilanOrtu' => $PenghasilanOrtu,
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

        return $pdf->download('SPO-'.$PenghasilanOrtu->nama.'-'.date('Ymd').'.pdf');
    }
}
