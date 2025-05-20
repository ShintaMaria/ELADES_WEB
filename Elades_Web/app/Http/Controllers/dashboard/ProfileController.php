<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
class ProfileController extends Controller
{
    public function show()
    {
        return view('profil.profile', ['user' => Auth::user()]);
    }
    // update foto profil
    public function updatePhoto(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'foto.required' => 'Foto profil wajib diunggah.',
            'foto.image' => 'File yang diunggah harus berupa gambar.',
            'foto.mimes' => 'Format gambar harus JPG, JPEG, atau PNG.',
            'foto.max' => 'Ukuran gambar maksimal 2 MB.',
        ]);

        $user = Auth::user();

        // hapus foto lama jika ada
        if ($user->gambar && Storage::disk('public')->exists('gambar_profil/' . $user->gambar)) {
            Storage::disk('public')->delete('gambar_profil/' . $user->gambar);
        }

        // simpan foto baru dengan nama unik
        $namaFile = uniqid() . '.' . $request->file('foto')->getClientOriginalExtension();
        $request->file('foto')->storeAs('gambar_profil', $namaFile, 'public');

        // update nama file ke kolom 'gambar'
        $user->gambar = $namaFile;
        $user->save();

        return back()->with('profile_update', 'Foto profil berhasil diperbarui.');
    }

    // update password
    public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|min:6|confirmed',
    ], [
        'current_password.required' => 'Password lama wajib diisi.',
        'new_password.required' => 'Password baru wajib diisi.',
        'new_password.min' => 'Password  minimal 6 karakter.',
        'new_password.confirmed' => 'Konfirmasi password baru tidak sesuai.',
    ]);

    $user = Auth::user();

    if (!Hash::check($request->current_password, $user->password)) {
        return back()->with('profile_gagal', 'Password lama tidak sesuai.');
    }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('profile_update', 'Password berhasil diperbarui.');
    }

    // hapus foto profil
    public function deletePhoto(Request $request)
    {
        $user = Auth::user();

        if ($user->gambar && Storage::disk('public')->exists('gambar_profil/' . $user->gambar)) {
            Storage::disk('public')->delete('gambar_profil/' . $user->gambar);
            $user->gambar = null;
            $user->save();

            return back()->with('profile_update', 'Foto profil berhasil dihapus.');
        }

        return back()->with('profile_gagal', 'Tidak ada foto profil untuk dihapus.');
    }

}
