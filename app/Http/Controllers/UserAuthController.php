<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    // ===== USER LOGIN =====
    public function showLogin()
    {
        return view('user.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            $request->session()->regenerate();

            if (Auth::user()->role === 'admin') {
                Auth::logout();
                return back()->with('error', 'Akun admin harus login melalui halaman admin.');
            }

            return redirect()->route('shop.index');
        }

        return back()->with('error', 'Email atau password salah!');
    }

    // ===== ADMIN LOGIN =====
    public function showAdminLogin()
    {
        return view('admin.login');
    }

    public function adminLogin(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            $request->session()->regenerate();

            if (Auth::user()->role !== 'admin') {
                Auth::logout();
                return back()->with('error', 'Anda tidak memiliki akses admin.');
            }

            return redirect()->route('dashboard');
        }

        return back()->with('error', 'Email atau password salah!');
    }

    // ===== REGISTER =====
    public function showRegister()
    {
        return view('user.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'user',
        ]);

        // ✅ Ganti ke user.login
        return redirect()->route('user.login')
            ->with('success', 'Akun berhasil dibuat! Silakan login.');
    }

    // ===== USER LOGOUT =====
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // ✅ Ganti ke user.login
        return redirect()->route('user.login');
    }

    // ===== ADMIN LOGOUT =====
    public function adminLogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}