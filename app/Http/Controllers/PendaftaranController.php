<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CalonSiswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PendaftaranController extends Controller
{
    // 1. Tampilkan Halaman Info Tahapan (Statis seperti semula)
    public function tahapan() {
        return view('pendaftaran.tahapan');
    }

    // 2. Tampilkan Formulir Pendaftaran
    public function showForm() {
        // Cek apakah user sudah pernah daftar?
        $cek = CalonSiswa::where('user_id', Auth::id())->first();
        if($cek) {
            // Jika sudah, langsung lempar ke dashboard
            return redirect()->route('dashboard');
        }
        return view('pendaftaran.form');
    }

    // 3. PROSES SIMPAN DATA KE DATABASE
    public function store(Request $request) {
        // A. Validasi Input
        $request->validate([
            'nama_lengkap' => 'required',
            'nik'          => 'required|numeric|digits:16',
            'tempat_lahir' => 'required',
            'tanggal_lahir'=> 'required|date',
            'jenis_kelamin'=> 'required',
            'nama_ayah'    => 'required',
            'nama_ibu'     => 'required',
            'nomor_hp'     => 'required',
            'alamat_lengkap'=> 'required',
            'dokumen_kk'   => 'required|mimes:pdf,jpg,jpeg,png|max:2048', // Max 2MB
            'dokumen_akta' => 'required|mimes:pdf,jpg,jpeg,png|max:2048',   
            'dokumen_ijazah' => 'nullable|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        // B. Proses Upload File
        $fileKKPath = $request->file('dokumen_kk')->store('dokumen_siswa', 'public');
        $fileAktaPath = $request->file('dokumen_akta')->store('dokumen_siswa', 'public'); 
        
        $fileIjazahPath = null;
        if($request->hasFile('dokumen_ijazah')){
            $fileIjazahPath = $request->file('dokumen_ijazah')->store('dokumen_siswa', 'public'); 
        }

        // C. Simpan ke Tabel calon_siswas
        CalonSiswa::create([
            'user_id'       => Auth::id(), 
            'nama_lengkap'  => $request->nama_lengkap,
            'nik'           => $request->nik,
            'tempat_lahir'  => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'asal_sekolah'  => $request->asal_sekolah ?? '-',
            'alamat'        => $request->alamat_lengkap,
            'nama_ayah'     => $request->nama_ayah,
            'nama_ibu'      => $request->nama_ibu,
            'nomor_hp'      => $request->nomor_hp,
            
            // PERBAIKAN: Typo huruf besar P sudah disamakan
            'file_kk'       => $fileKKPath,
            'file_akta'     => $fileAktaPath,     
            'file_ijazah'   => $fileIjazahPath,   
            
            'status'        => 'menunggu_verifikasi' 
        ]);

        // D. Redirect dengan Pesan Sukses
        return redirect()->route('dashboard')->with('success', 'Formulir berhasil dikirim! Silakan tunggu verifikasi admin.');
    }
}