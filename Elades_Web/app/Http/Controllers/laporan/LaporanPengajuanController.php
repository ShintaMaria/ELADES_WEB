<?php

namespace App\Http\Controllers\laporan;

use App\Http\Controllers\Controller;
use App\Models\PengajuanSurat;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanPengajuanController extends Controller
{
    // Menampilkan laporan pengajuan surat
    public function show(Request $request)
    {
        $query = PengajuanSurat::query();

        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');
        $tipe = $request->input('tipe');

        // Filter bulan hanya jika dipilih (bukan "Semua")
        if ($bulan && $bulan !== '') {
            $query->whereMonth('tanggal', $bulan);
        }

        // Filter tahun hanya jika dipilih (bukan "Semua")
        if ($tahun && $tahun !== '') {
            $query->whereYear('tanggal', $tahun);
        }

        // Filter tipe hanya jika dipilih (bukan "Semua")
        if ($tipe && $tipe !== '') {
            $query->where('kode_surat', $tipe);
        }

        $laporan = $query->orderBy('tanggal', 'desc')->get();

        return view('laporan_pengajuan.laporan', compact('laporan', 'bulan', 'tahun', 'tipe'));
    }

    // Mengunduh laporan pengajuan surat dalam bentuk PDF
    public function download(Request $request)
    {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');
        $tipe = $request->input('tipe');

        if (!$bulan || !$tahun) {
            return redirect()->back()->with('error', 'Bulan dan tahun wajib diisi untuk mengunduh laporan.');
        }

        $query = PengajuanSurat::whereMonth('tanggal', $bulan)
                               ->whereYear('tanggal', $tahun);

        if ($tipe && $tipe !== '') {
            $query->where('kode_surat', $tipe);
        }

        $laporan = $query->orderBy('tanggal', 'desc')->get();

        $pdf = PDF::loadView('laporan_pengajuan.laporan_pdf', [
            'laporan' => $laporan,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'tipe' => $tipe
        ]);

        $filename = "laporan_pengajuan_{$bulan}_{$tahun}" . ($tipe ? "_{$tipe}" : "") . ".pdf";

        return $pdf->download($filename);
    }
}