@extends('layouts.app')

@section('content')

<div class="relative h-[60vh] min-h-[400px] bg-gray-900 overflow-hidden">
    <div class="absolute inset-0">
        <img src="{{ Storage::url($post->gambar) }}" class="w-full h-full object-cover opacity-60">
        <div class="absolute inset-0 bg-gradient-to-t from-[#1B4D3E] via-[#1B4D3E]/40 to-transparent"></div>
    </div>
    
    <div class="absolute bottom-0 left-0 w-full p-8 md:p-16 z-10">
        <div class="container mx-auto">
            <a href="{{ route('berita') }}" class="inline-block mb-6 text-white/80 hover:text-[#F4D03F] font-bold text-xs uppercase tracking-widest transition-colors">
                ← Kembali ke Galeri
            </a>
            <div class="flex flex-wrap items-center gap-4 mb-4">
                <span class="bg-[#F4D03F] text-[#1B4D3E] px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest shadow-lg">
                    {{ $post->kategori }}
                </span>
                <span class="text-white/80 text-[10px] font-bold uppercase tracking-widest border-l pl-4 border-white/30">
                    {{ $post->created_at->format('d F Y') }}
                </span>
                <span class="text-white/80 text-[10px] font-bold uppercase tracking-widest border-l pl-4 border-white/30">
                    Oleh {{ $post->penulis }}
                </span>
            </div>
            <h1 class="text-3xl md:text-5xl font-black text-white leading-tight max-w-4xl drop-shadow-lg">
                {{ $post->judul }}
            </h1>
        </div>
    </div>
</div>

<div class="bg-gray-50 py-16 md:py-24">
    <div class="container mx-auto px-6 md:px-16">
        <div class="flex flex-col lg:flex-row gap-12">
            
            <div class="lg:w-2/3">
                <div class="bg-white rounded-[2.5rem] p-8 md:p-12 shadow-xl border border-gray-100 text-gray-700 leading-loose text-lg font-medium">
                    {!! nl2br(e($post->konten)) !!}
                </div>
            </div>

            <div class="lg:w-1/3">
                <div class="sticky top-24">
                    <h3 class="text-xl font-black text-[#1B4D3E] uppercase tracking-widest mb-6 border-l-4 border-[#F4D03F] pl-4">
                        Lihat Juga
                    </h3>
                    
                    <div class="space-y-6">
                        @forelse($terkait as $item)
                        <a href="{{ route('berita.detail', $item->slug) }}" class="group block bg-white rounded-3xl p-4 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-gray-100">
                            <div class="flex gap-4 items-center">
                                <div class="w-20 h-20 rounded-2xl overflow-hidden flex-shrink-0">
                                    <img src="{{ Storage::url($item->gambar) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform">
                                </div>
                                <div>
                                    <span class="text-[9px] font-bold text-[#F4D03F] bg-[#1B4D3E] px-2 py-0.5 rounded uppercase">
                                        {{ $item->kategori }}
                                    </span>
                                    <h4 class="font-bold text-gray-800 text-sm leading-tight mt-2 group-hover:text-[#1B4D3E] line-clamp-2">
                                        {{ $item->judul }}
                                    </h4>
                                </div>
                            </div>
                        </a>
                        @empty
                        <div class="text-sm text-gray-400 font-bold italic">Tidak ada artikel terkait.</div>
                        @endforelse
                    </div>

                    <div class="mt-12 bg-[#1B4D3E] rounded-[2.5rem] p-8 text-center text-white relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-[#4ADE80] opacity-20 rounded-full blur-2xl"></div>
                        <h4 class="text-xl font-black uppercase mb-2 relative z-10">Ingin Bergabung?</h4>
                        <p class="text-xs text-gray-300 mb-6 relative z-10">Pendaftaran siswa baru telah dibuka.</p>
                        <a href="{{ route('pendaftaran.tahapan') }}" class="inline-block bg-[#F4D03F] text-[#1B4D3E] px-6 py-3 rounded-xl text-xs font-black uppercase tracking-widest hover:scale-105 transition-transform relative z-10">
                            Daftar Sekarang
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection