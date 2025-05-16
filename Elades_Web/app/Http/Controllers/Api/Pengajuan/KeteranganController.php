<?php

namespace App\Http\Controllers\Api\Pengajuan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class KeteranganController extends Controller
{
    //pengajuan_sktm
    public function sktm(Request $request)
    {
        // Validasi data
        $validator = Validator::make($request->all(), [
            'kode_surat' => 'required|string|max:255',

            // Bapak
            'nama_bapak' => 'required|string|max:255',
            'tempat_tanggal_lahir_bapak' => 'required|string|max:255',
            'pekerjaan_bapak' => 'required|string|max:255',
            'alamat_bapak' => 'required|string|max:500',

            // Ibu
            'nama_ibu' => 'required|string|max:255',
            'tempat_tanggal_lahir_ibu' => 'required|string|max:255',
            'pekerjaan_ibu' => 'required|string|max:255',
            'alamat_ibu' => 'required|string|max:500',

            // Anak
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:20',
            'tempat_tanggal_lahir_anak' => 'required|string|max:255',
            'jenis_kelamin_anak' => 'required|string|max:10',
            'alamat' => 'required|string|max:500',
            'keperluan' => 'required|string|max:255',

            // Lainnya
            'username' => 'required|string|max:255',
            'file.*' => 'file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()], 422);
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
            DB::table('sktm')->insert([
                'kode_surat' => $request->kode_surat,

                // Bapak
                'nama_bapak' => $request->nama_bapak,
                'tempat_tanggal_lahir_bapak' => $request->tempat_tanggal_lahir_bapak,
                'pekerjaan_bapak' => $request->pekerjaan_bapak,
                'alamat_bapak' => $request->alamat_bapak,

                // Ibu
                'nama_ibu' => $request->nama_ibu,
                'tempat_tanggal_lahir_ibu' => $request->tempat_tanggal_lahir_ibu,
                'pekerjaan_ibu' => $request->pekerjaan_ibu,
                'alamat_ibu' => $request->alamat_ibu,

                // Anak
                'nama' => $request->nama,
                'nik' => $request->nik,
                'tempat_tanggal_lahir_anak' => $request->tempat_tanggal_lahir_anak,
                'jenis_kelamin_anak' => $request->jenis_kelamin_anak,
                'alamat' => $request->alamat,
                'keperluan' => $request->keperluan,

                // File dan username
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

    //pengajuan_penghasilan
    public function penghasilan(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'kode_surat' => 'required|string|max:255',

            // Orang tua
            'nama_ortu' => 'required|string|max:255',
            'tempat_tanggal_lahir_ortu' => 'required|string|max:255',
            'pekerjaan_ortu' => 'required|string|max:255',
            'alamat_ortu' => 'required|string|max:500',

            // Anak
            'nama_anak' => 'required|string|max:255',
            'tempat_tanggal_lahir_anak' => 'required|string|max:255',
            'alamat_anak' => 'required|string|max:500',
            'keperluan' => 'required|string|max:255',

            // Lainnya
            'username' => 'required|string|max:255',
            'file.*' => 'file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }

        // Proses upload file
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
            DB::table('penghasilan_ortu')->insert([
                'kode_surat' => $request->kode_surat,
                'nama_ortu' => $request->nama_ortu,
                'tempat_tanggal_lahir_ortu' => $request->tempat_tanggal_lahir_ortu,
                'pekerjaan_ortu' => $request->pekerjaan_ortu,
                'alamat_ortu' => $request->alamat_ortu,

                'nama_anak' => $request->nama_anak,
                'tempat_tanggal_lahir_anak' => $request->tempat_tanggal_lahir_anak,
                'alamat_anak' => $request->alamat_anak,
                'keperluan' => $request->keperluan,

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
