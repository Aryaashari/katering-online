<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{



    public function loginView()
    {

        return view('auth.login');
    }

    public function registerView()
    {
        return view('auth.register');
    }

    public function authenticate(Request $request)
    {

        $credentials = $request->validate(
            [
                'email' => ['required', 'email'],
            ],
            [
                'email.required' => 'Anda belum memasukkan email!',
                'email.email' => 'Masukkan email dengan benar!',
            ]
        );

        if ($request->password == null || !Auth::attempt($credentials)) {
            return back()->withErrors([
                'email' => 'Email atau password salah!',
            ])->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect()->intended('/');
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
