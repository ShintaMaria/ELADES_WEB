<?php

namespace App\Http\Controllers\Api\Pengaduan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PengaduanController extends Controller
{
    //pengaduan_infrastruktur
    public function infrastruktur(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_pengaduan' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:20',
            'alamat' => 'required|string|max:500',
            'jenis_infrastruktur' => 'required|string|max:100',
            'deskripsi' => 'required|string|max:1000',
            'tanggal_kejadian' => 'required|string|max:20',
            'lokasi' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'file.*' => 'file|mimes:jpg,jpeg,png,pdf,doc,docx|max:10240'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }

        // Upload files
        $fileNames = [];
        if ($request->hasFile('file')) {
            $destinationPath = public_path('uploads/pengaduan');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
        
            foreach ($request->file('file') as $file) {
                if ($file->isValid()) {
                    $extension = $file->getClientOriginalExtension();
                    $fileName = 'infrastruktur_' . time() . '_' . uniqid() . '.' . $extension;
                    $file->move($destinationPath, $fileName);
                    $fileNames[] = $fileName;
                }
            }
        }

        try {
            DB::table('pengaduan_infrastruktur')->insert([
                'kode_pengaduan' => $request->kode_pengaduan,
                'nama' => $request->nama,
                'nik' => $request->nik,
                'alamat' => $request->alamat,
                'jenis_infrastruktur' => $request->jenis_infrastruktur,
                'deskripsi' => $request->deskripsi,
                'tanggal_kejadian' => $request->tanggal_kejadian,
                'lokasi' => $request->lokasi,
                'file' => !empty($fileNames) ? json_encode($fileNames) : null,
                'username' => $request->username,
            ]);

            return response()->json(['status' => 'success'], 201);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menyimpan data: ' . $e->getMessage()
            ], 500);
        }
    }

    //pengaduan_keamanan
    public function keamanan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_pengaduan' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:20',
            'jenis_kasus' => 'required|string|max:255',
            'lokasi_kejadian' => 'required|string|max:255',
            'tanggal' => 'required|string|max:20',
            'waktu' => 'required|string|max:20',
            'deskripsi' => 'required|string|max:1000',
            'username' => 'required|string|max:255',
            'file.*' => 'file|mimes:jpg,jpeg,png,pdf,doc,docx|max:10240'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }

        // Handle multiple file uploads
        $fileNames = [];
        if ($request->hasFile('file')) {
            $destinationPath = public_path('uploads/pengaduan');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
        
            foreach ($request->file('file') as $file) {
                if ($file->isValid()) {
                    $extension = $file->getClientOriginalExtension();
                    $fileName = 'keamanan_' . time() . '_' . uniqid() . '.' . $extension;
                    $file->move($destinationPath, $fileName);
                    $fileNames[] = $fileName;
                }
            }
        }

        try {
            DB::table('pengaduan_keamanan')->insert([
                'kode_pengaduan' => $request->kode_pengaduan,
                'nama' => $request->nama,
                'nik' => $request->nik,
                'jenis_kasus' => $request->jenis_kasus,
                'lokasi_kejadian' => $request->lokasi_kejadian,
                'tanggal' => $request->tanggal,
                'waktu' => $request->waktu,
                'deskripsi' => $request->deskripsi,
                'file' => !empty($fileNames) ? json_encode($fileNames) : null,
                'username' => $request->username,
            ]);

            return response()->json(['status' => 'success'], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menyimpan data: ' . $e->getMessage()
            ], 500);
        }
    }

    //pengaduan_saran
    public function saran(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_pengaduan' => 'required|string|max:255',
            'alamat' => 'nullable|string|max:255',
            'topik' => 'required|string|max:255',
            'judul_saran' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:1000',
            'tanggal' => 'required|string|max:20',
            'nama' => 'nullable|string|max:255',
            'username' => 'required|string|max:255',
            'file.*' => 'file|mimes:jpg,jpeg,png,pdf,doc,docx|max:10240',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 422);
        }

        $fileNames = [];
        if ($request->hasFile('file')) {
            $destinationPath = public_path('uploads/pengaduan');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
        
            foreach ($request->file('file') as $file) {
                if ($file->isValid()) {
                    $extension = $file->getClientOriginalExtension();
                    $fileName = 'saran_' . time() . '_' . uniqid() . '.' . $extension;
                    $file->move($destinationPath, $fileName);
                    $fileNames[] = $fileName;
                }
            }
        }

        try {
            DB::table('pengaduan_saran')->insert([
                'kode_pengaduan' => $request->kode_pengaduan,
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'topik' => $request->topik,
                'judul_saran' => $request->judul_saran,
                'deskripsi' => $request->deskripsi,
                'tanggal' => $request->tanggal,
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
