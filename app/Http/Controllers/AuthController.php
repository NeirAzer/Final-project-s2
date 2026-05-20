<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // 1. Menampilkan Halaman Register
    public function showRegister()
    {
        return view('auth.register');
    }

    // 2. Memproses Registrasi Akun Baru
    public function register(Request $request)
    {
        // Validasi input data dari form
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed', // 'confirmed' otomatis ngecek input 'password_confirmation'
        ]);

        // Simpan data user ke database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Password wajib di-hash demi keamanan
        ]);

        // Setelah berhasil daftar, langsung otomatis login
        Auth::login($user);

        // Arahkan ke halaman dashboard (nanti kita buat route-nya)
        return redirect()->route('dashboard');
    }

    // 3. Menampilkan Halaman Login
    public function showLogin()
    {
        return view('auth.login');
    }

    // 4. Memproses Login User
    public function login(Request $request)
    {
        // Validasi input email dan password
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Coba cocokkan data dengan database (Attempt Login)
        if (Auth::attempt($credentials)) {
            // Jika sukses, buat ulang session baru
            $request->session()->regenerate();

            return redirect()->route('dashboard');
        }

        // Jika gagal login, kembalikan ke halaman login dengan pesan error
        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    // 5. Memproses Logout
    public function logout(Request $request)
    {
        Auth::logout();

        // Hancurkan session agar aman
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}