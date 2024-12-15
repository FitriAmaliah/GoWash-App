<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Menampilkan form registrasi
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Menangani proses registrasi
    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Buat pengguna baru
        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Login pengguna setelah registrasi
        Auth::attempt($request->only('email', 'password'));

        return redirect()->route('login'); // Ganti dengan rute yang sesuai
    }

    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Menangani proses login
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Coba autentikasi pengguna
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Redirect berdasarkan role pengguna
            if (Auth::user()->role === 'admin') {
                return redirect()->route('dashboard.admin');
            } elseif (Auth::user()->role === 'user') {
                return redirect()->route('dashboard.user'); 
            } elseif (Auth::user()->role === 'karyawan') {
                return redirect()->route('dashboard.karyawan'); 
            }
        }

        // Jika login gagal, kirim pesan error kembali ke halaman login
        return back()->withErrors([
            'loginError' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    // Menangani logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
