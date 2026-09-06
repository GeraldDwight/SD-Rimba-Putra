@extends('layouts.dashboard')

@section('title', 'Admin Dashboard')

@section('content')

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
    
    <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-gray-100 flex items-center gap-4">
        <div class="w-14 h-14 rounded-2xl bg-[#1B4D3E]/10 text-[#1B4D3E] flex items-center justify-center text-2xl">👥</div>
        <div>
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Total Pendaftar</p>
            <h3 class="text-3xl font-black text-gray-800">{{ $totalPendaftar }}</h3>
        </div>
    </div>

    <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-gray-100 flex items-center gap-4">
        <div class="w-14 h-14 rounded-2xl bg-yellow-50 text-yellow-600 flex items-center justify-center text-2xl">⏳</div>
        <div>
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Perlu Verifikasi</p>
            <h3 class="text-3xl font-black text-gray-800">{{ $menungguVerifikasi }}</h3>
        </div>
    </div>

    <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-gray-100 flex items-center gap-4">
        <div class="w-14 h-14 rounded-2xl bg-green-50 text-green-600 flex items-center justify-center text-2xl">✅</div>
        <div>
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Diterima</p>
            <h3 class="text-3xl font-black text-gray-800">{{ $diterima }}</h3>
        </div>
    </div>

    <div class="bg-[#1B4D3E] p-6 rounded-[2rem] shadow-lg flex items-center gap-4 text-white relative overflow-hidden">
        <div class="absolute right-0 top-0 w-20 h-20 bg-[#4ADE80] rounded-full blur-2xl opacity-20"></div>
        <div class="w-14 h-14 rounded-2xl bg-white/20 text-[#F4D03F] flex items-center justify-center text-2xl backdrop-blur-sm">📅</div>
        <div>
            <p class="text-[10px] font-bold text-green-200 uppercase tracking-widest">Hari Ini</p>
            <h3 class="text-xl font-black text-white">{{ date('d M Y') }}</h3>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
    <a href="{{ route('admin.posts.index') }}" class="group bg-gradient-to-br from-[#1B4D3E] to-[#143d30] p-8 rounded-[2rem] text-white shadow-xl relative overflow-hidden hover:scale-[1.02] transition-all cursor-pointer">
        <div class="absolute top-0 right-0 w-40 h-40 bg-[#4ADE80] rounded-full blur-[80px] opacity-20 group-hover:opacity-30 transition-opacity"></div>
        <div class="relative z-10 flex items-center justify-between">
            <div>
                <h3 class="text-2xl font-black mb-2">Manajemen Konten</h3>
                <p class="text-green-200 text-sm mb-6">Upload berita kegiatan & surat pengumuman.</p>
                <div class="bg-[#F4D03F] text-[#1B4D3E] px-6 py-3 rounded-xl text-xs font-black uppercase tracking-widest hover:bg-white transition-colors inline-block">
                    + Tambah Baru
                </div>
            </div>
            <div class="text-6xl opacity-80">📰</div>
        </div>
    </a>

    <a href="{{ route('admin.pendaftar') }}" class="group bg-white border border-gray-100 p-8 rounded-[2rem] shadow-sm hover:shadow-xl hover:border-[#1B4D3E] transition-all relative overflow-hidden cursor-pointer">
        <div class="relative z-10 flex items-center justify-between">
            <div>
                <h3 class="text-2xl font-black text-gray-800 mb-2">Verifikasi Siswa</h3>
                <p class="text-gray-400 text-sm mb-6">Cek berkas & update status kelulusan.</p>
                <div class="bg-gray-100 text-gray-600 px-6 py-3 rounded-xl text-xs font-black uppercase tracking-widest group-hover:bg-[#1B4D3E] group-hover:text-white transition-colors inline-block">
                    Lihat Data
                </div>
            </div>
            <div class="text-6xl opacity-80 grayscale group-hover:grayscale-0 transition-all">👥</div>
        </div>
    </a>
</div>

<div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm p-8">
    <div class="flex items-center justify-between mb-8">
        <h3 class="text-xl font-black text-[#1B4D3E] uppercase tracking-tight">5 Pendaftar Terakhir</h3>
        <a href="{{ route('admin.pendaftar') }}" class="text-xs font-bold text-[#1B4D3E] hover:text-[#F4D03F] uppercase tracking-widest border-b border-gray-200 pb-1">Lihat Semua →</a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-gray-100 text-xs uppercase font-black text-gray-400 tracking-wider">
                    <th class="pb-4 pl-2">Nama Siswa</th>
                    <th class="pb-4">Tanggal Daftar</th>
                    <th class="pb-4">Status</th>
                    <th class="pb-4 text-right pr-2">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm font-bold text-gray-700">
                @forelse($pendaftarTerbaru as $siswa)
                <tr class="group hover:bg-gray-50 transition-colors border-b border-gray-50 last:border-0">
                    <td class="py-4 pl-2 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-[#1B4D3E]/10 text-[#1B4D3E] flex items-center justify-center text-xs font-black">
                            {{ substr($siswa->nama_lengkap, 0, 1) }}
                        </div>
                        <div>
                            <p>{{ $siswa->nama_lengkap }}</p>
                            <p class="text-[10px] text-gray-400 font-normal">NIK: {{ $siswa->nik }}</p>
                        </div>
                    </td>
                    <td class="py-4 text-gray-500">{{ $siswa->created_at->format('d M Y') }}</td>
                    <td class="py-4">
                        @if($siswa->status == 'menunggu_verifikasi')
                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-[10px] font-black uppercase">Pending</span>
                        @elseif($siswa->status == 'diterima')
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-[10px] font-black uppercase">Diterima</span>
                        @else
                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-[10px] font-black uppercase">Ditolak</span>
                        @endif
                    </td>
                    <td class="py-4 text-right pr-2">
                        <a href="{{ route('admin.pendaftar') }}" class="text-[#1B4D3E] text-[10px] uppercase font-bold hover:underline">
                            Cek Berkas
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-10">
                        <div class="text-4xl mb-2">📭</div>
                        <p class="text-gray-400 italic font-medium">Belum ada pendaftar masuk.</p>
                        <p class="text-[10px] text-gray-300">Data akan muncul otomatis saat siswa mengisi formulir.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection