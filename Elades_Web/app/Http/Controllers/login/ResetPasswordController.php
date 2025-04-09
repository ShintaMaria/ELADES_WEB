<?php

namespace App\Http\Controllers\login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    // menampilkan form reset password
    public function showResetForm(Request $request, $token)
    {
        // jika token atau email kosong
        if (!$token || !$request->email) {
            return redirect()->route('login');
        }

        return view('login.reset-password', [
            'token' => $token,
            'email' => $request->email
        ]);
    }

    // memproses reset password
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ], [
            'token.required' => 'Token reset password tidak ditemukan.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password baru wajib diisi.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.min' => 'Password harus minimal 6 karakter.',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('status', 'Password Anda telah berhasil diganti.');
        }

        // deteksi token expired saat reset
        $pesan = match ($status) {
            Password::INVALID_TOKEN => 'Link reset password sudah kedaluwarsa atau tidak valid.',
            Password::INVALID_USER => 'Email tidak ditemukan.',
            default => 'Gagal mengganti password. Silakan cek kembali email dan token Anda.',
        };

        return back()->withErrors(['email' => $pesan]);
    }

    
}
