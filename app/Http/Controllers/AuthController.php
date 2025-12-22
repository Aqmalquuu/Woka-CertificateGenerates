<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function loginForm()  
    {
        return view('auth.login');
    }

    public function login(Request $request)  
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($data)) {
            $request->session()->regenerate();
            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Selamat Datang Admin');
            }
            elseif ($user->role === 'siswa') {
                return redirect()->route('siswa.dashboard')->with('success', 'Selamat Datang Siswa');
            }
            else {
                Auth::logout();
                return redirect()->route('login')->withErrors('Role pengguna tidak dikenal');
            }
        }
        return back()->withErrors(['email' => 'Email atau Password Salah!'])->onlyInput('email');
    }

    public function logout(Request $request) 
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerate();
        return redirect()->route('login')->with('success', 'Anda Berhasil Logout');
    }
}
