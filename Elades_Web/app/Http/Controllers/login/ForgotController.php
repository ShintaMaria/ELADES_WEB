<?php

namespace App\Http\Controllers\login;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;

class ForgotController extends Controller
{
    // menampilkan halaman form lupa password
    public function showLinkRequestForm()
    {
        return view('login.forgot-password'); // sesuaikan dengan nama file blade-mu
    }

    // mengirimkan email link reset password
    public function sendResetLinkEmail(Request $request)
    {
        // validasi email
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        // kirim link reset ke email
        $status = Password::sendResetLink(
            $request->only('email')
        );

        // cek status dan arahkan kembali dengan pesan
        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }
}
