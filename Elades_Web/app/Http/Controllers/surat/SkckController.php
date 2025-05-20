<?php

namespace App\Http\Controllers\surat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DetailSKCK;
use App\Models\pejabat;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class SkckController extends Controller
{
    public function index()
    {
        $skck = DetailSKCK::where('status', 'Diproses')->get();
        return view('surat.pengantar.skck', compact('skck'));
    }

    public function selesai(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $skck = DetailSKCK::findOrFail($id);
            $skck->update(['status' => 'Selesai']);

            DB::commit();

            return redirect()->route('skck')
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
            $request->validate([
                'alasan' => 'required|string|max:255'
            ]);

            $skck = DetailSKCK::findOrFail($id);

            $skck->update([
                'status' => 'Tolak',
                'alasan' => $request->input('alasan')
            ]);

            DB::commit();

            return redirect()->route('skck')
                ->with('success', 'Pengajuan SKCK berhasil ditolak.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Gagal menolak SKCK: ' . $e->getMessage());
        }
    }

    public function preview($id)
    {
        $skck = DetailSKCK::findOrFail($id);
        $pejabat = pejabat::first();
        $ttdPath = $pejabat->ttd_image ? 'uploads/ttd/'.$pejabat->ttd_image : null;

        return view('templatesurat.Skck', [
            'mode' => 'preview',
            'skck' => $skck,
            'pejabat' => $pejabat,
            'ttdPath' => $ttdPath,
            'logoPath' => 'uploads/ttd/NganjukLogo.png'
        ]);
    }

    public function cetak($id)
    {
        $skck = DetailSKCK::findOrFail($id);
        $pejabat = pejabat::first();
        
        // Path untuk tanda tangan (pastikan menggunakan ttd.png)
        $ttdPath = public_path('uploads/ttd/ttd.png');
        $logoPath = public_path('uploads/ttd/NganjukLogo.png');

        // Verifikasi file tanda tangan
        if (!file_exists($ttdPath)) {
            \Log::error("File tanda tangan tidak ditemukan di: ".$ttdPath);
            $ttdPath = null;
        }

        // Verifikasi file logo
        if (!file_exists($logoPath)) {
            \Log::error("File logo tidak ditemukan di: ".$logoPath);
            $logoPath = null;
        }

        $pdf = Pdf::loadView('templatesurat.Skck', [
            'mode' => 'cetak',
            'skck' => $skck,
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

        return $pdf->download('SKCK-'.$skck->nama.'-'.date('Ymd').'.pdf');
    }
}