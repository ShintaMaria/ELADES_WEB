<?php

namespace App\Http\Controllers\surat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DetailSKCK;
use App\Models\pejabat;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
// use PDF;
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
        $skck->update(['status' => 'Selesai']); // Ini yang akan memicu trigger

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
        // Validasi alasan harus diisi
        $request->validate([
            'alasan' => 'required|string|max:255'
        ]);

        // Ambil data SKCK berdasarkan ID
        $skck = DetailSKCK::findOrFail($id);

        // Simpan alasan ke tabel skck (trigger akan handle pengajuan_surat)
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

    // Ambil path TTD dari pengajuan (sesuaikan dengan struktur database Anda)
    $ttdPath = $pejabat->ttd_image ? 'uploads/ttd/'.$pejabat->ttd_image : null;

    return view('templatesurat.Skck', [
        'mode' => 'preview',
        'skck' => $skck,
        'pejabat' => $pejabat,
        'ttdPath' => $ttdPath
    ]);
}

public function cetak($id)
{
    $skck = DetailSKCK::findOrFail($id);
    $pejabat = pejabat::first();
    $ttdPath = $pejabat->ttd_image ? 'uploads/ttd/'.$pejabat->ttd_image : null;

    $pdf = Pdf::loadView('templatesurat.Skck', [
        'mode' => 'cetak',
        'skck' => $skck,
        'pejabat' => $pejabat,
        'ttdPath' => $ttdPath
    ]);

    return $pdf->download('SKCK-'.$skck->nama.'-'.date('Ymd').'.pdf');
}
}
