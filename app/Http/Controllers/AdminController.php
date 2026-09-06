<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CalonSiswa;
use App\Models\Post;
use App\Models\Document;
use App\Models\User;
use App\Models\SchoolProfile; // Model Profil Sekolah
use App\Models\Guru;          // Model Guru
use App\Models\Eskul;         // Model Eskul
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // ==========================================
    // 1. MANAJEMEN PENDAFTAR (CALON SISWA)
    // ==========================================

    // A. LIHAT DATA PENDAFTAR
    public function pendaftar()
    {
        $pendaftar = CalonSiswa::latest()->paginate(10);
        return view('admin.pendaftar', compact('pendaftar'));
    }

    // B. UPDATE STATUS (Terima/Tolak/Pending)
    public function updateStatus(Request $request, $id)
    {
        $siswa = CalonSiswa::findOrFail($id);
        $siswa->update(['status' => $request->status]);
        
        return back()->with('success', 'Status siswa berhasil diperbarui!');
    }

    // C. HAPUS DATA PENDAFTAR
    public function hapusSiswa($id)
    {
        $siswa = CalonSiswa::findOrFail($id);

        // Hapus File KK di Storage agar tidak menumpuk
        if($siswa->file_kk) {
            Storage::disk('public')->delete($siswa->file_kk);
        }

        $siswa->delete();

        return back()->with('success', 'Data pendaftar berhasil dihapus permanen.');
    }


    // ==========================================
    // 2. MANAJEMEN KONTEN (BERITA & SURAT)
    // ==========================================

    public function index()
    {
        $posts = Post::latest()->paginate(5, ['*'], 'posts_page');
        $documents = Document::latest()->paginate(5, ['*'], 'docs_page');
        return view('admin.konten', compact('posts', 'documents'));
    }

    // SIMPAN BERITA
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'konten' => 'required',
            'gambar' => 'required|image|max:2048'
        ]);

        $path = $request->file('gambar')->store('berita_images', 'public');

        Post::create([
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul),
            'konten' => $request->konten,
            'gambar' => $path,
            'kategori' => $request->kategori ?? 'berita', 
            'user_id' => Auth::id(), // PERBAIKAN: Mengganti 'penulis' menjadi 'user_id'
        ]);

        return back()->with('success', 'Berita berhasil dipublish!');
    }

    // HAPUS BERITA
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        if($post->gambar) Storage::disk('public')->delete($post->gambar);
        $post->delete();
        return back()->with('success', 'Berita dihapus.');
    }

    // SIMPAN SURAT/DOKUMEN
    public function suratStore(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'file_surat' => 'required|mimes:pdf,doc,docx|max:5048'
        ]);

        $path = $request->file('file_surat')->store('documents', 'public');

        Document::create([
            'judul' => $request->judul,
            'file_path' => $path,
            'tipe' => 'pengumuman',
            'user_id' => Auth::id(), // PERBAIKAN: Tambah user_id
        ]);

        return back()->with('success', 'Dokumen berhasil diunggah!');
    }

    // HAPUS SURAT
    public function suratDestroy($id)
    {
        $doc = Document::findOrFail($id);
        Storage::disk('public')->delete($doc->file_path);
        $doc->delete();
        return back()->with('success', 'Dokumen dihapus.');
    }


    // ==========================================
    // 3. MANAJEMEN USER (ADMIN & SISWA)
    // ==========================================
    
    // TAMPILKAN LIST USER
    public function users()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users', compact('users'));
    }

    // TAMBAH USER BARU
    public function userStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        return back()->with('success', 'User baru berhasil ditambahkan!');
    }

    // EDIT USER (UPDATE)
    public function userUpdate(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'role' => 'required'
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        if($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return back()->with('success', 'Data user berhasil diperbarui!');
    }

    // HAPUS USER
    public function userDestroy($id)
    {
        $user = User::findOrFail($id);
        
        // Mencegah hapus akun sendiri
        if($user->id == Auth::id()) {
            return back()->withErrors(['error' => 'Anda tidak bisa menghapus akun sendiri!']);
        }

        $user->delete();
        return back()->with('success', 'User berhasil dihapus.');
    }


    // ==========================================
    // 4. MANAJEMEN PROFIL SEKOLAH & GURU (GABUNGAN)
    // ==========================================

    // TAMPILKAN HALAMAN UTAMA PROFIL
    public function profileIndex()
    {
        // Ambil Data Profil (Yayasan, Kepsek, Visi Misi)
        $profile = SchoolProfile::first();
        // Jika tabel kosong, buat instance baru agar tidak error di view
        if(!$profile) $profile = new SchoolProfile();

        // Ambil Data Guru untuk list di bawah
        $gurus = Guru::latest()->get();

        return view('admin.profile_sekolah', compact('profile', 'gurus'));
    }

    // UPDATE IDENTITAS (YAYASAN, KEPSEK, VISI MISI)
    public function profileUpdate(Request $request)
    {
        $profile = SchoolProfile::first();
        if(!$profile) {
            $profile = new SchoolProfile();
        }

        $data = $request->validate([
            'yayasan_nama' => 'nullable',
            'yayasan_sambutan' => 'nullable',
            'kepsek_nama' => 'nullable',
            'kepsek_nip' => 'nullable',
            'kepsek_sambutan' => 'nullable',
            'visi' => 'nullable',
            'misi' => 'nullable',
        ]);

        // Upload Foto Yayasan (Hapus foto lama jika ada)
        if($request->hasFile('yayasan_foto')) {
            if($profile->yayasan_foto) Storage::disk('public')->delete($profile->yayasan_foto);
            $data['yayasan_foto'] = $request->file('yayasan_foto')->store('profil', 'public');
        }

        // Upload Foto Kepsek (Hapus foto lama jika ada)
        if($request->hasFile('kepsek_foto')) {
            if($profile->kepsek_foto) Storage::disk('public')->delete($profile->kepsek_foto);
            $data['kepsek_foto'] = $request->file('kepsek_foto')->store('profil', 'public');
        }

        // PERBAIKAN: Catat siapa admin yang terakhir update profil ini
        $profile->user_id = Auth::id(); 
        
        $profile->fill($data);
        $profile->save();

        return back()->with('success', 'Identitas Sekolah berhasil diperbarui!');
    }

    // TAMBAH GURU
    public function guruStore(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'jabatan' => 'required',
            'foto' => 'required|image|max:2048'
        ]);

        $path = $request->file('foto')->store('foto_guru', 'public');

        Guru::create([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'jabatan' => $request->jabatan,
            'foto' => $path,
            'user_id' => Auth::id(), // PERBAIKAN: Tambah user_id
        ]);

        return back()->with('success', 'Guru berhasil ditambahkan!');
    }

    // HAPUS GURU
    public function guruDestroy($id)
    {
        $guru = Guru::findOrFail($id);
        
        // Hapus foto guru dari storage
        if($guru->foto) Storage::disk('public')->delete($guru->foto);
        
        $guru->delete();
        
        return back()->with('success', 'Guru berhasil dihapus.');
    } 

    // ==========================================
    // 5. MANAJEMEN EKSTRAKURIKULER (BARU)
    // ==========================================

    // SIMPAN ESKUL BARU
    public function eskulStore(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto' => 'required|image|max:2048' // Max 2MB
        ]);

        // Upload Foto
        $path = $request->file('foto')->store('eskul_images', 'public');

        // Simpan ke Database
        Eskul::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'foto' => $path,
            'user_id' => Auth::id(), // PERBAIKAN: Tambah user_id
        ]);

        return back()->with('success', 'Ekstrakurikuler berhasil ditambahkan!');
    }

    // HAPUS ESKUL
    public function eskulDestroy($id)
    {
        $eskul = Eskul::findOrFail($id);
        
        // Hapus file foto dari folder public agar server tidak penuh
        if($eskul->foto) {
            Storage::disk('public')->delete($eskul->foto);
        }

        $eskul->delete();
        
        return back()->with('success', 'Ekstrakurikuler berhasil dihapus.');
    }
}