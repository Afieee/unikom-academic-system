<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function updateFotoProfile(Request $request, $id_users)
    {
        // Make sure you're using 'id_users' to find the user
        $user = User::where('id_users', $id_users)->first();

        if (!$user) {
            return redirect()->back()->withErrors(['error' => 'User not found.']);
        }

        // Validation for 'foto_profile'
        $request->validate([
            'foto_profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle the uploaded file if it exists
        if ($request->hasFile('foto_profile')) {
            $file = $request->file('foto_profile');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('public/profile_pictures', $filename);

            // Update the user's photo
            $user->setKeyName('id_users'); // Add this line
            $user->foto_profile = $filename;
        }


        // dd($path);

        // Save the updated user record
        $user->save();

        return redirect()->back()->with('success', 'Foto profil berhasil diperbarui.');
    }






}
