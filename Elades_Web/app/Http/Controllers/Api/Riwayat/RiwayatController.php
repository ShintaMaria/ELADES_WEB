<?php

namespace App\Http\Controllers\Api\Riwayat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RiwayatController extends Controller
{
    public function getPengajuanMasuk(Request $request)
    {
        try {
            $username = $request->input('username');
            $allowedStatuses = ['Masuk', 'Tolak', 'Selesai'];

            $pengajuan = DB::table('laporan')
                ->join('pengajuan_surat', 'pengajuan_surat.id', '=', 'laporan.id')
                ->whereIn('laporan.status', $allowedStatuses)
                ->where('pengajuan_surat.username', $username)
                ->groupBy(
                    'pengajuan_surat.id',
                    'pengajuan_surat.kode_surat',
                    'pengajuan_surat.nama',
                    'pengajuan_surat.no_pengajuan',
                    'laporan.tanggal',
                    'laporan.status'
                ) // Coba komentari ini dulu
                ->orderBy('pengajuan_surat.tanggal', 'desc')
                ->select(
                    'pengajuan_surat.id as id',
                    'pengajuan_surat.kode_surat',
                    'pengajuan_surat.nama',
                    'pengajuan_surat.no_pengajuan',
                    'laporan.tanggal',
                    'laporan.status'
                )
                ->get();

            if ($pengajuan->isEmpty()) {
                return response()->json([
                    'kode' => 0,
                    'pesan' => 'Data Tidak Tersedia',
                ]);
            }

            $data = $pengajuan->map(function ($item) {
                return [
                    'id' => (string) $item->no_pengajuan,
                    'kode_surat' => $item->kode_surat,
                    'nama' => $item->nama,
                    'no_pengajuan' => (string) $item->no_pengajuan,
                    'tanggal' => $item->tanggal,
                    'status' => $item->status,
                ];
            });

            return response()->json([
                'kode' => 1,
                'pesan' => 'Data Tersedia',
                'data' => $data,
            ]);
        } catch (\Exception $e) {
            Log::error('Riwayat Error: ' . $e->getMessage());
            return response()->json([
                'kode' => 0,
                'pesan' => 'Terjadi error: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function getPengaduanMasuk(Request $request)
    {
        $username = $request->input('username');

        // Query pakai Query Builder
        $pengaduan = DB::table('laporan')
            ->join('pengaduan', 'pengaduan.id', '=', 'laporan.id')
            ->where('laporan.status', 'Masuk')
            ->where('pengaduan.username', $username)
            ->groupBy('pengaduan.id')
            ->orderBy('pengaduan.tanggal', 'desc')
            ->select(
                'pengaduan.id as id',
                'pengaduan.nama',
                'pengaduan.no_pengajuan',
                'laporan.tanggal',
                'laporan.status'
            )
            ->get();

        // Cek apakah data tersedia
        if ($pengaduan->isEmpty()) {
            return response()->json([
                'kode' => 0,
                'pesan' => 'Data Tidak Tersedia',
            ]);
        }

        // Format responsenya
        $data = $pengaduan->map(function ($item) {
            return [
                'id' => $item->no_pengajuan,
                'nama' => $item->nama,
                'no_pengajuan' => $item->no_pengajuan,
                'tanggal' => $item->tanggal,
                'status' => $item->status,
            ];
        });

        return response()->json([
            'kode' => 1,
            'pesan' => 'Data Berhasil Diambil',
            'data' => $data
        ]);
    }
}
