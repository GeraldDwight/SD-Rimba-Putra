<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| 1. HALAMAN PUBLIK (Landing Page)
|--------------------------------------------------------------------------
*/
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/profil-sekolah', [PageController::class, 'profile'])->name('profile');
Route::get('/berita-galeri', [PageController::class, 'berita'])->name('berita');
Route::get('/artikel/{slug}', [PageController::class, 'detailBerita'])->name('berita.detail'); // Baca Selengkapnya
Route::get('/info-pendaftaran', [PendaftaranController::class, 'tahapan'])->name('pendaftaran.tahapan');

/*
|--------------------------------------------------------------------------
| 2. OTENTIKASI (Login, Register, Logout)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');

    // Route Lupa Password (Placeholder)
    Route::get('/lupa-password', function() {
        return "Hubungi Admin untuk reset password."; 
    })->name('password.request');

    // --- TAMBAHKAN INI (Untuk tombol Google Login) ---
    Route::get('/auth/google', function() {
        return "Fitur Login Google belum diaktifkan (Perlu Laravel Socialite).";
    })->name('auth.google');
    // -------------------------------------------------
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| 3. DASHBOARD SISTEM (Wajib Login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    
    // A. AREA SISWA
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/pendaftaran/formulir', [PendaftaranController::class, 'showForm'])->name('pendaftaran.form');
    Route::post('/pendaftaran/simpan', [PendaftaranController::class, 'store'])->name('pendaftaran.simpan');

    // B. AREA ADMIN (Semua route admin ada di sini)
    Route::prefix('admin')->name('admin.')->group(function () {
        
        // 1. Dashboard & Pendaftar
        Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard');
        Route::get('/pendaftar', [AdminController::class, 'pendaftar'])->name('pendaftar');
        Route::post('/pendaftar/status/{id}', [AdminController::class, 'updateStatus'])->name('pendaftar.status');
        Route::delete('/pendaftar/{id}', [AdminController::class, 'hapusSiswa'])->name('pendaftar.destroy');

        // 2. Konten (Berita & Surat)
        Route::get('/konten', [AdminController::class, 'index'])->name('posts.index');
        Route::post('/posts', [AdminController::class, 'store'])->name('posts.store');
        Route::delete('/posts/{id}', [AdminController::class, 'destroy'])->name('posts.destroy');
        Route::post('/surat', [AdminController::class, 'suratStore'])->name('surat.store');
        Route::delete('/surat/{id}', [AdminController::class, 'suratDestroy'])->name('surat.destroy');

        // 3. Manajemen User
        Route::get('/users', [AdminController::class, 'users'])->name('users.index');
        Route::post('/users', [AdminController::class, 'userStore'])->name('users.store');
        Route::put('/users/{id}', [AdminController::class, 'userUpdate'])->name('users.update');
        Route::delete('/users/{id}', [AdminController::class, 'userDestroy'])->name('users.destroy');

        // 4. Profil Sekolah (Identitas & Guru)
        Route::get('/profil-sekolah', [AdminController::class, 'profileIndex'])->name('profile.index');
        Route::put('/profil-sekolah/update', [AdminController::class, 'profileUpdate'])->name('profile.update');
        Route::post('/profil-sekolah/guru', [AdminController::class, 'guruStore'])->name('guru.store');
        Route::delete('/profil-sekolah/guru/{id}', [AdminController::class, 'guruDestroy'])->name('guru.destroy');

        // 5. Ekstrakurikuler (INI YANG KURANG TADI)
        Route::post('/profil-sekolah/eskul', [AdminController::class, 'eskulStore'])->name('eskul.store');
        Route::delete('/profil-sekolah/eskul/{id}', [AdminController::class, 'eskulDestroy'])->name('eskul.destroy');
    });

});