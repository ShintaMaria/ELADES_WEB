<?php

namespace App\Http\Controllers\Api\Pengajuan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class IzinController extends Controller
{
    //pengajuan_TidakMasukKerja
    public function TidakMasukKerja(Request $request)
    {
        // Validasi data input
        $validator = Validator::make($request->all(), [
            'kode_surat' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'tempat_tanggal_lahir' => 'required|string|max:255',
            'alamat' => 'required|string|max:500',
            'tanggal_izin' => 'required|date',
            'alasan' => 'required|string|max:1000',
            'instansi' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'file.*' => 'file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }

        // Handle upload file
        $fileNames = [];
        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $file) {
                if ($file->isValid()) {
                    $path = $file->store('public/uploads/pengajuan');
                    $fileNames[] = basename($path);
                }
            }
        }

        try {
            DB::table('surat_izin_tidak_masuk_kerja')->insert([
                'kode_surat' => $request->kode_surat,
                'nama' => $request->nama,
                'tempat_tanggal_lahir' => $request->tempat_tanggal_lahir,
                'alamat' => $request->alamat,
                'tanggal_izin' => $request->tanggal_izin,
                'alasan' => $request->alasan,
                'instansi' => $request->instansi,
                'file' => !empty($fileNames) ? json_encode($fileNames) : null,
                'username' => $request->username,
            ]);

            return response()->json(['status' => 'success'], 201);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menyimpan data: ' . $e->getMessage(),
            ], 500);
        }
    }
    
    //pengajuan_keramaian
    public function keramaian(Request $request)
    {
        // Validasi request
        $validator = Validator::make($request->all(), [
            'kode_surat' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:500',
            'nik' => 'required|string|max:20',
            'kegiatan' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'waktu' => 'required|string|max:50',
            'tempat' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'file.*' => 'file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }

        // Upload file
        $fileNames = [];
        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $file) {
                if ($file->isValid()) {
                    $path = $file->store('public/uploads/pengajuan');
                    $fileNames[] = basename($path);
                }
            }
        }

        try {
            DB::table('surat_izin_keramaian')->insert([
                'kode_surat' => $request->kode_surat,
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'nik' => $request->nik,
                'kegiatan' => $request->kegiatan,
                'tanggal' => $request->tanggal,
                'waktu' => $request->waktu,
                'tempat' => $request->tempat,
                'file' => !empty($fileNames) ? json_encode($fileNames) : null,
                'username' => $request->username,
            ]);

            return response()->json(['status' => 'success'], 201);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menyimpan data: ' . $e->getMessage(),
            ], 500);
        }
    }
}
