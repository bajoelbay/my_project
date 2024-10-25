<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class ProfileController extends Controller
{

    public function show()
    {
       $user = Auth::user();  
        return view('profile.show', compact('user'));
    }
    public function edit()
    {
       $user = Auth::user();  
        return view('profile.edit', compact('user'));
    }
    public function update(Request $request)
    {
        $request->validate([
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = auth()->user();

        if ($request->hasFile('profile_picture')) {
            // Hapus foto profil lama dari S3 jika ada
            if ($user->profile_picture) {
                Storage::disk('s3')->delete($user->profile_picture);
            }

            // Upload foto profil baru ke S3
            $path = $request->file('profile_picture')->store('profile_pictures', 's3');

            // Set file agar dapat diakses secara publik
            Storage::disk('s3')->setVisibility($path, 'public');

            // Simpan path foto profil di database
            $user->profile_picture = $path;
        }

        $user->save();

         return redirect()->route('profile.show')->with('status', 'Profile updated successfully.');
    }
}
