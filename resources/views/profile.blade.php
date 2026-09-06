@extends('layouts.app')

@section('content')

<div class="relative bg-[#1B4D3E] pt-32 pb-32 px-6 md:px-16 overflow-hidden">
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-[#4ADE80] rounded-full blur-[150px] opacity-10 pointer-events-none"></div>
    
    <div class="container mx-auto relative z-10 text-center">
        <span class="inline-block py-1 px-3 rounded-full bg-[#F4D03F]/20 border border-[#F4D03F]/50 text-[#F4D03F] font-bold tracking-[0.2em] uppercase text-[10px] mb-4">
            Tentang Kami
        </span>
        <h1 class="text-4xl md:text-6xl font-black text-white uppercase tracking-tighter mb-4">
            Profil Sekolah
        </h1>
        <p class="text-gray-300 max-w-2xl mx-auto">Mengenal lebih dekat sejarah, visi, dan misi SD Rimba Putra.</p>
    </div>
</div>

<div class="container mx-auto px-6 md:px-16 -mt-20 pb-24 relative z-20">
    <div class="bg-white rounded-[3rem] shadow-2xl p-8 md:p-16 mb-16 border border-gray-100">
        
        <h2 class="text-4xl font-black text-center text-[#1B4D3E] uppercase tracking-tighter mb-16 border-b-2 border-[#F4D03F]/30 pb-8 inline-block w-full">
            SD Rimba Putra
        </h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 items-center border-b border-dashed border-gray-200 pb-16 mb-16">
            <div class="md:col-span-2 text-center md:text-right order-2 md:order-1">
                <p class="text-[#F4D03F] text-xs uppercase font-black tracking-[0.2em] mb-3">
                    Ketua Yayasan Bina Wana Kencana
                </p>
                <h3 class="text-3xl font-black text-[#1B4D3E] leading-tight mb-6 uppercase">
                    Membangun Karakter, <br>Mencerdaskan Bangsa
                </h3>
                
                <p class="text-lg text-gray-600 italic leading-relaxed bg-[#1B4D3E]/5 p-6 rounded-3xl border-r-4 border-[#1B4D3E]">
                    "{{ $profile->yayasan_sambutan ?? 'Sambutan belum diisi oleh Admin.' }}"
                </p>
                
                <p class="text-xl font-black text-[#1B4D3E] mt-8 uppercase">
                    {{ $profile->yayasan_nama ?? 'Nama Ketua Yayasan' }}
                </p>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest italic">Menjabat Sejak 5 Januari 2026</p>
            </div>

            <div class="md:col-span-1 flex justify-center order-1 md:order-2">
                @if($profile && $profile->yayasan_foto)
                    <img src="{{ Storage::url($profile->yayasan_foto) }}" alt="Foto Ketua Yayasan" class="rounded-[2.5rem] shadow-2xl border-4 border-[#F4D03F] w-64 h-80 object-cover transform -rotate-2 hover:rotate-0 transition-all duration-500">
                @else
                    <div class="w-64 h-80 bg-gray-200 rounded-[2.5rem] flex items-center justify-center text-gray-400 font-bold border-4 border-[#F4D03F] text-center p-4">
                        Foto Belum Diupload
                    </div>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 items-center border-b border-gray-100 pb-16 mb-16">
            <div class="md:col-span-1 flex justify-center">
                @if($profile && $profile->kepsek_foto)
                    <img src="{{ Storage::url($profile->kepsek_foto) }}" alt="Foto Kepala Sekolah" class="rounded-[2.5rem] shadow-2xl border-4 border-[#1B4D3E] w-64 h-80 object-cover transform rotate-2 hover:rotate-0 transition-all duration-500">
                @else
                    <div class="w-64 h-80 bg-gray-200 rounded-[2.5rem] flex items-center justify-center text-gray-400 font-bold border-4 border-[#1B4D3E] text-center p-4">
                        Foto Belum Diupload
                    </div>
                @endif
            </div>
            
            <div class="md:col-span-2 text-center md:text-left">
                <p class="text-[#F4D03F] text-xs uppercase font-black tracking-[0.2em] mb-3">Kepala Sekolah</p>
                <h3 class="text-3xl font-black text-[#1B4D3E] leading-tight mb-6 uppercase">
                    Selamat Datang di <br>SD Rimba Putra
                </h3>
                
                <p class="text-lg text-gray-600 italic leading-relaxed bg-[#F4D03F]/10 p-6 rounded-3xl border-l-4 border-[#F4D03F]">
                    "{{ $profile->kepsek_sambutan ?? 'Sambutan belum diisi oleh Admin.' }}"
                </p>
                
                <p class="text-xl font-black text-[#1B4D3E] mt-8">
                    {{ $profile->kepsek_nama ?? 'Nama Kepala Sekolah' }}
                </p>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">
                    {{ $profile->kepsek_nip ?? '-' }}
                </p>
            </div>
        </div>

        <div class="mb-20">
            <div class="text-center mb-10">
                <h3 class="text-2xl font-black text-[#1B4D3E] uppercase tracking-widest mb-2 border-b-2 border-[#F4D03F] inline-block pb-2">
                    Tim Pengajar & Staf
                </h3>
                <p class="text-gray-400 text-xs font-bold uppercase tracking-widest">
                    Pendidik Profesional SD Rimba Putra
                </p>
            </div>

            @if(isset($gurus) && $gurus->count() > 0)
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    @foreach($gurus as $guru)
                    <div class="bg-white rounded-[2rem] overflow-hidden shadow-lg border border-gray-100 hover:-translate-y-2 transition-transform duration-300 group">
                        <div class="h-48 bg-gray-100 relative overflow-hidden">
                            @if($guru->foto)
                                <img src="{{ Storage::url($guru->foto) }}" alt="{{ $guru->nama }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-300 text-4xl">👤</div>
                            @endif
                            
                            <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-[#1B4D3E] to-transparent p-3 pt-8">
                                <span class="bg-[#F4D03F] text-[#1B4D3E] text-[10px] font-black uppercase px-2 py-1 rounded tracking-wider shadow-sm">
                                    {{ $guru->jabatan }}
                                </span>
                            </div>
                        </div>
                        <div class="p-4 text-center">
                            <h4 class="font-black text-gray-800 text-sm leading-tight mb-1 line-clamp-2">
                                {{ $guru->nama }}
                            </h4>
                            @if($guru->nip)
                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">
                                {{ $guru->nip }}
                            </p>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8 bg-gray-50 rounded-[2rem] border-dashed border-2 border-gray-200">
                    <p class="text-gray-400 font-bold text-sm">Data guru belum ditambahkan.</p>
                </div>
            @endif
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-16 mb-20">
            
            <div class="bg-[#1B4D3E] p-10 rounded-[3rem] text-white relative overflow-hidden group shadow-xl">
                <div class="absolute top-0 right-0 w-32 h-32 bg-[#4ADE80] opacity-10 rounded-full -mr-16 -mt-16"></div>
                <h3 class="text-2xl font-black mb-6 flex items-center gap-3 text-[#F4D03F]">
                    <span class="w-2 h-8 bg-[#F4D03F] rounded-full"></span> VISI
                </h3>
                <p class="text-xl font-medium leading-relaxed italic text-gray-200">
                    "{{ $profile->visi ?? 'Visi belum diisi.' }}"
                </p>
            </div>
            
            <div class="bg-white p-10 rounded-[3rem] border-2 border-gray-100 shadow-lg">
                <h3 class="text-2xl font-black text-[#1B4D3E] mb-6 flex items-center gap-3">
                    <span class="w-2 h-8 bg-[#1B4D3E] rounded-full"></span> MISI
                </h3>
                <ul class="text-gray-600 font-bold text-sm space-y-4">
                    
                    @forelse($misiList as $misi)
                        @if(!empty(trim($misi)))
                        <li class="flex items-start gap-3 italic font-medium">
                            <span class="text-[#1B4D3E] bg-[#F4D03F] w-6 h-6 rounded-full flex items-center justify-center text-[10px] flex-shrink-0">✔</span> 
                            <span>{{ $misi }}</span>
                        </li>
                        @endif
                    @empty
                        <li class="text-gray-400">Data Misi belum diisi.</li>
                    @endforelse

                </ul>
            </div>
        </div>

        <div class="pt-10 border-t border-gray-100">
            <h3 class="text-2xl font-black text-center text-[#1B4D3E] uppercase tracking-widest mb-4">Lokasi Kami</h3>
            <p class="text-center text-gray-400 text-xs font-bold uppercase tracking-widest mb-10 max-w-2xl mx-auto">
                📍 Jl. Rimba Mulya 1 No.12-23, RT.01/RW.01, Pasirmulya, Bogor Barat, Kota Bogor
            </p>
            <div class="w-full h-[500px] rounded-[3rem] shadow-2xl overflow-hidden border-8 border-gray-50">
                                    <iframe 
                    width="100%" 
                    height="100%" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade"
                    src="https://maps.google.com/maps?q=SD+Rimba+Putra+Bogor&t=&z=15&ie=UTF8&iwloc=&output=embed">
                </iframe>
            </div>
        </div>
    </div>
</div>
@endsection