<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

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
                'password' => ['required']
            ],
            [
                'email.required' => 'Anda belum memasukkan email!',
                'email.email' => 'Masukkan email dengan benar!',

                'password.required' => 'Anda belum memasukkan password!'
            ]
        );

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah!',
        ])->onlyInput('email');
    }

    public function registered(Request $request)
    {

        $request->validate(
            [
                'name' => 'required',
                'email' => ['required', 'email', 'unique:' . User::class],
                'telp' => ['required', 'regex:/^[0-9]+$/', 'between:10,12'],
                'password' => 'required|min:8|confirmed'
            ],
            [
                'name.required' => 'Anda belum memasukkan nama!',

                'email.required' => 'Anda belum memasukkan email!',
                'email.unique' => 'Email telah terdaftar!',
                'email.email' => 'Format email salah!',

                'telp.required' => 'Anda belum memasukkan nomor telepon/wa!',
                'telp.regex' => 'Format telepon hanya boleh angka 0-9!',
                'telp.between' => 'Minimal 10 & maksimal 12 karakter!',

                'password.required' => 'Anda belum memasukkan password!',
                'password.min' => 'Minimal password 8 karakter!',
                'password.confirmed' => 'Konfirmasi password tidak sesuai!'
            ]
        );


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'telp' => $request->telp,
            'password' => Hash::make($request->password)
        ]);

        $user->assignRole('user');

        Auth::login($user);

        return redirect('/');
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
