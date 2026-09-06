@extends('layouts.app')

@section('content')

<div class="relative bg-[#1B4D3E] pt-32 pb-24 px-6 md:px-16 overflow-hidden">
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-[#4ADE80] rounded-full blur-[150px] opacity-20 pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-[300px] h-[300px] bg-[#F4D03F] rounded-full blur-[120px] opacity-10 pointer-events-none"></div>
    
    <div class="container mx-auto relative z-10 text-center">
        <span class="inline-block py-1 px-3 rounded-full bg-[#F4D03F]/20 border border-[#F4D03F]/50 text-[#F4D03F] font-bold tracking-[0.2em] uppercase text-[10px] mb-4 animate-fade-in-up">
            Dokumentasi & Arsip
        </span>
        
        <h1 class="text-4xl md:text-6xl font-black text-white uppercase tracking-tighter mb-6 drop-shadow-lg animate-fade-in-up delay-100">
            Berita & <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#F4D03F] to-[#4ADE80]">Galeri</span>
        </h1>
        
        <p class="text-gray-300 text-sm md:text-base max-w-2xl mx-auto leading-relaxed animate-fade-in-up delay-200">
            Jelajahi rekam jejak prestasi, kegiatan belajar mengajar, dan momen-momen berharga keluarga besar SD Rimba Putra.
        </p>
    </div>
</div>

<div class="sticky top-20 z-40 py-6 transition-all duration-300" id="filter-bar">
    <div class="container mx-auto px-6 md:px-16">
        <div class="bg-white/90 backdrop-blur-md border border-gray-100 shadow-xl rounded-full p-2 flex justify-center flex-wrap gap-2 md:gap-4 max-w-3xl mx-auto">
            <button onclick="filterContent('all')" class="filter-btn active px-6 py-2.5 rounded-full text-[11px] font-black uppercase tracking-wider transition-all duration-300">
                Semua
            </button>
            <button onclick="filterContent('berita')" class="filter-btn px-6 py-2.5 rounded-full text-[11px] font-black uppercase tracking-wider transition-all duration-300">
                📰 Berita
            </button>
            <button onclick="filterContent('prestasi')" class="filter-btn px-6 py-2.5 rounded-full text-[11px] font-black uppercase tracking-wider transition-all duration-300">
                🏆 Prestasi
            </button>
            <button onclick="filterContent('galeri')" class="filter-btn px-6 py-2.5 rounded-full text-[11px] font-black uppercase tracking-wider transition-all duration-300">
                📸 Galeri
            </button>
        </div>
    </div>
</div>

<div class="container mx-auto px-6 md:px-16 pb-32 min-h-screen">
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8" id="content-grid">

        @forelse($semuaBerita as $index => $post)
            
            {{-- LOGIKA TAMPILAN: Item Pertama tampil Besar --}}
            @if($index == 0)
                <a href="{{ route('berita.detail', $post->slug) }}" class="content-item {{ $post->kategori }} md:col-span-2 relative group rounded-[2.5rem] overflow-hidden shadow-2xl h-[450px] cursor-pointer border-4 border-white block">
                    <img src="{{ Storage::url($post->gambar) }}" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="{{ $post->judul }}">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#1B4D3E] via-[#1B4D3E]/60 to-transparent opacity-90"></div>
                    
                    <div class="absolute bottom-0 left-0 p-8 md:p-12 w-full">
                        <div class="flex items-center gap-3 mb-4">
                            <span class="bg-[#F4D03F] text-[#1B4D3E] px-3 py-1 rounded-lg text-[10px] font-black uppercase tracking-widest shadow-md">
                                {{ $post->kategori }} </span>
                            <span class="text-white/80 text-[10px] font-bold uppercase tracking-widest">
                                {{ $post->created_at->format('d M Y') }}
                            </span>
                        </div>
                        <h3 class="text-2xl md:text-3xl font-black text-white leading-tight mb-3 group-hover:text-[#F4D03F] transition-colors line-clamp-2">
                            {{ $post->judul }}
                        </h3>
                        <p class="text-gray-200 text-sm line-clamp-2 mb-6 hidden md:block leading-relaxed">
                            {{ Str::limit(strip_tags($post->konten), 150) }}
                        </p>
                        <div class="flex items-center gap-2 text-[#4ADE80] text-xs font-black uppercase tracking-widest group-hover:translate-x-2 transition-transform">
                            Baca Selengkapnya <span class="text-lg">→</span>
                        </div>
                    </div>
                </a>

            @else
                <article class="content-item {{ $post->kategori }} bg-white rounded-[2.5rem] p-5 shadow-[0_10px_40px_rgba(0,0,0,0.05)] border border-gray-100 hover:-translate-y-2 transition-transform duration-300 group flex flex-col h-[450px]">
                    <div class="relative h-1/2 rounded-[2rem] overflow-hidden mb-5 bg-gray-100">
                        <div class="absolute top-4 left-4 bg-[#1B4D3E] text-white px-4 py-1.5 rounded-full text-[10px] font-black uppercase z-10 shadow-lg border border-[#4ADE80]">
                            {{ $post->kategori }}
                        </div>
                        <img src="{{ Storage::url($post->gambar) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="px-2 flex-1 flex flex-col">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">
                                {{ $post->created_at->format('d M Y') }}
                            </span>
                        </div>
                        <h4 class="font-black text-gray-800 text-lg leading-tight mb-3 group-hover:text-[#1B4D3E] transition-colors line-clamp-2">
                            {{ $post->judul }}
                        </h4>
                        <p class="text-gray-500 text-xs line-clamp-3 mb-4 leading-relaxed flex-1">
                            {{ Str::limit(strip_tags($post->konten), 100) }}
                        </p>
                        
                        <a href="{{ route('berita.detail', $post->slug) }}" class="mt-auto w-full text-center bg-[#F4D03F]/20 text-[#1B4D3E] py-3 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-[#F4D03F] transition-all">
                            Lihat Detail
                        </a>
                    </div>
                </article>
            @endif

        @empty
            <div class="col-span-1 md:col-span-3 text-center py-20">
                <div class="text-6xl mb-4">📭</div>
                <h3 class="text-xl font-bold text-gray-400">Belum ada konten yang diupload.</h3>
            </div>
        @endforelse

    </div>

    <div class="mt-20 flex justify-center">
        {{ $semuaBerita->links() }}
    </div>

</div>

@push('scripts')
<style>
    /* Pagination CSS */
    .pagination { display: flex; gap: 0.5rem; }
    .page-item.active .page-link { background-color: #1B4D3E; border-color: #1B4D3E; color: white; }
    .page-link { padding: 0.5rem 1rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 900; }

    /* Filter Button CSS */
    .filter-btn { background-color: #FFFFFF; color: #9CA3AF; border: 1px solid #E5E7EB; }
    .filter-btn:hover { border-color: #1B4D3E; color: #1B4D3E; }
    .filter-btn.active { background-color: #1B4D3E !important; color: #F4D03F !important; border-color: #1B4D3E !important; box-shadow: 0 4px 15px rgba(27, 77, 62, 0.3); }
    
    /* Animation */
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
    .animate-fade-in-up { animation: fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; opacity: 0; }
    .delay-100 { animation-delay: 0.1s; } .delay-200 { animation-delay: 0.2s; }
    .fade-in { animation: fadeInUp 0.5s ease-out forwards; }
</style>

<script>
    function filterContent(category) {
        // 1. Ubah Style Tombol
        const buttons = document.querySelectorAll('.filter-btn');
        buttons.forEach(btn => {
            btn.classList.remove('active'); 
            if(btn.getAttribute('onclick').includes(category)) btn.classList.add('active'); 
        });

        // 2. Filter Konten
        const items = document.querySelectorAll('.content-item');
        items.forEach(item => {
            item.classList.remove('fade-in');
            item.style.opacity = '0';
            
            setTimeout(() => {
                // Tampilkan jika kategori 'all' ATAU item memiliki class kategori tersebut
                if (category === 'all' || item.classList.contains(category)) {
                    item.style.display = 'flex'; 
                    // Perbaikan bug display flex pada item Grid besar
                    if(item.classList.contains('md:col-span-2')) { 
                        // Jika item besar, pastikan layoutnya tidak rusak
                        item.style.display = window.innerWidth >= 768 ? 'block' : 'flex'; 
                    }
                    item.classList.add('fade-in'); 
                } else {
                    item.style.display = 'none'; 
                }
            }, 100);
        });
    }
    // Set default active button
    document.querySelector('.filter-btn').classList.add('active');
</script>
@endpush
@endsection