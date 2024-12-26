<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Tambahkan ini
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function updateProfile(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|mimes:jpeg,png,jpg,gif|max:10000',
        ]);        

        $user = Auth::user();

        if ($request->hasFile('profile_picture')) {
            // Simpan foto profil
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');

            // Hapus foto lama jika ada
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            $user->profile_picture = $path;
            $user->save();
        }

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }
}
