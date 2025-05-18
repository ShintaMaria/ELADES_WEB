<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    //flutter
    public function login(Request $request)
    {
        $login = $request->input('login');
        $password = $request->input('password');

        if (empty($login) || empty($password)) {
            return response()->json([
                'success' => false,
                'message' => 'Email/No HP dan password harus diisi'
            ]);
        }

        $user = DB::table('akun_user')
            ->where('email', $login)
            ->orWhere('no_hp', $login)
            ->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Email atau No HP tidak ditemukan'
            ]);
        }

        if (!Hash::check($password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Password salah'
            ]);
        }

        unset($user->password);

        return response()->json([
            'success' => true,
            'message' => 'Login berhasil',
            'user' => $user
        ]);
    }

    public function saveGoogleUser(Request $request){
        $data = $request->only(['email', 'nama', 'no_hp', 'profile_image']);

        // Validasi input
        if (empty($data['email']) || empty($data['nama'])) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak lengkap',
            ]);
        }

        // Cek apakah user sudah ada
        $user = DB::table('akun_user')->where('email', $data['email'])->first();

        if ($user) {
            unset($user->password); // Hilangkan password jika ada
            return response()->json([
                'success' => true,
                'message' => 'User found',
                'user' => $user,
                'existing' => true
            ]);
        }

        // Jika belum ada, buat user baru
        $id = DB::table('akun_user')->insertGetId([
            'nama' => $data['nama'],
            'email' => $data['email'],
            'no_hp' => $data['no_hp'] ?? null,
            'profile_image' => $data['profile_image'] ?? null
        ]);

        return response()->json([
            'success' => true,
            'message' => 'User created',
            'user' => [
                'id_user' => $id,
                'nama' => $data['nama'],
                'email' => $data['email'],
                'no_hp' => $data['no_hp'] ?? null,
                'profile_image' => $data['profile_image'] ?? null
            ],
            'existing' => false
        ]);
    }
}
