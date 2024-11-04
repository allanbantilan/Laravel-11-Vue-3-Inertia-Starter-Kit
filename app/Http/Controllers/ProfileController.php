<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public function index(User $user)
    {


        $user = Auth::user();
        return Inertia::render(
            'Profile/Profile',
            [
                'user' => $user,
                'status' => session('status'),
            ]
        );
    }

    public function updateProfile(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        // Get the currently authenticated user
        $user = Auth::user();

        // Update user information
        $user->name = $request->name;
        $user->email = $request->email;

        // Save the user
        $user->save();

        // Return a success response using Inertia
        return redirect()->route('profile')->with('status', 'Profile updated successfully.');
    }

    // Method to update password
    public function updatePassword(Request $request)
    {
        // Validate the request
        $request->validate([
            'password' => 'required|string', // current password
            'newPassword' => 'nullable|string|min:6', // new password
        ]);

        // Get the currently authenticated user
        $user = Auth::user();

        // Check if the provided current password matches the stored password
        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()->withErrors(['password' => 'Current password is incorrect.']);
        }

        // Update the password if a new password is provided
        if ($request->filled('newPassword')) {
            $user->password = Hash::make($request->newPassword);
        }

        // Save the user
        $user->save();

        // Return a success response using Inertia
        return redirect()->route('profile' )->with('status', 'Password updated successfully.');
    }
}
