<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    //upload_profile_image
    public function upload_profile_image(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_user' => 'required|integer|exists:akun_user,id_user',
            'profile_image' => 'required|image|mimes:jpg,jpeg,png|max:2048', // 2MB max
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 422);
        }

        $file = $request->file('profile_image');
        $extension = $file->getClientOriginalExtension();
        $filename = 'profile_' . $request->id_user . '_' . time() . '.' . $extension;

        // Simpan file di storage/app/public/foto_profile
        $path = $file->storeAs('public/uploads/uploads/foto_profile', $filename);

        // Buat URL yang bisa diakses
        $url = asset('storage/uploads/foto_profile/' . $filename);

        // Simpan ke database
        try {
            DB::table('akun_user')
                ->where('id_user', $request->id_user)
                ->update(['profile_image' => $url]);

            return response()->json([
                'status' => 'success',
                'message' => 'Gambar profil berhasil diupload',
                'image_url' => $url
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal update database: ' . $e->getMessage(),
            ], 500);
        }
    }

    //update_profile
    public function update_profile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_user' => 'required|integer|exists:akun_user,id_user',
            'nama' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'no_hp' => 'nullable|string|max:20',
            'profile_image' => 'nullable|url|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 422);
        }

        try {
            $id_user = $request->id_user;

            // Siapkan array data yang ingin diperbarui
            $updateData = [
                'nama' => $request->nama,
            ];

            if ($request->has('email')) {
                $updateData['email'] = $request->email;
            }

            if ($request->has('no_hp')) {
                $updateData['no_hp'] = $request->no_hp;
            }

            if ($request->has('profile_image')) {
                $updateData['profile_image'] = $request->profile_image;
            }

            $updated = DB::table('akun_user')
                ->where('id_user', $id_user)
                ->update($updateData);

            return response()->json([
                'status' => 'success',
                'message' => $updated ? 'Profil berhasil diperbarui' : 'Tidak ada perubahan data',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    //update_password
    public function update_password(Request $request)
    {
        $validated = $request->validate([
            'id_user' => 'required|integer',
            'password' => 'required|string|min:8',
        ], [
            'id_user.required' => 'ID user harus diisi',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 8 karakter',
        ]);

        $idUser = $validated['id_user'];
        $newPassword = $validated['password'];

        Log::info("Password update request received for user id: {$idUser}");

        // Cek user apakah ada
        $userExists = DB::table('akun_user')->where('id_user', $idUser)->exists();

        if (!$userExists) {
            return response()->json([
                'success' => false,
                'message' => 'User dengan ID tersebut tidak ditemukan'
            ], 404);
        }

        // Update password
        $hashedPassword = Hash::make($newPassword);

        try {
            $updated = DB::table('akun_user')
                ->where('id_user', $idUser)
                ->update(['password' => $hashedPassword]);

            if ($updated) {
                Log::info("Password updated successfully for user id: {$idUser}");

                return response()->json([
                    'success' => true,
                    'message' => 'Password berhasil diperbarui'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Tidak ada perubahan data pada password'
                ]);
            }
        } catch (\Exception $e) {
            Log::error("Failed to update password for user id: {$idUser}, error: " . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate password: ' . $e->getMessage(),
            ], 500);
        }
    }
}
