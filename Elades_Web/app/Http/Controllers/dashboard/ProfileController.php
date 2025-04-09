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
        ]);

        $user = Auth::user();

        // hapus foto lama jika ada
        if ($user->gambar && Storage::exists('public/gambar_profil/' . $user->gambar)) {
            Storage::delete('public/gambar_profil/' . $user->gambar);
        }

        // simpan foto baru
        $fotoBaru = $request->file('foto')->store('public/gambar_profil');
        $namaFile = basename($fotoBaru);

        $user->gambar = $namaFile;
        $user->save();

        return back()->with('profile_update', 'Foto profil berhasil diperbarui.');
    }

    // update password
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('profile_gagal', 'Password lama tidak sesuai.');
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('profile_update', 'Password berhasil diperbarui.');
    }

    public function deletePhoto(Request $request)
    {
        $user = Auth::user();

        if ($user->gambar) {
            Storage::delete('public/gambar_profil/' . $user->gambar);
            $user->gambar = null;
            $user->save();

            return back()->with('profile_update', 'Foto profil berhasil dihapus.');
        }

        return back()->with('profile_gagal', 'Tidak ada foto profil untuk dihapus.');
    }

}
