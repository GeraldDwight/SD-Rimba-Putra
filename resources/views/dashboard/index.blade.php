@extends('layouts.dashboard')
@section('title', 'Dashboard Siswa')

@section('content')

<div class="bg-[#1B4D3E] rounded-[2rem] p-10 text-white relative overflow-hidden shadow-xl mb-10">
    <div class="absolute top-0 right-0 w-64 h-64 bg-[#4ADE80] rounded-full blur-[80px] opacity-20"></div>
    <div class="relative z-10">
        <h3 class="text-3xl font-black mb-2">Halo, {{ Auth::user()->name }}! 👋</h3>
        <p class="text-green-100 opacity-90">Selamat datang di Portal Akademik SD Rimba Putra.</p>
    </div>
</div>

@if(!$pendaftaran)
    <div class="text-center py-12 bg-white rounded-[2rem] border border-dashed border-gray-300">
        <div class="text-6xl mb-4">📝</div>
        <h3 class="text-xl font-bold text-gray-700 mb-2">Anda Belum Mendaftar</h3>
        <p class="text-gray-500 mb-6">Silakan isi formulir pendaftaran untuk memulai proses penerimaan siswa baru.</p>
        <a href="{{ route('pendaftaran.form') }}" class="bg-[#1B4D3E] text-white px-8 py-3 rounded-xl font-bold hover:bg-[#F4D03F] hover:text-[#1B4D3E] transition-all shadow-lg">
            Isi Formulir Sekarang
        </a>
    </div>
