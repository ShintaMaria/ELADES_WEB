<?php

namespace App\Http\Controllers\login;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // menampilkan halaman login
    public function showLoginForm()
    {
        // arahkan ke file resources/views/login/login.blade.php
        return view ('login.login');
    }

    // proses login
    public function login(Request $request)
    {
        // validasi input dari form
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ]);

        // ambil email dan password dari form
        $credentials = $request->only('email', 'password');

        // cek apakah email dan password cocok
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // untuk keamanan session

            // arahkan ke dashboard setelah berhasil login
            return redirect()->intended('dashboardd'); 
        }

        // jika login gagal
        return back()->with('error', 'Email atau password salah.')->withInput();
    }

    // proses logout
    public function logout(Request $request)
    {
        Auth::logout(); // logout user

        // invalidate session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // arahkan ke halaman login
        return redirect('/landing_page');
    }
}
