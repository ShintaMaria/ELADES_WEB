<?php

namespace App\Http\Controllers\login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('login.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        // validasi dengan custom pesan
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ], [
            'email.exists' => 'Email tidak terdaftar dalam sistem kami.',
        ]);

        // kirim link reset password
        $status = Password::sendResetLink(
            $request->only('email')
        );

        // custom pesan sukses / gagal
        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', 'Kami telah mengirimkan Link ke email Anda.')
            : back()->withErrors(['email' => 'Terjadi kesalahan saat mengirim Link. Silakan coba lagi.']);
    }
}
