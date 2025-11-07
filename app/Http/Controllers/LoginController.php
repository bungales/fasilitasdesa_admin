<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Tampil halaman login
    public function index()
    {
        return view('pages.login');
    }

    // Proses login (store karena resource)
    public function store(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {

            Auth::login($user);

            return redirect()->route('dashboard')->with('success', 'Login Berhasil');
        }

        return back()->with('error', 'Email atau Password salah!');
    }

    // Logout
    public function destroy()
    {
        Auth::logout();
        return redirect()->route('login.index')->with('success', 'Berhasil Logout');
    }
}
