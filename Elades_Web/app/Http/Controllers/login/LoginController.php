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


        // cek apakah email dan password cocok
        if (Auth::Login()) {
 
            // arahkan ke dashboard setelah berhasil login
            return redirect()->route('dashboardd'); 
        }

        // jika login gagal
        return back()->with('error', 'Email atau password salah.')->withInput();
    }

    // proses logout
    public function logout(Request $request)
    {
        Auth::logout(); // logout user

        return redirect('/landing_page');
    }
}
