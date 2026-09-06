@extends('layouts.app')

@section('content')

<section class="py-16 px-4 md:px-16 bg-white">
    <div class="container mx-auto">
        <div class="bg-gray-50 rounded-[2.5rem] p-8 md:p-12 border-t-8 border-[#1B4D3E] shadow-2xl relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-[#4ADE80] rounded-full blur-[80px] opacity-10 pointer-events-none"></div>

            <div class="flex flex-col lg:flex-row items-start justify-between gap-12 relative z-10">
                
                <div class="lg:w-1/3 text-center lg:text-left">
                    <div class="inline-flex items-center gap-2 bg-[#F4D03F]/20 text-[#1B4D3E] px-4 py-2 rounded-full text-[10px] font-black uppercase tracking-widest mb-4 border border-[#F4D03F]/50">
                        <span class="relative flex h-2 w-2">
                          <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                          <span class="relative inline-flex rounded-full h-2 w-2 bg-red-500"></span>
                        </span>
                        Papan Pengumuman
                    </div>
                    <h3 class="text-3xl font-black text-[#1B4D3E] uppercase leading-tight tracking-tight mb-4">
                        Informasi & <br> <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#1B4D3E] to-[#4ADE80]">Surat Edaran</span>
                    </h3>
                    <p class="text-gray-500 text-sm font-medium leading-relaxed">
                        Pusat informasi resmi sekolah. Silakan unduh dokumen surat pemberitahuan atau jadwal kegiatan terbaru di sini.
                    </p>
                </div>

                <div class="lg:w-2/3 w-full grid gap-4">
                    @forelse($pengumuman as $doc)
                    <div class="group flex flex-col md:flex-row items-center justify-between bg-white hover:bg-[#1B4D3E] p-5 rounded-3xl border border-gray-100 hover:border-[#1B4D3E] transition-all duration-300 cursor-pointer shadow-sm hover:shadow-xl group">
                        <div class="flex items-center gap-5 w-full">
                            <div class="bg-[#1B4D3E]/10 p-4 rounded-2xl text-[#1B4D3E] group-hover:bg-white group-hover:text-[#1B4D3E] transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            </div>
                            <div class="text-center md:text-left">
                                <h4 class="font-bold text-gray-800 text-sm group-hover:text-white transition-colors line-clamp-1">{{ $doc->judul }}</h4>
                                <div class="flex items-center justify-center md:justify-start gap-2 mt-1">
                                    <span class="bg-gray-100 text-gray-500 text-[9px] px-2 py-0.5 rounded-md font-bold uppercase group-hover:bg-white/20 group-hover:text-gray-200">PDF</span>
                                    <span class="text-[10px] text-gray-400 font-bold uppercase group-hover:text-gray-300">{{ $doc->created_at->format('d M Y') }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <a href="{{ Storage::url($doc->file_path) }}" target="_blank" class="mt-4 md:mt-0 w-full md:w-auto bg-[#F4D03F] text-[#1B4D3E] px-6 py-3 rounded-xl text-[10px] font-black uppercase tracking-wider hover:bg-white hover:text-[#1B4D3E] transition-all shadow-sm text-center">
                            ⬇ Unduh
                        </a>
                    </div>
                    @empty
                    <div class="p-8 text-center text-gray-400">Belum ada pengumuman terbaru.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container mx-auto px-6 md:px-16 pb-24">
    <div class="flex flex-col md:flex-row items-end justify-between mb-12 gap-6">
        <div>
            <span class="text-[#1B4D3E] font-bold tracking-widest uppercase text-xs border-b-2 border-[#F4D03F] pb-1">Jendela Sekolah</span>
            <h2 class="text-3xl md:text-4xl font-black text-gray-800 mt-3">Kabar Terkini</h2>
        </div>
        <a href="{{ route('berita') }}" class="group flex items-center gap-2 text-xs font-bold text-gray-500 hover:text-[#1B4D3E] transition-colors">
            LIHAT SEMUA BERITA 
            <span class="bg-[#F4D03F] text-[#1B4D3E] w-6 h-6 flex items-center justify-center rounded-full transition-all group-hover:scale-110">→</span>
        </a>
    </div>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 mb-32">
        @forelse($berita as $post)
        <article class="group bg-white rounded-[2rem] p-3 shadow-[0_10px_30px_rgba(0,0,0,0.03)] hover:shadow-[0_20px_40px_rgba(27,77,62,0.1)] border border-gray-100 transition-all duration-300 hover:-translate-y-2 cursor-pointer">
            <div class="relative w-full h-48 rounded-[1.5rem] overflow-hidden mb-4 bg-gray-200">
                <img src="{{ Storage::url($post->gambar) }}" class="object-cover w-full h-full transform group-hover:scale-110 transition duration-700" alt="{{ $post->judul }}">
                
                <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm px-3 py-1.5 rounded-xl text-[10px] font-black uppercase text-[#1B4D3E] z-20 shadow-sm border border-[#F4D03F]">
                    {{ $post->created_at->format('d M') }}
                </div>
            </div>
            <div class="px-2 pb-4">
                <div class="flex items-center gap-2 mb-3">
                    <span class="w-2 h-2 rounded-full bg-[#F4D03F]"></span>
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Berita</span>
                </div>
                <h4 class="font-black text-gray-800 leading-snug text-lg mb-3 group-hover:text-[#1B4D3E] transition-colors line-clamp-2">
                    {{ $post->judul }}
                </h4>
                <a href="{{ route('berita.detail', $post->slug) }}" class="inline-flex items-center text-[10px] font-black text-gray-400 uppercase tracking-widest group-hover:text-[#1B4D3E] transition-colors mt-auto border-b border-transparent group-hover:border-[#F4D03F]">
                    Baca Selengkapnya
                </a>
            </div>
        </article>
        @empty
        <div class="col-span-4 text-center py-10 text-gray-400">Belum ada berita yang diterbitkan.</div>
        @endforelse
    </div>

    <div class="bg-[#1B4D3E] rounded-[3rem] p-8 md:p-16 relative overflow-hidden shadow-2xl">
        <div class="absolute top-0 right-0 w-64 h-64 bg-[#4ADE80] rounded-full blur-[100px] opacity-20 pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-[#F4D03F] rounded-full blur-[100px] opacity-10 pointer-events-none"></div>

        <div class="text-center mb-12 relative z-10">
            <span class="text-[#F4D03F] font-bold tracking-widest uppercase text-xs border border-[#F4D03F] px-3 py-1 rounded-full">Minat & Bakat</span>
            <h2 class="text-3xl md:text-4xl font-black text-white mt-4 mb-4">Ekstrakurikuler</h2>
            <p class="text-gray-300 text-sm max-w-xl mx-auto">Wadah bagi siswa untuk mengembangkan potensi non-akademik, melatih kepemimpinan, dan membangun karakter juara.</p>
        </div>

        @if(isset($eskuls) && $eskuls->count() > 0)
        <div class="swiper ekskulSwiper relative z-10 !pb-12">
            <div class="swiper-wrapper">
                @foreach($eskuls as $eskul)
                <div class="swiper-slide">
                    <div class="group relative h-80 rounded-[2rem] overflow-hidden cursor-pointer bg-white/5 border border-white/10 hover:border-[#F4D03F] transition-all duration-300">
                        <img src="{{ Storage::url($eskul->foto) }}" 
                             alt="{{ $eskul->nama }}" 
                             class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 opacity-70 group-hover:opacity-100">
                        
                        <div class="absolute inset-0 bg-gradient-to-t from-[#1B4D3E] via-[#1B4D3E]/50 to-transparent"></div>
                        
                        <div class="absolute inset-0 flex flex-col justify-end p-8">
                            <h3 class="text-white font-black text-xl uppercase tracking-wider mb-2 transform translate-y-0 group-hover:-translate-y-2 transition-transform duration-300">{{ $eskul->nama }}</h3>
                            
                            <div class="h-0 group-hover:h-auto overflow-hidden transition-all duration-300">
                                <p class="text-gray-200 text-[11px] leading-relaxed opacity-0 group-hover:opacity-100 transition-opacity duration-500 delay-100 line-clamp-3">
                                    {{ $eskul->deskripsi }}
                                </p>
                            </div>
                            <div class="w-8 h-1 bg-[#F4D03F] mt-3 rounded-full group-hover:w-16 transition-all duration-300"></div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="swiper-pagination !bottom-0"></div>
        </div>
        @else
            <div class="text-center py-12 bg-white/5 rounded-[2rem] border border-dashed border-white/20">
                <p class="text-gray-400 font-bold text-sm">Belum ada data ekstrakurikuler.</p>
            </div>
        @endif
    </div>
</div>

@push('scripts')
<style>
    .swiper-pagination-bullet { width: 8px; height: 8px; background: #ffffff; opacity: 0.3; transition: all 0.3s; }
    .swiper-pagination-bullet-active { background: #F4D03F !important; width: 24px; border-radius: 99px; opacity: 1; }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        new Swiper(".ekskulSwiper", {
            slidesPerView: 1,
            spaceBetween: 24,
            loop: true,
            autoplay: { delay: 3000, disableOnInteraction: false },
            pagination: { el: ".swiper-pagination", clickable: true },
            breakpoints: {
                640: { slidesPerView: 2 },
                1024: { slidesPerView: 3 },
                1280: { slidesPerView: 4 },
            },
        });
    });
</script>
@endpush

@endsection