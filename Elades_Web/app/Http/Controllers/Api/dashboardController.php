<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class dashboardController extends Controller
{
    //kabar_desa
    public function kabardesa()
    {
        Log::info("dashboardController@kabardesa: Script started");

        try {
            $data = DB::table('kabar_desa')
                ->select('id', 'judul', 'deskripsi', 'gambar', 'tanggal')
                ->orderByDesc('tanggal')
                ->limit(5)
                ->get();

            if ($data->isEmpty()) {
                Log::info("dashboardController@kabardesa: No rows found in kabar_desa table");
            } else {
                Log::info("dashboardController@kabardesa: Found " . count($data) . " rows");
            }

            Log::info("dashboardController@kabardesa: JSON output - " . json_encode($data));

            return response()->json($data, 200);
        } catch (\Exception $e) {
            Log::error("dashboardController@kabardesa: Exception - " . $e->getMessage());
            return response()->json(['error' => 'Terjadi kesalahan saat mengambil data'], 500);
        }
    }

    //status_pengajuan
    public function statuspengajuan(Request $request)
    {
        // Validasi input username
        $request->validate([
            'username' => 'required|string|max:255',
        ]);

        $username = $request->input('username');

        // Query dengan Query Builder
        $result = DB::table('laporan')
            ->join('pengajuan_surat', 'laporan.id', '=', 'pengajuan_surat.id')
            ->where('pengajuan_surat.username', $username)
            ->selectRaw("
                SUM(CASE WHEN laporan.status = 'Selesai' THEN 1 ELSE 0 END) as Selesai,
                SUM(CASE WHEN laporan.status = 'Masuk' THEN 1 ELSE 0 END) as Masuk,
                SUM(CASE WHEN laporan.status = 'Tolak' THEN 1 ELSE 0 END) as Tolak
            ")
            ->first();

        // Jika query berhasil tapi data kosong (bisa terjadi kalau tidak ada data)
        if ($result) {
            $response = [
                'kode' => true,
                'pesan' => 'Berhasil Mengambil Data',
                'data' => [
                    [
                        'Selesai' => (int) ($result->Selesai ?? 0),
                        'Masuk' => (int) ($result->Masuk ?? 0),
                        'Tolak' => (int) ($result->Tolak ?? 0),
                    ]
                ],
            ];
        } else {
            $response = [
                'kode' => false,
                'pesan' => 'Data tidak ditemukan atau query gagal',
            ];
        }

        return response()->json($response);
    }
}
