<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - SD Rimba Putra</title>
    <link rel="icon" href="{{ asset('images/logo.jpg') }}" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .sidebar-active { background-color: rgba(255, 255, 255, 0.1); border-left: 4px solid #F4D03F; color: #F4D03F; }
        .scrollbar-hide::-webkit-scrollbar { display: none; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

    <div class="flex h-screen overflow-hidden">
        
        <aside class="w-64 bg-[#1B4D3E] text-white flex flex-col shadow-2xl z-20 hidden md:flex">
            <div class="h-20 flex items-center gap-3 px-6 border-b border-white/10">
                <img src="{{ asset('images/logo.jpg') }}" alt="Logo SD Rimba Putra" class="w-10 h-10 object-contain hover:rotate-6 transition-transform">
                <div>
                    <h1 class="font-black text-sm uppercase tracking-wider text-[#F4D03F]">SD Rimba Putra</h1>
                    <p class="text-[10px] text-gray-300">Portal Akademik</p>
                </div>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto scrollbar-hide">
                
                @if(Auth::user()->role == 'admin')
                    <p class="px-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2 mt-2">Administrator</p>
                    
                    <a href="{{ route('admin.dashboard') }}" 
                       class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition-all hover:bg-white/5 hover:text-[#F4D03F] {{ Request::routeIs('admin.dashboard') ? 'sidebar-active' : 'text-gray-300' }}">
                        <span>🏠</span> Dashboard
                    </a>

                    <a href="{{ route('admin.pendaftar') }}" 
                       class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition-all hover:bg-white/5 hover:text-[#F4D03F] {{ Request::routeIs('admin.pendaftar') ? 'sidebar-active' : 'text-gray-300' }}">
                        <span>👥</span> Data Pendaftar
                    </a>

                    <a href="{{ route('admin.posts.index') }}" 
                       class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition-all hover:bg-white/5 hover:text-[#F4D03F] {{ Request::routeIs('admin.posts.index') ? 'sidebar-active' : 'text-gray-300' }}">
                        <span>📰</span> Berita & Surat
                    </a>

                    <a href="{{ route('admin.users.index') }}" 
                        class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition-all hover:bg-white/5 hover:text-[#F4D03F] {{ Request::routeIs('admin.users.*') ? 'sidebar-active' : 'text-gray-300' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        Manajemen User
                    </a>

                    <a href="{{ route('admin.profile.index') }}" 
                        class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition-all hover:bg-white/5 hover:text-[#F4D03F] {{ Request::routeIs('admin.profile.*') ? 'sidebar-active' : 'text-gray-300' }}">
                        <span>🏫</span> Manajemen Profil Sekolah
                    </a>
                @else
                    <p class="px-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2 mt-2">Calon Siswa</p>
                    
                    <a href="{{ route('dashboard') }}" 
                       class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition-all hover:bg-white/5 hover:text-[#F4D03F] {{ Request::routeIs('dashboard') ? 'sidebar-active' : 'text-gray-300' }}">
                        <span>🎓</span> Status Pendaftaran
                    </a>

                    <a href="{{ route('pendaftaran.form') }}" 
                       class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition-all hover:bg-white/5 hover:text-[#F4D03F] {{ Request::routeIs('pendaftaran.form') ? 'sidebar-active' : 'text-gray-300' }}">
                        <span>📝</span> Isi Formulir
                    </a>
                @endif
                
                <div class="border-t border-white/10 mt-6 pt-6">
                    <a href="{{ route('home') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold text-gray-300 transition-all hover:bg-white/5 hover:text-[#F4D03F]">
                        <span>⬅</span> Kembali ke Website
                    </a>
                </div>
            </nav>

            <div class="p-4 border-t border-white/10">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 bg-[#F4D03F] text-[#1B4D3E] py-3 rounded-xl text-xs font-black uppercase tracking-widest hover:bg-white transition-colors shadow-lg">
                        Keluar
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 flex flex-col h-screen overflow-hidden bg-gray-50">
            <header class="h-20 bg-white border-b border-gray-100 flex items-center justify-between px-8 z-10">
                <h2 class="text-xl font-black text-[#1B4D3E] uppercase tracking-tight">
                    @yield('title', 'Dashboard')
                </h2>
                
                <div class="flex items-center gap-4">
                    <div class="text-right hidden md:block">
                        <p class="text-sm font-bold text-gray-800">{{ Auth::user()->name }}</p>
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">
                            {{ Auth::user()->role == 'admin' ? 'Administrator' : 'Calon Siswa' }}
                        </p>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-[#1B4D3E] text-[#F4D03F] flex items-center justify-center font-black text-lg border-2 border-[#F4D03F]">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                </div>
            </header>

            <div class="flex-1 overflow-x-hidden overflow-y-auto p-6 md:p-10">
                @yield('content')
            </div>
        </main>
    </div>

</body>
</html>