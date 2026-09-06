@extends('layouts.dashboard')

@section('title', 'Manajemen Profil Sekolah')

@section('content')

@if(session('success'))
<div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-8 rounded-r shadow-sm flex justify-between items-center animate-fade-in-up">
    <div class="flex items-center gap-2"><span>✅</span><span class="font-bold">{{ session('success') }}</span></div>
    <button onclick="this.parentElement.style.display='none'">&times;</button>
</div>
@endif

<div class="bg-white rounded-[2rem] p-8 border border-gray-100 shadow-sm mb-12">
    <div class="flex items-center gap-3 border-b pb-4 mb-6">
        <div class="bg-[#F4D03F] w-2 h-8 rounded-full"></div>
        <h3 class="text-xl font-black text-[#1B4D3E] uppercase">1. Identitas Utama</h3>
    </div>

    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-gray-50 p-6 rounded-2xl border border-gray-200">
                <h4 class="font-black text-gray-400 uppercase text-xs mb-4 tracking-widest border-b pb-2">Data Ketua Yayasan</h4>
                <div class="space-y-4">
                    <div>
                        <label class="text-[10px] font-bold uppercase text-gray-500">Nama Lengkap</label>
                        <input type="text" name="yayasan_nama" value="{{ $profile->yayasan_nama }}" class="w-full border p-2 rounded-xl text-sm font-bold focus:border-[#1B4D3E] outline-none">
                    </div>
                    <div>
                        <label class="text-[10px] font-bold uppercase text-gray-500">Foto</label>
                        <input type="file" name="yayasan_foto" class="w-full bg-white border p-2 rounded-xl text-xs">
                    </div>
                    <div>
                        <label class="text-[10px] font-bold uppercase text-gray-500">Sambutan</label>
                        <textarea name="yayasan_sambutan" rows="3" class="w-full border p-2 rounded-xl text-sm focus:border-[#1B4D3E] outline-none">{{ $profile->yayasan_sambutan }}</textarea>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 p-6 rounded-2xl border border-gray-200">
                <h4 class="font-black text-gray-400 uppercase text-xs mb-4 tracking-widest border-b pb-2">Data Kepala Sekolah</h4>
                <div class="space-y-4">
                    <div>
                        <label class="text-[10px] font-bold uppercase text-gray-500">Nama Lengkap</label>
                        <input type="text" name="kepsek_nama" value="{{ $profile->kepsek_nama }}" class="w-full border p-2 rounded-xl text-sm font-bold focus:border-[#1B4D3E] outline-none">
                    </div>
                    <div class="flex gap-2">
                        <div class="w-1/2">
                            <label class="text-[10px] font-bold uppercase text-gray-500">NIP</label>
                            <input type="text" name="kepsek_nip" value="{{ $profile->kepsek_nip }}" class="w-full border p-2 rounded-xl text-sm font-bold focus:border-[#1B4D3E] outline-none">
                        </div>
                        <div class="w-1/2">
                            <label class="text-[10px] font-bold uppercase text-gray-500">Foto</label>
                            <input type="file" name="kepsek_foto" class="w-full bg-white border p-2 rounded-xl text-xs">
                        </div>
                    </div>
                    <div>
                        <label class="text-[10px] font-bold uppercase text-gray-500">Sambutan</label>
                        <textarea name="kepsek_sambutan" rows="3" class="w-full border p-2 rounded-xl text-sm focus:border-[#1B4D3E] outline-none">{{ $profile->kepsek_sambutan }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-gray-50 p-6 rounded-2xl border border-gray-200">
            <h4 class="font-black text-gray-400 uppercase text-xs mb-4 tracking-widest border-b pb-2">Visi & Misi</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="text-[10px] font-bold uppercase text-gray-500">Visi</label>
                    <textarea name="visi" rows="5" class="w-full border p-3 rounded-xl text-sm font-bold focus:border-[#1B4D3E] outline-none">{{ $profile->visi }}</textarea>
                </div>
                <div>
                    <label class="text-[10px] font-bold uppercase text-gray-500">Misi (Gunakan Enter untuk baris baru)</label>
                    <textarea name="misi" rows="5" class="w-full border p-3 rounded-xl text-sm font-bold focus:border-[#1B4D3E] outline-none" placeholder="- Misi 1&#10;- Misi 2">{{ $profile->misi }}</textarea>
                </div>
            </div>
        </div>

        <div class="text-right">
            <button type="submit" class="bg-[#1B4D3E] text-white px-8 py-3 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-[#F4D03F] hover:text-[#1B4D3E] transition-all shadow-lg">
                Simpan Perubahan Identitas
            </button>
        </div>
    </form>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    
    <div class="lg:col-span-1">
        <div class="bg-white rounded-[2rem] p-6 border border-gray-100 shadow-sm sticky top-6">
            <div class="flex items-center gap-3 border-b pb-4 mb-4">
                <div class="bg-[#1B4D3E] w-2 h-8 rounded-full"></div>
                <h3 class="text-lg font-black text-[#1B4D3E] uppercase">2. Tambah Guru</h3>
            </div>
            
            <form action="{{ route('admin.guru.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label class="text-[10px] font-bold uppercase text-gray-400">Nama Lengkap</label>
                    <input type="text" name="nama" required class="w-full px-4 py-2 bg-gray-50 border rounded-xl focus:border-[#1B4D3E] outline-none text-sm font-bold">
                </div>
                <div>
                    <label class="text-[10px] font-bold uppercase text-gray-400">NIP (Opsional)</label>
                    <input type="text" name="nip" class="w-full px-4 py-2 bg-gray-50 border rounded-xl focus:border-[#1B4D3E] outline-none text-sm font-bold">
                </div>
                <div>
                    <label class="text-[10px] font-bold uppercase text-gray-400">Jabatan</label>
                    <input type="text" name="jabatan" required placeholder="Contoh: Guru Kelas 1" class="w-full px-4 py-2 bg-gray-50 border rounded-xl focus:border-[#1B4D3E] outline-none text-sm font-bold">
                </div>
                <div>
                    <label class="text-[10px] font-bold uppercase text-gray-400">Foto</label>
                    <div class="relative border-2 border-dashed border-gray-200 rounded-xl p-4 text-center hover:bg-gray-50 transition cursor-pointer group">
                        <input type="file" name="foto" required class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                        <div class="text-gray-400 group-hover:text-[#1B4D3E]">
                            <span class="text-xs font-bold">Klik Upload Foto</span>
                        </div>
                    </div>
                </div>
                <button type="submit" class="w-full bg-[#1B4D3E] text-white py-3 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-[#F4D03F] hover:text-[#1B4D3E] transition-all shadow-lg mt-2">
                    + Tambah Guru
                </button>
            </form>
        </div>
    </div>

    <div class="lg:col-span-2">
        <div class="bg-white rounded-[2rem] p-8 border border-gray-100 shadow-sm min-h-[500px]">
            <h3 class="text-lg font-black text-[#1B4D3E] uppercase mb-6">Daftar Pengajar ({{ $gurus->count() }})</h3>
            
            @if($gurus->count() > 0)
                <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                    @foreach($gurus as $guru)
                    <div class="bg-gray-50 rounded-2xl p-4 border border-gray-200 relative group hover:bg-white hover:shadow-xl hover:border-[#F4D03F] transition-all duration-300">
                        <form action="{{ route('admin.guru.destroy', $guru->id) }}" method="POST" onsubmit="return confirm('Hapus {{ $guru->nama }}?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="absolute -top-2 -right-2 bg-red-500 text-white w-8 h-8 rounded-full shadow-lg flex items-center justify-center hover:scale-110 transition-transform z-10">&times;</button>
                        </form>
                        <div class="w-16 h-16 mx-auto rounded-full overflow-hidden border-2 border-white shadow-md mb-3">
                            <img src="{{ Storage::url($guru->foto) }}" class="w-full h-full object-cover">
                        </div>
                        <div class="text-center">
                            <h4 class="font-black text-gray-800 text-xs leading-tight mb-1">{{ $guru->nama }}</h4>
                            <span class="bg-[#1B4D3E] text-white text-[9px] font-bold uppercase px-2 py-0.5 rounded">{{ $guru->jabatan }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-20 text-gray-400 font-bold text-sm">Belum ada data guru.</div>
            @endif
        </div>
    </div>
</div>

<div class="mt-16 pt-10 border-t-4 border-dashed border-gray-100">
    
    <div class="flex items-center gap-3 mb-8">
        <div class="bg-[#F4D03F] w-2 h-8 rounded-full"></div>
        <h3 class="text-xl font-black text-[#1B4D3E] uppercase">3. Ekstrakurikuler</h3>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-1">
            <div class="bg-white rounded-[2rem] p-6 border border-gray-100 shadow-sm sticky top-6">
                <h4 class="font-black text-gray-400 uppercase text-xs mb-4 tracking-widest border-b pb-2">Tambah Kegiatan</h4>
                
                <form action="{{ route('admin.eskul.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    
                    <div>
                        <label class="text-[10px] font-bold uppercase text-gray-400">Nama Eskul</label>
                        <input type="text" name="nama" required placeholder="Contoh: Pramuka" class="w-full px-4 py-2 bg-gray-50 border rounded-xl text-sm font-bold focus:border-[#1B4D3E] outline-none text-[#1B4D3E]">
                    </div>

                    <div>
                        <label class="text-[10px] font-bold uppercase text-gray-400">Deskripsi Singkat</label>
                        <textarea name="deskripsi" rows="4" required placeholder="Jelaskan kegiatan ini..." class="w-full px-4 py-2 bg-gray-50 border rounded-xl text-sm font-bold focus:border-[#1B4D3E] outline-none text-gray-600"></textarea>
                    </div>

                    <div>
                        <label class="text-[10px] font-bold uppercase text-gray-400">Foto Kegiatan</label>
                        <div class="relative border-2 border-dashed border-gray-200 rounded-xl p-4 text-center hover:bg-gray-50 transition cursor-pointer group">
                            <input type="file" name="foto" required class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                            <div class="text-gray-400 group-hover:text-[#1B4D3E]">
                                <span class="text-xs font-bold">Klik Upload Foto</span>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-[#1B4D3E] text-white py-3 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-[#F4D03F] hover:text-[#1B4D3E] transition-all shadow-lg mt-2">
                        + Simpan Eskul
                    </button>
                </form>
            </div>
        </div>

        <div class="lg:col-span-2">
            @php $eskuls = \App\Models\Eskul::latest()->get(); @endphp

            @if($eskuls->count() > 0)
                <div class="grid grid-cols-2 md:grid-cols-3 gap-5">
                    @foreach($eskuls as $eskul)
                    <div class="group relative rounded-2xl overflow-hidden h-48 border border-gray-200 shadow-sm hover:shadow-xl transition-all">
                        <img src="{{ Storage::url($eskul->foto) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        
                        <div class="absolute inset-0 bg-gradient-to-t from-[#1B4D3E] via-black/20 to-transparent flex flex-col justify-end p-4">
                            <h5 class="text-[#F4D03F] font-black text-sm uppercase mb-1 leading-tight">{{ $eskul->nama }}</h5>
                            <p class="text-gray-200 text-[10px] line-clamp-2 leading-relaxed opacity-80">
                                {{ $eskul->deskripsi }}
                            </p>
                        </div>

                        <form action="{{ route('admin.eskul.destroy', $eskul->id) }}" method="POST" onsubmit="return confirm('⚠️ Yakin ingin menghapus eskul {{ $eskul->nama }}?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="absolute top-2 right-2 bg-white/90 text-red-500 w-8 h-8 rounded-full shadow-lg flex items-center justify-center hover:bg-red-500 hover:text-white transition-colors transform scale-0 group-hover:scale-100 duration-200">
                                &times;
                            </button>
                        </form>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="bg-gray-50 rounded-[2rem] border-2 border-dashed border-gray-200 h-64 flex flex-col items-center justify-center text-center p-8">
                    <div class="text-4xl mb-2 grayscale opacity-30">⚽</div>
                    <p class="text-gray-400 font-bold text-sm">Belum ada data ekstrakurikuler.</p>
                    <p class="text-xs text-gray-300">Gunakan formulir di samping untuk menambah.</p>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection