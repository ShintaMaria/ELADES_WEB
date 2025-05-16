<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengajuanSurat;
use App\Models\DetailSKCK;
use App\Models\Keramaian;
use App\Models\Kehilangan;
class DetailPengajuanController extends Controller
{
    public function detailpengajuan(Request $request)
    {
        // Ambil ID pengajuan dan kode surat dari data tersembunyi dalam formulir
        $id_pengajuan = $request->input('id');
        $kode_surat = $request->input('kode_surat');

        // Temukan pengajuan berdasarkan ID
        $pengajuan = PengajuanSurat::find($id_pengajuan);
        // dd($pengajuan);

        if ($pengajuan) {
            // Ambil no_pengajuan setelah menemukan pengajuan
            $no_pengajuan = $pengajuan->no_pengajuan;

            // Mengambil data surat berdasarkan kode surat dan no_pengajuan
            switch ($kode_surat) {
                case 'skck':
                    $detail_surat = DetailSKCK::where('no_pengajuan', $no_pengajuan)->first();
                    break;
                // case 'sktm':
                //     $detail_surat = Sktm::where('no_pengajuan', $no_pengajuan)->first();
                //     break;
                case 'keramaian':
                    $detail_surat = Keramaian::where('no_pengajuan', $no_pengajuan)->first();
                    break;
                case 'kehilangan':
                    $detail_surat = Kehilangan::where('no_pengajuan', $no_pengajuan)->first();
                    break;
                    // Tambahkan case lain jika ada jenis surat lainnya
                default:
                    $detail_surat = null;
                    break;
            }

            // if ($detail_surat) {
            //     // Jika ditemukan, arahkan ke halaman detail surat dengan data surat yang ditemukan
            //     return view('Admin.detail-pengajuan', compact('detail_surat'));
            // } else {
            //     // Jika pengajuan tidak ditemukan, arahkan kembali ke halaman sebelumnya atau berikan respons yang sesuai
            //     return back()->with('error', 'Pengajuan not found');
            // }
        }
    }
}