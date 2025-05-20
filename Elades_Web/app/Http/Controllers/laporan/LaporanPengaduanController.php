<?php

namespace App\Http\Controllers\laporan;

use App\Http\Controllers\Controller;
use App\Models\pengaduan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanPengaduanController extends Controller
{
    public function show(Request $request)
    {
        $query = pengaduan::query();

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
            $query->where('kode_pengaduan', $tipe);
        }

        $laporanpengaduan = $query->orderBy('tanggal', 'desc')->get();

        return view('pengaduan.laporan_pengaduan', compact('laporanpengaduan', 'bulan', 'tahun', 'tipe'));
    }

    public function download(Request $request)
    {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');
        $tipe = $request->input('tipe');

        if (!$bulan || !$tahun) {
            return redirect()->back()->with('error', 'Bulan dan tahun wajib diisi untuk mengunduh laporan.');
        }

        $query = pengaduan::whereMonth('tanggal', $bulan)
                           ->whereYear('tanggal', $tahun);

        if ($tipe && $tipe !== '') {
            $query->where('kode_pengaduan', $tipe);
        }

        $laporan = $query->orderBy('tanggal', 'desc')->get();

        $pdf = PDF::loadView('pengaduan.laporan_pengaduan_pdf', [
            'laporan' => $laporan,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'tipe' => $tipe
        ]);

        $filename = "laporan_pengaduan_{$bulan}_{$tahun}" . ($tipe ? "_{$tipe}" : "") . ".pdf";

        return $pdf->download($filename);
    }
}