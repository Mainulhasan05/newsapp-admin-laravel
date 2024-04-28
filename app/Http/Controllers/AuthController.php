<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // Assuming User model is used for users

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validate the user
        $validate = validator($request->only('email', 'password'), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        $credentials = $request->only('email', 'password');
        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    // Create a new user
    public function createUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 2; // Set default role as '2'
        $user->save();
        $users = User::all();
        return view('users.index', compact('users'));
    }

    // Update password
    // public function updatePassword(Request $request)
    // {
    //     $request->validate([
    //         'password' => 'required|string|min:8',
    //     ]);

    //     $user = auth()->user();
    //     $user->password = Hash::make($request->password);
    //     $user->save();

    //     return redirect()->route('dashboard')->with('success', 'Password updated successfully.');
    // }
    public function updatePasswordByAdmin(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|string|min:8',
        ]);

        $user = User::findOrFail($id);
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('dashboard')->with('success', 'User password updated successfully.');
    }

    // Delete user
    public function deleteUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        $users = User::all();
        return view('users.index', compact('users'));
    }

    // Get users list
    public function getUsers()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }
}
