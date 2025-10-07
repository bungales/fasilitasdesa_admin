<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Menampilkan form login
    public function index()
    {
     return view('auth.login-form');
    }

    // Memproses login
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required',
            'password' => [
                'required',
                'min:3',
                'regex:/[A-Z]/' // harus ada huruf kapital
            ]
        ], [
            'username.required' => 'Username wajib diisi!',
            'password.required' => 'Password wajib diisi!',
            'password.min' => 'Password minimal 3 karakter!',
            'password.regex' => 'Password harus mengandung huruf kapital!'
        ]);

        // Jika username dan password sama → sukses login
        if ($request->username === $request->password) {
            return view('auth.success', [
                'username' => $request->username
            ]);
        } else {
            return back()->withErrors(['login_error' => 'Username dan Password harus sama!'])
                         ->withInput();
        }
    }
}
