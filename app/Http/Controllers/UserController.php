<?php

use App\Http\Middleware\Authenticate as MiddlewareAuthenticate;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller;
use App\Models\User;

class UserController extends Authenticate {
    public function show() {
        return view('profile', ['user' => Auth::user()]);
    }

    public function update(Request $request) {
        $user = Auth::user();
        $request->validate([
            'fullname' => 'required|string',
            'username' => 'required|string|unique:users,username,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'avatar' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }

        $user->fullname = $request->fullname;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->save();
    
        return back()->with('success', 'Cập nhật thành công');
    }
}
