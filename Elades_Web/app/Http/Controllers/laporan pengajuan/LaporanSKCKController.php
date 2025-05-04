<?php
namespace App\Http\Controllers\pengaduan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LaporanSKCK;

class LaporanSKCKController extends Controller
{
    public function index()
    {
        $laporanSKCK = LaporanSKCK::all(); // Ambil semua data laporan SKCK
        return view('pengaduan.laporan-skck', compact('laporanSKCK'));
    }

    public function updateStatus(Request $request, $id)
    {
        $laporan = LaporanSKCK::find($id);

        if (!$laporan) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan']);
        }

        // Update status sesuai dengan data yang dikirimkan dari frontend
        $laporan->status = $request->status;
        $laporan->save();

        return response()->json(['success' => true, 'message' => 'Status berhasil diperbarui']);
    }
}