@else
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-2 space-y-8">
            
            <div class="bg-white rounded-[2rem] p-8 border border-gray-100 shadow-sm">
                <div class="flex justify-between items-center mb-8">
                    <h4 class="text-lg font-black text-[#1B4D3E] uppercase tracking-wider">Status Pendaftaran</h4>
                    @php
                        $statusClass = match($pendaftaran->status) {
                            'diterima' => 'bg-green-100 text-green-700 border-green-200',
                            'ditolak' => 'bg-red-100 text-red-700 border-red-200',
                            default => 'bg-yellow-100 text-yellow-700 border-yellow-200'
                        };
                    @endphp
                    <span class="px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest border {{ $statusClass }}">
                        {{ str_replace('_', ' ', $pendaftaran->status) }}
                    </span>
                </div>

                <div class="relative flex justify-between items-center">
                    <div class="absolute top-4 left-0 w-full h-1 bg-gray-100 -z-10 rounded-full"></div>
                    
                    <div class="flex flex-col items-center gap-2">
                        <div class="w-8 h-8 rounded-full bg-[#1B4D3E] text-[#F4D03F] flex items-center justify-center font-bold text-xs border-4 border-white shadow-md">✓</div>
                        <span class="text-[10px] font-bold text-[#1B4D3E]">Formulir</span>
                    </div>

                    <div class="flex flex-col items-center gap-2">
                        <div class="w-8 h-8 rounded-full {{ $pendaftaran->status != 'menunggu_verifikasi' ? 'bg-[#1B4D3E] text-[#F4D03F]' : 'bg-yellow-400 text-white animate-pulse' }} flex items-center justify-center font-bold text-xs border-4 border-white shadow-md">
                            {{ $pendaftaran->status != 'menunggu_verifikasi' ? '✓' : '⏳' }}
                        </div>
                        <span class="text-[10px] font-bold text-gray-600">Verifikasi</span>
                    </div>

                    <div class="flex flex-col items-center gap-2">
                        @if($pendaftaran->status == 'diterima')
                            <div class="w-8 h-8 rounded-full bg-green-500 text-white flex items-center justify-center font-bold text-xs border-4 border-white shadow-md">✓</div>
                        @elseif($pendaftaran->status == 'ditolak')
                            <div class="w-8 h-8 rounded-full bg-red-500 text-white flex items-center justify-center font-bold text-xs border-4 border-white shadow-md">✕</div>
                        @else
                            <div class="w-8 h-8 rounded-full bg-gray-300 text-white flex items-center justify-center font-bold text-xs border-4 border-white">?</div>
                        @endif
                        <span class="text-[10px] font-bold text-gray-600">Pengumuman</span>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-[2rem] p-8 border border-gray-100 shadow-sm">
                <h4 class="text-lg font-black text-[#1B4D3E] uppercase tracking-wider mb-6 border-b border-gray-100 pb-4">
                    Data Calon Siswa
                </h4>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
                    <div class="p-4 bg-gray-50 rounded-xl border border-gray-100">
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider mb-1">Nama Lengkap</p>
                        <p class="font-bold text-gray-800">{{ $pendaftaran->nama_lengkap }}</p>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-xl border border-gray-100">
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider mb-1">NIK</p>
                        <p class="font-bold text-gray-800">{{ $pendaftaran->nik }}</p>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-xl border border-gray-100">
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider mb-1">TTL</p>
                        <p class="font-bold text-gray-800">{{ $pendaftaran->tempat_lahir }}, {{ \Carbon\Carbon::parse($pendaftaran->tanggal_lahir)->format('d M Y') }}</p>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-xl border border-gray-100">
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider mb-1">Jenis Kelamin</p>
                        <p class="font-bold text-gray-800">{{ $pendaftaran->jenis_kelamin }}</p>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-xl border border-gray-100 md:col-span-2">
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider mb-1">Alamat</p>
                        <p class="font-bold text-gray-800">{{ $pendaftaran->alamat }}</p>
                    </div>
                </div>
            </div>

        </div>

        <div class="space-y-8">
            
            <div class="bg-[#1B4D3E] rounded-[2rem] p-8 text-white relative overflow-hidden shadow-lg">
                <div class="absolute bottom-0 left-0 w-32 h-32 bg-[#F4D03F] rounded-full blur-[60px] opacity-20"></div>
                <h4 class="text-sm font-black text-[#F4D03F] uppercase mb-4 border-b border-white/10 pb-2 relative z-10">Data Orang Tua</h4>
                <ul class="space-y-4 relative z-10 text-sm">
                    <li>
                        <span class="block text-[10px] text-green-200 uppercase">Ayah</span>
                        <span class="font-bold">{{ $pendaftaran->nama_ayah }}</span>
                    </li>
                    <li>
                        <span class="block text-[10px] text-green-200 uppercase">Ibu</span>
                        <span class="font-bold">{{ $pendaftaran->nama_ibu }}</span>
                    </li>
                    <li>
                        <span class="block text-[10px] text-green-200 uppercase">Kontak</span>
                        <span class="font-bold text-[#F4D03F]">{{ $pendaftaran->nomor_hp }}</span>
                    </li>
                </ul>
            </div>

            <div class="bg-white rounded-[2rem] p-6 border border-gray-100 shadow-sm text-center">
                <div class="w-12 h-12 bg-red-50 rounded-full flex items-center justify-center mx-auto mb-3 text-red-500">📄</div>
                <p class="text-xs font-bold text-gray-400 uppercase mb-4">Dokumen KK</p>
                <a href="{{ Storage::url($pendaftaran->file_kk) }}" target="_blank" class="block w-full bg-gray-100 text-gray-600 py-3 rounded-xl text-xs font-black uppercase hover:bg-[#1B4D3E] hover:text-white transition-all">
                    Lihat Dokumen
                </a>
            </div>

            @if($pendaftaran->file_akta)
            <div class="bg-white rounded-[2rem] p-6 border border-gray-100 shadow-sm text-center">
                <div class="w-12 h-12 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-3 text-blue-500">📑</div>
                <p class="text-xs font-bold text-gray-400 uppercase mb-4">Akta Kelahiran</p>
                <a href="{{ Storage::url($pendaftaran->file_akta) }}" target="_blank" class="block w-full bg-gray-100 text-gray-600 py-3 rounded-xl text-xs font-black uppercase hover:bg-[#1B4D3E] hover:text-white transition-all">
                    Lihat Dokumen
                </a>
            </div>
            @endif

            @if($pendaftaran->file_ijazah)
            <div class="bg-white rounded-[2rem] p-6 border border-gray-100 shadow-sm text-center">
                <div class="w-12 h-12 bg-yellow-50 rounded-full flex items-center justify-center mx-auto mb-3 text-yellow-500">🎓</div>
                <p class="text-xs font-bold text-gray-400 uppercase mb-4">Ijazah TK</p>
                <a href="{{ Storage::url($pendaftaran->file_ijazah) }}" target="_blank" class="block w-full bg-gray-100 text-gray-600 py-3 rounded-xl text-xs font-black uppercase hover:bg-[#1B4D3E] hover:text-white transition-all">
                    Lihat Dokumen
                </a>
            </div>
            @endif

        </div>
    </div>
@endif

@endsection