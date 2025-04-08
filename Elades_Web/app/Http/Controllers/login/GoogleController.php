<?php

namespace App\Http\Controllers\login;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    // mengarahkan ke halaman login Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // menangani callback setelah login Google
    public function handleGoogleCallback()
    {
        try {
            // mengambil data user dari Google
            $googleUser = Socialite::driver('google')->stateless()->user();

            // mencari user berdasarkan email
            $user = User::where('email', $googleUser->getEmail())->first();

            // jika email tidak ditemukan di database, tolak login
            if (!$user) {
                return redirect()->route('login')->with('error', 'Email anda tidak terdaftar.');
            }

            // login user yang ditemukan
            Auth::login($user);

            // redirect ke dashboard
            return redirect()->intended('/dashboardd');

        } catch (\Exception $e) {
            // jika terjadi kesalahan, kembali ke login dengan pesan error
            return redirect()->route('login')->with('error', 'Gagal login dengan Google. Silakan coba lagi.');
        }
    }
}
