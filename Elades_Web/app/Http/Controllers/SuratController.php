<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\QueryException;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
class SuratController extends Controller
{
    public function preview(Request $request)
    {
        $no_pengajuan = $request->input('no_pengajuan');
        $kode_surat = $request->input('kode_surat');
        $ttd = $request->input('ttd', 'kepaladesa');

        // Get surat data
        $data = DB::table($kode_surat)
            ->where('no_pengajuan', $no_pengajuan)
            ->first();

        if (!$data) {
            $data = (object)[
                'no_pengajuan' => 'Tidak ditemukan',
                'nama' => 'Tidak ditemukan',
                'jenis_kelamin' => 'Tidak ditemukan',
                'tanggal_kematian' => 'Tidak ditemukan',
                'alamat' => 'Tidak ditemukan',
            ];

    }
           // Get desa profile
        $desa = DB::table('profil_desa')->first();
        if (!$desa) {
            $desa = (object)[
                'kabupaten' => 'Kabupaten tidak ditemukan',
                'kecamatan' => 'Kecamatan tidak ditemukan',
                'nama_desa' => 'Desa tidak ditemukan',
                'alamat' => 'Alamat tidak ditemukan'
            ];
        }

        // Get pejabat data
        $pejabat = DB::table('pejabat')
            ->where('jabatan', $ttd)
            ->first();
        if (!$pejabat) {
            $pejabat = (object)[
                'nama' => 'Nama tidak ditemukan',
                'nip' => 'NIP tidak tersedia'
            ];
        }

        return view('surat.preview', [
            'kode_surat' => $kode_surat,
            'data' => $data,
            'desa' => $desa,
            'pejabat' => $pejabat,
            'ttd' => $ttd
        ]);
    }

    public function cetak(Request $request)
    {
        $no_pengajuan = $request->input('no_pengajuan');
        $kode_surat = $request->input('kode_surat');
        $ttd = $request->input('ttd', 'kepaladesa');

        // Get surat data
        $data = DB::table($kode_surat)
            ->where('no_pengajuan', $no_pengajuan)
            ->first();

        if (!$data) {
            $data = (object)[
                'no_pengajuan' => 'Tidak ditemukan',
                'nama' => 'Tidak ditemukan',
                'jenis_kelamin' => 'Tidak ditemukan',
                'tanggal_kematian' => 'Tidak ditemukan',
                'alamat' => 'Tidak ditemukan',
            ];
        }

        // Get desa profile
        $desa = DB::table('profil_desa')->first();
        if (!$desa) {
            $desa = (object)[
                'kabupaten' => 'Kabupaten tidak ditemukan',
                'kecamatan' => 'Kecamatan tidak ditemukan',
                'nama_desa' => 'Desa tidak ditemukan',
                'alamat' => 'Alamat tidak ditemukan'
            ];
        }

        // Get pejabat data
        $pejabat = DB::table('pejabat')
            ->where('jabatan', $ttd)
            ->first();
        if (!$pejabat) {
            $pejabat = (object)[
                'nama' => 'Nama tidak ditemukan',
                'nip' => 'NIP tidak tersedia'
            ];
        }

        $pdf = Pdf::loadView('surat.cetak', [
            'kode_surat' => $kode_surat,
            'data' => $data,
            'desa' => $desa,
            'pejabat' => $pejabat,
            'ttd' => $ttd
        ]);

        return $pdf->stream("surat-{$kode_surat}-{$no_pengajuan}.pdf");
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
