<?php

namespace App\Http\Controllers\pengaduan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Infrastruktur;
class InfrastrukturController extends Controller
{
    public function index()
    {
        $infrastruktur = Infrastruktur::all(); // Ambil semua data
        return view('pengaduan.infrastruktur', compact('infrastruktur'));
    }
    public function updateStatus(Request $request, $id)
{
    $infra = Infrastruktur::find($id);

    if (!$infra) {
        return response()->json(['success' => false, 'message' => 'Data tidak ditemukan']);
    }

    $infra->status = $request->status;
    $infra->save();

    return response()->json(['success' => true]);

    }
}
