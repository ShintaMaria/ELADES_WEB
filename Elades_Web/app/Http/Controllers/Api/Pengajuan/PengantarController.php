<?php

namespace App\Http\Controllers\Api\Pengajuan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PengantarController extends Controller
{
    //pengajuan_skck
    public function skck(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'kode_surat' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:20',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|string|max:10',
            'kebangsaan' => 'required|string|max:100',
            'agama' => 'required|string|max:100',
            'jenis_kelamin' => 'required|string|max:10',
            'status_perkawinan' => 'required|string|max:50',
            'pekerjaan' => 'required|string|max:255',
            'alamat' => 'required|string|max:500',
            'username' => 'required|string|max:255',
            'file.*' => 'file|mimes:jpg,jpeg,png,pdf|max:10240', // maksimal 2MB per file
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }

        // Upload multiple files (jika ada)
        $fileNames = [];
        $fileUrls = [];

        if ($request->hasFile('file')) {
            // Buat direktori jika belum ada
            $destinationPath = public_path('uploads/pengajuan');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            foreach ($request->file('file') as $file) {
                if ($file->isValid()) {
                    // Buat nama file unik
                    $extension = $file->getClientOriginalExtension();
                    $fileName = 'skck_' . time() . '_' . uniqid() . '.' . $extension;

                    // Pindahkan file ke public/uploads/pengajuan
                    $file->move($destinationPath, $fileName);

                    // Simpan nama file dan URL-nya
                    $fileNames[] = $fileName;
                    $fileUrls[] = asset('uploads/pengajuan/' . $fileName);
                }
            }
        }

        // Simpan data ke DB menggunakan Query Builder
        try {
            DB::table('skck')->insert([
                'kode_surat' => $request->kode_surat,
                'nama' => $request->nama,
                'nik' => $request->nik,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'kebangsaan' => $request->kebangsaan,
                'agama' => $request->agama,
                'jenis_kelamin' => $request->jenis_kelamin,
                'status_perkawinan' => $request->status_perkawinan,
                'pekerjaan' => $request->pekerjaan,
                'alamat' => $request->alamat,
                'file' => !empty($fileNames) ? json_encode($fileNames) : null,
                'username' => $request->username,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Data SKCK berhasil disimpan',
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    //pengajuan_kehilangan
    public function kehilangan(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'kode_surat' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|string|max:10',
            'agama' => 'required|string|max:100',
            'jenis_kelamin' => 'required|string|max:10',
            'pekerjaan' => 'required|string|max:255',
            'alamat' => 'required|string|max:500',
            'barang' => 'required|string|max:255',
            'tanggal_hilang' => 'required|string|max:10',
            'tempat_kehilangan' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'file.*' => 'file|mimes:jpg,jpeg,png,pdf|max:10240', // max 10MB per file
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }

        // Upload multiple files (jika ada)
        $fileNames = [];
        $fileUrls = [];

        if ($request->hasFile('file')) {
            // Buat direktori jika belum ada
            $destinationPath = public_path('uploads/pengajuan');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            foreach ($request->file('file') as $file) {
                if ($file->isValid()) {
                    $extension = $file->getClientOriginalExtension();
                    $fileName = 'kehilangan_' . time() . '_' . uniqid() . '.' . $extension;

                    $file->move($destinationPath, $fileName);

                    $fileNames[] = $fileName;
                    $fileUrls[] = asset('uploads/pengajuan/' . $fileName);
                }
            }
        }

        // Simpan data ke DB
        try {
            DB::table('surat_kehilangan_barang')->insert([
                'kode_surat' => $request->kode_surat,
                'nama' => $request->nama,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'agama' => $request->agama,
                'jenis_kelamin' => $request->jenis_kelamin,
                'pekerjaan' => $request->pekerjaan,
                'alamat' => $request->alamat,
                'barang_yang_hilang' => $request->barang,
                'hilang_pada_tanggal' => $request->tanggal_hilang,
                'tempat_kehilangan' => $request->tempat_kehilangan,
                'file' => !empty($fileNames) ? json_encode($fileNames) : null,
                'username' => $request->username,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Data kehilangan berhasil disimpan',
                // 'file_urls' => $fileUrls // aktifkan kalau mau balikin URL file juga
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
