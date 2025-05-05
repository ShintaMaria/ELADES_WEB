<?php

namespace App\Http\Controllers\surat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PengajuanSurat;
class SkckController extends Controller
{
    public function show($id) {
        $skck = PengajuanSurat::findOrFail($id);
        return view('surat.pengantar.skck', compact('skck'));
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
