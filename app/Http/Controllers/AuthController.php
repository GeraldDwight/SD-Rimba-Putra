<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite; // Pastikan package socialite terinstall

class AuthController extends Controller
{
    // --- 1. LOGIN MANUAL ---
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login'    => 'required', // Bisa username atau email
            'password' => 'required',
        ]);

        // Cek input apakah Email atau Username
        $fieldType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // Coba Login
        if (Auth::attempt([$fieldType => $request->login, 'password' => $request->password], $request->remember)) {
            $request->session()->regenerate();

            // Redirect sesuai Role
            if (Auth::user()->role == 'admin') {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('dashboard');
        }

        return back()->withErrors(['login' => 'Akun tidak ditemukan atau password salah.'])->onlyInput('login');
    }

    // --- 2. REGISTRASI AKUN ---
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'username'  => 'required|string|max:255|unique:users',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|min:6|confirmed', // Wajib ada input name="password_confirmation" di view
        ]);

        // Buat User Baru
        $user = User::create([
            'name'     => $request->name,
            'username' => $request->username,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'siswa', // Default role
        ]);

        // Langsung Login setelah daftar
        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Akun berhasil dibuat! Silakan lengkapi formulir pendaftaran.');
    }

    // --- 3. GOOGLE LOGIN ---
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            // Cari user berdasarkan Google ID atau Email
            $user = User::where('google_id', $googleUser->id)->orWhere('email', $googleUser->email)->first();

            if($user){
                // Jika user ada, update google_id (jika sebelumnya login manual) lalu login
                if(!$user->google_id) {
                    $user->update(['google_id' => $googleUser->id]);
                }
                Auth::login($user);
            }else{
                // Jika user belum ada, buat baru
                $newUser = User::create([
                    'name'      => $googleUser->name,
                    'username'  => strtolower(str_replace(' ', '', $googleUser->name)) . rand(100, 999),
                    'email'     => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'password'  => Hash::make('google_default_pass'), // Dummy password
                    'role'      => 'siswa'
                ]);
                Auth::login($newUser);
            }

            // Redirect
            if (Auth::user()->role == 'admin') return redirect()->route('admin.dashboard');
            return redirect()->route('dashboard');

        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(['login' => 'Gagal login dengan Google. Coba lagi.']);
        }
    }

    // --- 4. LOGOUT ---
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}