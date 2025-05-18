<?php

namespace App\Http\Controllers;
use Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Notifikasi;
class NotifikasiController extends Controller
{
    public function index()
{
    $notifikasi = DB::table('notifikasi_web')->orderBy('tanggal', 'desc')->get();
    $jumlahNotifikasi = $notifikasi->count();

    return view('dashboard', compact('notifikasi', 'jumlahNotifikasi'));
}
    public function clearNotifikasi()
{
    DB::table('notifikasi_web')->truncate(); // atau delete()
    return redirect()->back()->with('status', 'Semua notifikasi telah dibaca.');
}

}
