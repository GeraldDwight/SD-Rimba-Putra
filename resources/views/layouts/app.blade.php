<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Beranda') - SD Rimba Putra</title>
    <link rel="icon" href="{{ asset('images/logo.jpg') }}" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .footer-main { background-color: #1B4D3E; } 
        .btn-login { background-color: #1B4D3E; color: #F4D03F; border: 1px solid #F4D03F; } 
        .btn-login:hover { background-color: #F4D03F; color: #1B4D3E; }
        #main-navbar { transition: all 0.4s ease-in-out; }
        
        .nav-top {
            background-color: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(12px);
            padding-top: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }

        .nav-scrolled {
            background-color: rgba(255, 255, 255, 0.98) !important;
            backdrop-filter: blur(20px);
            padding-top: 0.75rem !important;
            padding-bottom: 0.75rem !important;
            box-shadow: 0 4px 20px rgba(27, 77, 62, 0.1);
        }
        
        @media (min-width: 768px) {
            .nav-top { padding-top: 1.5rem; padding-bottom: 1.5rem; }
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-900 overflow-x-hidden selection:bg-[#1B4D3E] selection:text-[#F4D03F]">

    <nav id="main-navbar" class="nav-top fixed top-0 w-full z-[999] flex justify-between items-center px-6 md:px-16">
        
        <div class="flex items-center gap-3 w-auto md:w-1/4 z-50">
            <img src="{{ asset('images/logo.jpg') }}" alt="Logo SD Rimba Putra" class="w-10 h-10 md:w-12 md:h-12 object-contain hover:rotate-6 transition-transform">
            <h1 class="font-black text-lg md:text-xl tracking-tighter text-[#1B4D3E] uppercase leading-none">
                SD RIMBA PUTRA
            </h1>
        </div>

        <div class="hidden md:flex flex-1 justify-center gap-8 text-sm uppercase font-bold text-[#1B4D3E]">
            <a href="{{ route('home') }}" class="hover:text-[#F4D03F] transition py-2 relative group">
                Home
                <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-[#F4D03F] transition-all duration-300 group-hover:w-full"></span>
            </a>
            <a href="{{ route('profile') }}" class="hover:text-[#F4D03F] transition py-2 relative group">
                Profil
                <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-[#F4D03F] transition-all duration-300 group-hover:w-full"></span>
            </a>
            <a href="{{ route('berita') }}" class="hover:text-[#F4D03F] transition py-2 relative group">
                Berita & Galeri
                <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-[#F4D03F] transition-all duration-300 group-hover:w-full"></span>
            </a>
            <a href="{{ route('pendaftaran.tahapan') }}" class="hover:text-[#F4D03F] transition py-2 relative group flex items-center gap-1">
                Pendaftaran
                <span class="bg-red-500 text-white text-[8px] px-1.5 py-0.5 rounded-full animate-pulse ml-1">New</span>
            </a>
        </div>

        <div class="hidden md:flex w-1/4 justify-end">
            @guest
                <a href="{{ route('login') }}" class="btn-login px-8 py-2.5 rounded-full text-[10px] font-black tracking-widest shadow-lg transition-all hover:scale-105 uppercase flex items-center gap-2">
                    Login
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                </a>
            @endguest

            @auth
                <div class="flex items-center gap-4 bg-white/50 backdrop-blur-sm p-1 pl-4 rounded-full border border-[#1B4D3E]/20">
                    <span class="text-[10px] font-black text-[#1B4D3E] uppercase">Hi, {{ explode(' ', Auth::user()->name)[0] }}</span>
                    <a href="{{ Auth::user()->role == 'admin' ? route('admin.dashboard') : route('dashboard') }}" 
                       class="btn-login px-5 py-2 rounded-full font-black text-[10px] uppercase tracking-wider shadow-md hover:bg-black transition-colors">
                        Panel
                    </a>
                </div>
            @endauth
        </div>

        <button id="mobile-menu-btn" class="md:hidden text-[#1B4D3E] z-50 p-2 focus:outline-none">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
            </svg>
        </button>

    </nav>

    <div id="mobile-menu" class="fixed inset-0 bg-white z-[998] flex flex-col justify-center items-center gap-8 transform translate-x-full transition-transform duration-300 md:hidden">
        <a href="{{ route('home') }}" class="text-2xl font-black text-[#1B4D3E] uppercase hover:text-[#F4D03F]">Home</a>
        <a href="{{ route('profile') }}" class="text-2xl font-black text-[#1B4D3E] uppercase hover:text-[#F4D03F]">Profil</a>
        <a href="{{ route('berita') }}" class="text-2xl font-black text-[#1B4D3E] uppercase hover:text-[#F4D03F]">Berita & Galeri</a>
        <a href="{{ route('pendaftaran.tahapan') }}" class="text-2xl font-black text-[#1B4D3E] uppercase hover:text-[#F4D03F] flex items-center gap-2">
            Pendaftaran <span class="bg-red-500 text-white text-[10px] px-2 py-1 rounded-full animate-pulse">New</span>
        </a>
        
        <div class="mt-4 border-t border-gray-100 pt-8 w-2/3 flex justify-center">
            @guest
                <a href="{{ route('login') }}" class="btn-login px-10 py-4 rounded-full text-sm font-black tracking-widest shadow-lg uppercase flex items-center gap-2">
                    Masuk / Login
                </a>
            @endguest

            @auth
                <a href="{{ Auth::user()->role == 'admin' ? route('admin.dashboard') : route('dashboard') }}" class="btn-login px-10 py-4 rounded-full text-sm font-black tracking-widest shadow-lg uppercase flex items-center gap-2">
                    Masuk ke Panel
                </a>
            @endauth
        </div>
    </div>

    @if(Request::is('/'))
    <div class="relative w-full h-[500px] md:h-[650px] overflow-hidden bg-black z-0">
        <img src="{{ asset('images/background.webp') }}" 
             class="w-full h-full object-cover opacity-70" 
             alt="Banner SD Rimba Putra">
        
        <div class="absolute inset-0 bg-black/60 bg-gradient-to-r from-[#1B4D3E] via-black/40 to-transparent flex items-center px-8 md:px-20 text-white">
            <div class="max-w-4xl pt-20"> 
                <span class="bg-[#F4D03F] text-[#1B4D3E] px-4 py-1.5 rounded-full text-[9px] md:text-[11px] font-black uppercase tracking-[0.2em] italic shadow-lg mb-4 inline-block">
                    Beradab • Berprestasi • Berwawasan Lingkungan
                </span>

                <h2 class="text-4xl md:text-7xl font-extrabold mt-2 leading-[1.1] uppercase tracking-tighter drop-shadow-2xl">
                    Mencetak Generasi <br> 
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#F4D03F] to-[#4ADE80]">
                        Berkarakter Juara
                    </span>
                </h2>

                <p class="mt-6 text-gray-100 text-sm md:text-xl font-medium leading-relaxed max-w-2xl drop-shadow-md">
                    Kami membina siswa untuk tidak hanya unggul dalam akademik, tetapi juga memiliki adab mulia dan kecintaan pada alam.
                </p>

                <div class="mt-8 md:mt-12 flex gap-4">
                    <a href="{{ route('pendaftaran.tahapan') }}" 
                       class="bg-[#4ADE80] text-green-900 px-8 py-4 md:px-10 md:py-5 rounded-2xl font-black text-xs md:text-sm uppercase tracking-widest shadow-2xl hover:bg-white hover:scale-105 transition-all duration-300 inline-block">
                        Daftar Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endif

    <main class="min-h-screen {{ Request::is('/') ? '' : 'pt-24 md:pt-32' }}">
        @yield('content')
    </main>

    <footer class="footer-main pt-16 pb-10 px-6 md:px-16 mt-12 text-white bg-[#1B4D3E] relative overflow-hidden">
        
        <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-[#F4D03F] via-[#4ADE80] to-[#F4D03F]"></div>
        <div class="absolute bottom-0 right-0 w-64 h-64 bg-[#4ADE80] rounded-full blur-[120px] opacity-10 pointer-events-none"></div>

        <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-12 md:gap-16 mb-12 relative z-10">
            <div>
                <h3 class="text-xl font-black mb-6 uppercase tracking-widest text-[#F4D03F]">SD Rimba Putra</h3>
                <p class="text-sm leading-relaxed text-gray-300 font-medium mb-8 border-l-2 border-[#F4D03F] pl-4">
                    Berkomitmen mewujudkan generasi yang <strong>Beradab, Berprestasi, dan Berkarakter</strong>. Kami menanamkan nilai <strong>Budaya Lingkungan</strong> sejak dini sebagai pondasi kokoh bagi siswa.
                </p>
                <div class="flex gap-4">
                    <a href="https://www.instagram.com/sd.rimbaputra" target="_blank" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-pink-600 hover:scale-110 transition-all border border-white/10"><svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg></a>
                    <a href="https://youtube.com/@sdrimbaputra7882" target="_blank" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-red-600 hover:scale-110 transition-all border border-white/10"><svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg></a>
                </div>
            </div>

            <div>
                <h3 class="text-xl font-black mb-6 uppercase tracking-widest text-[#F4D03F]">Kontak Kami</h3>
                <ul class="text-sm space-y-4 text-gray-300">
                    <li class="flex items-start gap-4">
                        <span class="text-[#4ADE80] font-bold text-lg">📍</span>
                        <span class="text-xs leading-loose">Jl. Rimba Mulya 1 No.12-23, Pasirmulya, Bogor Barat, Kota Bogor, 16118</span>
                    </li>
                    <li class="flex items-center gap-4">
                        <span class="text-[#4ADE80] font-bold text-lg">📞</span>
                        <span class="text-xs font-bold tracking-wider"> (0251) 8638478</span>
                    </li>
                </ul>
            </div>

            <div>
                <h3 class="text-xl font-black mb-6 uppercase tracking-widest text-[#F4D03F]">Tautan Cepat</h3>
                <ul class="text-sm text-gray-300 space-y-3 font-bold uppercase text-[10px] tracking-wider">
                    <li><a href="{{ route('home') }}" class="hover:text-[#4ADE80] transition flex items-center gap-2"><span class="text-[#F4D03F]">></span> Beranda</a></li>
                    <li><a href="{{ route('profile') }}" class="hover:text-[#4ADE80] transition flex items-center gap-2"><span class="text-[#F4D03F]">></span> Profil Sekolah</a></li>
                    <li><a href="{{ route('berita') }}" class="hover:text-[#4ADE80] transition flex items-center gap-2"><span class="text-[#F4D03F]">></span> Berita & Galeri</a></li>
                    <li><a href="{{ route('pendaftaran.tahapan') }}" class="hover:text-[#4ADE80] transition flex items-center gap-2"><span class="text-[#F4D03F]">></span> Alur Pendaftaran</a></li>
                </ul>
            </div>
        </div>
        
        <div class="text-center border-t border-white/10 pt-8 text-[10px] text-gray-400 font-bold uppercase tracking-[0.3em]">
            Copyright &copy; {{ date('Y') }} SD Rimba Putra. All Rights Reserved.
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        // Logika Navbar mengecil saat di-scroll
        const navbar = document.getElementById('main-navbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.classList.add('nav-scrolled');
                navbar.classList.remove('nav-top');
            } else {
                navbar.classList.add('nav-top');
                navbar.classList.remove('nav-scrolled');
            }
        });

        // Logika Buka/Tutup Menu di Layar HP
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        
        mobileMenuBtn.addEventListener('click', () => {
            // Geser menu masuk/keluar layar
            mobileMenu.classList.toggle('translate-x-full');
            
            // Animasi ubah icon Garis Tiga menjadi Silang (X)
            if(mobileMenu.classList.contains('translate-x-full')) {
                mobileMenuBtn.innerHTML = '<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>';
            } else {
                mobileMenuBtn.innerHTML = '<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>';
            }
        });
    </script>
    @stack('scripts')
</body>
</html>