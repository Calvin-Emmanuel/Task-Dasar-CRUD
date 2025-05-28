<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('posts.profile', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('posts.profileEdit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:32',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id
        ]);

        $user->update($request->only('name', 'email'));

        return redirect()->route(('profile.show'))->with('success', 'Profile updated successfully');
    }
}
