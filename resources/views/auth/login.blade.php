@extends('layouts.app')

@section('content')
<div class="min-h-[85vh] flex items-center justify-center px-6 py-12 bg-gray-50">
    <div class="max-w-5xl w-full bg-white rounded-[2.5rem] shadow-2xl overflow-hidden flex flex-col md:flex-row relative">
        
        <div class="md:w-1/2 bg-[#1B4D3E] p-12 text-white flex flex-col justify-center items-center text-center relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-[#4ADE80] rounded-full blur-[100px] opacity-20 pointer-events-none"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-[#F4D03F] rounded-full blur-[80px] opacity-10 pointer-events-none"></div>

            <div class="relative z-10">
                <div class="w-32 h-32 bg-white rounded-3xl mb-8 flex items-center justify-center shadow-2xl mx-auto p-4 rotate-3 hover:rotate-0 transition-all duration-500">
                    <img 
                        src="{{ asset('images/logo.jpg') }}" 
                        alt="Logo SD" 
                        class="w-full h-full object-contain"
                    >
                </div>
                
                <h2 class="text-3xl font-black mb-4 tracking-tight">Portal Akademik</h2>
                <p class="text-green-100 font-medium leading-relaxed text-sm md:text-base opacity-90">
                    Silakan masuk untuk mengelola data siswa atau memantau status pendaftaran Anda di <span class="font-bold text-[#F4D03F]">SD Rimba Putra</span>.
                </p>

                <div class="mt-12 py-3 px-6 bg-white/10 backdrop-blur-sm rounded-2xl text-left flex items-center gap-4 w-full border border-white/5">
                    <div class="bg-[#F4D03F] p-2 rounded-lg text-[#1B4D3E]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                    <div>
                        <span class="block text-[10px] font-bold uppercase tracking-wider text-[#F4D03F]">Sistem Keamanan</span>
                        <span class="text-xs font-medium text-white">Data Anda Terenkripsi</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="md:w-1/2 p-12 md:p-16 flex flex-col justify-center bg-white relative">
            
            <div class="mb-8 text-center md:text-left border-b border-gray-50 pb-6">
                <span class="text-[#1B4D3E] font-bold tracking-widest uppercase text-xs border-b-2 border-[#F4D03F] pb-1 mb-2 inline-block">Selamat Datang</span>
                <h3 class="text-3xl font-black text-gray-800 mt-2">Login Akun</h3>
                <p class="text-gray-400 mt-2 text-sm font-medium">Masuk menggunakan akun yang terdaftar.</p>
            </div>

            @if($errors->any())
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-600 text-xs font-bold rounded-r-xl shadow-sm flex items-center gap-3 animate-pulse">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    {{ $errors->first() }}
                </div>
            @endif

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 text-xs font-bold rounded-r-xl shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST" class="space-y-5">
                @csrf
                
                <div>
                    <label class="block text-[10px] font-black uppercase text-gray-400 mb-2 ml-1 tracking-wider">Username / Email</label>
                    <div class="relative">
                        <input type="text" name="login" required 
                               class="w-full pl-12 pr-5 py-4 bg-gray-50 border-2 border-gray-100 focus:border-[#1B4D3E] focus:bg-white rounded-2xl outline-none transition-all duration-300 font-bold text-gray-700 placeholder-gray-300 text-sm"
                               placeholder="Contoh: siswa123">
                        <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-black uppercase text-gray-400 mb-2 ml-1 tracking-wider">Password</label>
                    <div class="relative">
                        <input type="password" name="password" required 
                               class="w-full pl-12 pr-5 py-4 bg-gray-50 border-2 border-gray-100 focus:border-[#1B4D3E] focus:bg-white rounded-2xl outline-none transition-all duration-300 font-bold text-gray-700 placeholder-gray-300 text-sm"
                               placeholder="••••••••">
                        <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between pt-2">
                    <label class="flex items-center gap-2 cursor-pointer group">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded border-gray-300 text-[#1B4D3E] focus:ring-[#1B4D3E]">
                        <span class="text-xs font-bold text-gray-500 group-hover:text-[#1B4D3E] transition">Ingat Saya</span>
                    </label>
                    <a href="{{ route('password.request') }}" class="text-xs font-bold text-[#1B4D3E] hover:text-[#F4D03F] transition">Lupa Password?</a>
                </div>

                <button type="submit" class="w-full bg-[#1B4D3E] text-white py-4 rounded-2xl font-black text-xs uppercase tracking-[0.2em] shadow-lg hover:bg-[#F4D03F] hover:text-[#1B4D3E] transition-all duration-300 transform hover:-translate-y-1 mt-4">
                    Masuk Sekarang
                </button>
            </form>

            <div class="mt-8">
                <div class="relative flex py-2 items-center mb-4">
                    <div class="flex-grow border-t border-gray-100"></div>
                    <span class="flex-shrink-0 mx-4 text-[10px] font-bold text-gray-300 uppercase tracking-widest">Atau masuk dengan</span>
                    <div class="flex-grow border-t border-gray-100"></div>
                </div>

                <div class="flex justify-center">
                    <a href="{{ route('auth.google') }}" class="w-14 h-14 bg-white border-2 border-gray-100 hover:border-[#1B4D3E] rounded-full flex items-center justify-center shadow-sm hover:shadow-lg hover:scale-110 transition-all duration-300 group" title="Login Google">
                        <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="w-6 h-6">
                    </a>
                </div>
            </div>

            <div class="mt-8 text-center">
                <p class="text-xs font-bold text-gray-400 mb-2">Belum punya akun?</p>
                <a href="{{ route('register') }}" class="text-xs font-black text-[#1B4D3E] hover:text-[#F4D03F] transition-colors uppercase tracking-widest border-b-2 border-transparent hover:border-[#F4D03F] inline-block pb-1">
                    Buat Akun Baru Disini
                </a>
            </div>
        </div>
    </div>
</div>
@endsection