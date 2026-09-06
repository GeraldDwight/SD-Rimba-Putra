@extends('layouts.dashboard')
@section('title', 'Manajemen Konten')

@section('content')

@if(session('success'))
<div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-r shadow-sm animate-fade-in-up">
    ✅ {{ session('success') }}
</div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

    <div class="space-y-8">
        <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-gray-100">
            <h3 class="text-lg font-black text-[#1B4D3E] uppercase mb-6 flex items-center gap-2">
                <span>📰</span> Tambah Konten Baru
            </h3>
            
            <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                
                <div>
                    <label class="block text-xs font-bold uppercase text-gray-400 mb-2">Judul Postingan</label>
                    <input type="text" name="judul" placeholder="Contoh: Juara 1 Lomba Futsal..." class="w-full px-4 py-3 bg-gray-50 rounded-xl border border-gray-200 focus:border-[#1B4D3E] outline-none font-bold text-gray-700" required>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-gray-400 mb-2">Kategori</label>
                    <div class="relative">
                        <select name="kategori" class="w-full px-4 py-3 bg-gray-50 rounded-xl border border-gray-200 focus:border-[#1B4D3E] outline-none appearance-none font-bold text-gray-700 cursor-pointer" required>
                            <option value="berita">📰 Berita Sekolah</option>
                            <option value="prestasi">🏆 Prestasi Siswa/Guru</option>
                            <option value="galeri">📸 Galeri Kegiatan</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-gray-500">
                            ▼
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-gray-400 mb-2">Isi Konten</label>
                    <textarea name="konten" placeholder="Tulis deskripsi lengkap di sini..." rows="4" class="w-full px-4 py-3 bg-gray-50 rounded-xl border border-gray-200 focus:border-[#1B4D3E] outline-none text-sm" required></textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-gray-400 mb-2">Upload Gambar Utama</label>
                    <input type="file" name="gambar" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-[#1B4D3E] file:text-white hover:file:bg-[#F4D03F] hover:file:text-[#1B4D3E] transition cursor-pointer" required>
                </div>

                <button type="submit" class="w-full bg-[#1B4D3E] text-white py-3 rounded-xl font-bold uppercase tracking-widest hover:bg-[#F4D03F] hover:text-[#1B4D3E] transition shadow-lg mt-2">
                    Publish Sekarang
                </button>
            </form>
        </div>

        <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-gray-100">
            <h4 class="text-xs font-black text-gray-400 uppercase tracking-widest mb-4">Postingan Terpublish</h4>
            <div class="space-y-4">
                @foreach($posts as $post)
                <div class="flex items-center gap-4 p-3 hover:bg-gray-50 rounded-xl transition group border border-transparent hover:border-gray-200">
                    <img src="{{ Storage::url($post->gambar) }}" class="w-12 h-12 rounded-lg object-cover bg-gray-200">
                    <div class="flex-1 min-w-0">
                        <span class="text-[9px] font-black uppercase px-2 py-0.5 rounded text-[#1B4D3E] bg-[#F4D03F]/20 mb-1 inline-block">
                            {{ $post->kategori }}
                        </span>
                        <p class="font-bold text-sm text-gray-800 line-clamp-1 truncate">{{ $post->judul }}</p>
                        <p class="text-[10px] text-gray-400">{{ $post->created_at->diffForHumans() }}</p>
                    </div>
                    <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus postingan ini?')">
                        @csrf @method('DELETE')
                        <button class="w-8 h-8 rounded-full bg-red-50 text-red-400 hover:bg-red-500 hover:text-white flex items-center justify-center transition" title="Hapus">
                            ✕
                        </button>
                    </form>
                </div>
                @endforeach
            </div>
            <div class="mt-6">
                {{ $posts->links() }}
            </div>
        </div>
    </div>

    <div class="space-y-8">
        <div class="bg-[#1B4D3E] p-8 rounded-[2rem] shadow-lg text-white relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-[#F4D03F] rounded-full blur-[60px] opacity-20"></div>
            <h3 class="text-lg font-black text-[#F4D03F] uppercase mb-6 flex items-center gap-2 relative z-10">
                <span>📂</span> Upload Surat / Dokumen
            </h3>
            
            <form action="{{ route('admin.surat.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4 relative z-10">
                @csrf
                <div>
                    <label class="block text-xs font-bold uppercase text-green-200 mb-2">Nama Dokumen</label>
                    <input type="text" name="judul" placeholder="Contoh: Surat Edaran Libur..." class="w-full px-4 py-3 bg-white/10 text-white placeholder-green-200/50 rounded-xl border border-white/20 focus:border-[#F4D03F] outline-none font-bold" required>
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase text-green-200 mb-2">File (PDF/DOC)</label>
                    <input type="file" name="file_surat" class="block w-full text-sm text-green-200 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-[#F4D03F] file:text-[#1B4D3E] hover:file:bg-white transition cursor-pointer" required>
                </div>
                <button type="submit" class="w-full bg-[#F4D03F] text-[#1B4D3E] py-3 rounded-xl font-bold uppercase tracking-widest hover:bg-white transition shadow-lg mt-2">
                    Upload Dokumen
                </button>
            </form>
        </div>

        <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-gray-100">
            <h4 class="text-xs font-black text-gray-400 uppercase tracking-widest mb-4">Arsip Dokumen</h4>
            <div class="space-y-3">
                @foreach($documents as $doc)
                <div class="flex items-center justify-between p-4 border border-gray-100 rounded-xl hover:border-[#1B4D3E] transition bg-gray-50 group">
                    <div class="flex items-center gap-3 overflow-hidden">
                        <div class="w-10 h-10 bg-red-100 text-red-500 rounded-lg flex-shrink-0 flex items-center justify-center text-xs font-black">PDF</div>
                        <div class="min-w-0">
                            <p class="font-bold text-sm text-gray-800 truncate">{{ $doc->judul }}</p>
                            <a href="{{ Storage::url($doc->file_path) }}" target="_blank" class="text-[10px] text-[#1B4D3E] font-bold hover:underline flex items-center gap-1">
                                Lihat File ↗
                            </a>
                        </div>
                    </div>
                    <form action="{{ route('admin.surat.destroy', $doc->id) }}" method="POST" onsubmit="return confirm('Hapus Dokumen?')">
                        @csrf @method('DELETE')
                        <button class="w-8 h-8 rounded-full text-gray-300 hover:bg-red-500 hover:text-white flex items-center justify-center transition">✕</button>
                    </form>
                </div>
                @endforeach
            </div>
            <div class="mt-6">
                {{ $documents->links() }}
            </div>
        </div>
    </div>

</div>
@endsection