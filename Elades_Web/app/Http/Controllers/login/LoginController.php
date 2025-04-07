<?php

namespace App\Http\Controllers\login;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    // menampilkan halaman login
    public function showLoginForm()
    {
        return view('login.login'); // pastikan view-nya berada di resources/views/login/login.blade.php
    }

    // proses login
    public function login(Request $request)
    {
        // validasi input
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ]);

        // ambil data dari form
        $credentials = $request->only('email', 'password');

        // cek login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // penting untuk mencegah session fixation
            return redirect()->intended('/dashboard/dashboardd'); // arahkan ke halaman dashboard
        }

        // jika gagal login
        return back()->withErrors([
            'login_error' => 'Email atau password salah.',
        ])->withInput();
    }

    // proses logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
