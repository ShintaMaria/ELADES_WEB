<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailSKCK;
use App\Models\Keramaian;
use Illuminate\Support\Facades\DB;
use App\Models\Kehilangan;
use App\Models\PenghasilanOrtu;
use App\Models\Sktm;
use App\Models\IzinKerja;
use App\Models\pejabat;
use Barryvdh\DomPDF\Facade\Pdf;
class SuratController extends Controller
{
    public function preview($jenis, $id)
    {
        $data = $this->getModelInstance($jenis)::where('no_pengajuan', $id)->firstOrFail();
        $ttd = pejabat::first(); // opsional, untuk kop surat
        return view('preview', compact('data', 'jenis', 'desa'));
    }
    private function getModelInstance($jenis)
    {
        return match ($jenis) {
            'skck' => DetailSKCK::class,
            'kehilangan' => Kehilangan::class,
            'penghasilan' => PenghasilanOrtu::class,
            'sktm' => Sktm::class,
            'izinkerja' => IzinKerja::class,
            'keramaian' => Keramaian::class,
            default => abort(404, 'Jenis surat tidak dikenali.')
        };
    }
    public function cetak($jenis, $id)
    {
        $data = $this->getModelInstance($jenis)::where('no_pengajuan', $id)->firstOrFail();
        $ttd = pejabat::first();
        $pdf = Pdf::loadView('preview', compact('data', 'jenis', 'desa'));
       return $pdf->download('surat-' . $jenis . '-' . $id . '.pdf');

    }
    // Helper function for Indonesian date format
    public static function tanggalIndo($tanggal)
    {
        $bulan = [
            1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];
        $split = explode('-', $tanggal);
        return $split[2] . ' ' . $bulan[(int)$split[1]] . ' ' . $split[0];
    }
}
