<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CalonSiswa;

class DashboardController extends Controller
{
    // Dashboard SISWA
    public function index()
    {
        if (Auth::user()->role == 'admin') {
            return redirect()->route('admin.dashboard');
        }

        // Cari data pendaftaran milik user yang sedang login
        $pendaftaran = CalonSiswa::where('user_id', Auth::id())->first();

        // Kirim data $pendaftaran ke view. 
        // Jika belum daftar, $pendaftaran isinya null.
        // Jika sudah, isinya data lengkap + status terkini dari Admin.
        return view('dashboard.index', compact('pendaftaran'));
    }

    // Dashboard ADMIN
    public function admin()
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('dashboard');
        }

        // Hitung Statistik Langsung dari Database
        $totalPendaftar = CalonSiswa::count();
        $menungguVerifikasi = CalonSiswa::where('status', 'menunggu_verifikasi')->count();
        $diterima = CalonSiswa::where('status', 'diterima')->count();
        
        // Ambil 5 pendaftar terbaru untuk tabel preview di dashboard
        $pendaftarTerbaru = CalonSiswa::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalPendaftar', 
            'menungguVerifikasi', 
            'diterima', 
            'pendaftarTerbaru'
        ));
    }
}