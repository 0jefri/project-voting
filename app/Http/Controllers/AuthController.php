<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $username = strtolower($request->username);

        if (
            Auth::attempt([
                'username' => $username,
                'password' => $request->password,
            ])
        ) {
            $user = Auth::user();

            // Redirect berdasarkan role
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role === 'mahasiswa') {
                return redirect()->route('mahasiswa.dashboard');
            }
        }

        return back()->withErrors(['login' => 'Username atau password salah!']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}


