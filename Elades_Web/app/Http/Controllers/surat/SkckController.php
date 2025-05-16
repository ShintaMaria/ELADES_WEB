<?php

namespace App\Http\Controllers\surat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PengajuanSurat;
use App\Models\DetailSKCK;
class SkckController extends Controller
{
    public function show($id)
{
    try {
        $skck = DetailSKCK::findOrFail($id); // tanpa with()

        return response()->json([
            'success' => true,
            'data' => $skck
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Data tidak ditemukan'
        ], 404);
    }
}


    public function selesai($id) {
        $skck = PengajuanSurat::findOrFail($id);
        $skck->status = 'selesai';
        $skck->save();
        return redirect()->back()->with('success', 'Pengajuan diselesaikan.');
    }

    public function tolak($id) {
        $skck = PengajuanSurat::findOrFail($id);
        $skck->status = 'ditolak';
        $skck->save();
        return redirect()->back()->with('success', 'Pengajuan ditolak.');
    }

}