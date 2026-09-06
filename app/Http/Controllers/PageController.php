<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;          // Model Berita
use App\Models\Document;      // Model Dokumen/Pengumuman
use App\Models\SchoolProfile; // Model Profil Sekolah (Yayasan/Kepsek)
use App\Models\Guru;          // Model Guru

class PageController extends Controller
{
    // =========================================================
    // 1. HALAMAN HOME (BERANDA)
    // =========================================================
    // Halaman Home (Landing Page)
    public function home() {
        // 1. Ambil Berita Terbaru
        $berita = Post::latest()->take(4)->get();
        
        // 2. Ambil Pengumuman Terbaru
        $pengumuman = Document::latest()->take(5)->get();

        // 3. AMBIL DATA ESKUL (TAMBAHKAN INI)
        $eskuls = \App\Models\Eskul::all(); 

        // Kirim semua ke view home
        return view('home', compact('berita', 'pengumuman', 'eskuls'));
    }

    // =========================================================
    // 2. HALAMAN PROFIL SEKOLAH
    // =========================================================
    public function profile() {
        // A. Ambil data identitas sekolah (Ketua Yayasan, Kepsek, Visi Misi)
        $profile = SchoolProfile::first();

        // B. Pecah Misi menjadi array agar bisa dilooping (poin per poin)
        // Jika data profile ada, pecah berdasarkan baris baru (\n). Jika tidak, array kosong.
        $misiList = $profile ? explode("\n", $profile->misi) : [];

        // C. Ambil semua data Guru untuk ditampilkan di bawah Kepsek
        $gurus = Guru::all();

        // Kirim semua variabel ke view 'profile.blade.php'
        return view('profile', compact('profile', 'misiList', 'gurus'));
    }

    // =========================================================
    // 3. HALAMAN ARSIP BERITA & GALERI
    // =========================================================
    public function berita() {
        // Ambil semua berita, urutkan dari yang terbaru
        // Gunakan paginate(9) agar muncul 9 berita per halaman
        $semuaBerita = Post::latest()->paginate(9);
        
        return view('berita', compact('semuaBerita'));
    }

    // =========================================================
    // 4. HALAMAN DETAIL BERITA (BACA SELENGKAPNYA)
    // =========================================================
    public function detailBerita($slug) {
        // A. Cari postingan berdasarkan 'slug' (judul yang di-url-kan)
        // Jika tidak ketemu, otomatis tampilkan halaman 404 (firstOrFail)
        $post = Post::where('slug', $slug)->firstOrFail();

        // B. Cari berita terkait (Rekomendasi di Sidebar)
        // Syarat: Kategori sama, TAPI bukan berita yang sedang dibaca (id != $post->id)
        $terkait = Post::where('kategori', $post->kategori)
                       ->where('id', '!=', $post->id)
                       ->latest()
                       ->take(3) // Ambil 3 saja
                       ->get();

        return view('berita_detail', compact('post', 'terkait'));
    }
}