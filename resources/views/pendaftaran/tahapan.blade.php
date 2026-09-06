@extends('layouts.app')

@section('content')

<div class="container mx-auto px-6 md:px-16 pt-8 pb-24">

    <div class="bg-[#1B4D3E] rounded-[2.5rem] p-8 md:p-12 mb-16 shadow-2xl relative overflow-hidden flex flex-col md:flex-row items-center justify-between gap-8">
        <div class="absolute top-0 right-0 w-64 h-64 bg-[#4ADE80] rounded-full blur-[100px] opacity-20 pointer-events-none"></div>
        
        <div class="relative z-10 text-center md:text-left">
            <span class="text-[#F4D03F] font-bold tracking-[0.2em] uppercase text-xs mb-2 block">
                Penerimaan Peserta Didik Baru
            </span>
            <h1 class="text-3xl md:text-5xl font-black text-white uppercase tracking-tighter mb-2">
                Tahapan & Biaya
            </h1>
            <p class="text-green-100 text-sm font-medium tracking-widest uppercase">
                Tahun Ajaran 2026/2027 • Akreditasi A
            </p>
        </div>

        <div class="relative z-10 flex flex-col items-center md:items-end gap-3">
            <div class="animate-bounce">
                <span class="bg-[#F4D03F] text-[#1B4D3E] text-[9px] font-black px-3 py-1 rounded-full uppercase tracking-widest shadow-lg border border-yellow-300">
                    👇 Simpan Dokumen
                </span>
            </div>

            <a href="{{ asset('files/brosur-sd-rimba-putra.pdf') }}" download class="group relative bg-white text-[#1B4D3E] pl-4 pr-6 py-3 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-[#F4D03F] transition-all shadow-lg flex items-center gap-4 overflow-hidden">
                <div class="bg-[#1B4D3E]/10 group-hover:bg-[#1B4D3E]/20 p-2 rounded-xl transition-colors">
                    <svg class="w-6 h-6 text-[#1B4D3E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <div class="text-left">
                    <span class="block text-[9px] opacity-60 font-bold mb-0.5">File Brosur</span>
                    <span class="block text-sm">Unduh PDF</span>
                </div>
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
        
        <div class="space-y-12">
            <div>
                <h3 class="text-2xl font-black text-gray-800 mb-8 uppercase flex items-center gap-3">
                    <span class="w-2 h-8 bg-[#1B4D3E] rounded-full"></span> Alur Pendaftaran
                </h3>
                <div class="space-y-6">
                    <div class="flex gap-6 items-start group">
                        <div class="flex-none w-12 h-12 bg-green-50 text-[#1B4D3E] rounded-2xl flex items-center justify-center font-black shadow-sm group-hover:bg-[#1B4D3E] group-hover:text-[#F4D03F] transition-colors border border-green-100">01</div>
                        <div>
                            <h4 class="font-bold text-gray-800 uppercase text-sm mb-1">Buat Akun & Login</h4>
                            <p class="text-gray-500 text-xs leading-relaxed">Mendaftar akun baru pada portal akademik, lalu masuk ke dalam sistem.</p>
                        </div>
                    </div>
                    <div class="flex gap-6 items-start group">
                        <div class="flex-none w-12 h-12 bg-green-50 text-[#1B4D3E] rounded-2xl flex items-center justify-center font-black shadow-sm group-hover:bg-[#1B4D3E] group-hover:text-[#F4D03F] transition-colors border border-green-100">02</div>
                        <div>
                            <h4 class="font-bold text-gray-800 uppercase text-sm mb-1">Pengisian Formulir</h4>
                            <p class="text-gray-500 text-xs leading-relaxed">Melengkapi biodata calon siswa, data orang tua, dan unggah dokumen.</p>
                        </div>
                    </div>
                    <div class="flex gap-6 items-start group">
                        <div class="flex-none w-12 h-12 bg-green-50 text-[#1B4D3E] rounded-2xl flex items-center justify-center font-black shadow-sm group-hover:bg-[#1B4D3E] group-hover:text-[#F4D03F] transition-colors border border-green-100">03</div>
                        <div>
                            <h4 class="font-bold text-gray-800 uppercase text-sm mb-1">Verifikasi Berkas</h4>
                            <p class="text-gray-500 text-xs leading-relaxed">Tim tata usaha akan memvalidasi kesesuaian dokumen yang diunggah.</p>
                        </div>
                    </div>
                    <div class="flex gap-6 items-start group">
                        <div class="flex-none w-12 h-12 bg-green-50 text-[#1B4D3E] rounded-2xl flex items-center justify-center font-black shadow-sm group-hover:bg-[#1B4D3E] group-hover:text-[#F4D03F] transition-colors border border-green-100">04</div>
                        <div>
                            <h4 class="font-bold text-gray-800 uppercase text-sm mb-1">Pembayaran</h4>
                            <p class="text-gray-500 text-xs leading-relaxed">Jika diterima, lakukan pembayaran administrasi via transfer BNI.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 p-8 rounded-[2.5rem] border border-gray-100">
                <h3 class="text-lg font-black text-gray-800 mb-6 uppercase tracking-tighter">Syarat Dokumen</h3>
                <ul class="grid grid-cols-1 sm:grid-cols-2 gap-y-4 gap-x-6 text-xs font-bold text-gray-600 uppercase">
                    <li class="flex items-center gap-3"><span class="text-[#1B4D3E] text-lg font-black">✓</span> Formulir Online</li>
                    <li class="flex items-center gap-3"><span class="text-[#1B4D3E] text-lg font-black">✓</span> Scan KK Asli</li>
                    <li class="flex items-center gap-3"><span class="text-[#1B4D3E] text-lg font-black">✓</span> Scan Akta Lahir</li>
                    <li class="flex items-center gap-3"><span class="text-[#1B4D3E] text-lg font-black">✓</span> Scan Ijazah TK</li>
                </ul>
            </div>
        </div>

        <div class="space-y-8">
            <div class="bg-white rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.1)] overflow-hidden border border-gray-100 sticky top-32">
                <div class="bg-[#1B4D3E] px-8 py-8 text-center relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-[#4ADE80] rounded-full blur-[60px] opacity-20"></div>
                    <h3 class="text-white font-black uppercase tracking-widest text-sm relative z-10">Rincian Investasi Pendidikan</h3>
                </div>
                
                <div class="p-8 md:p-10">
                    <table class="w-full text-left border-collapse mb-8">
                        <tbody class="text-gray-700 font-bold text-xs uppercase">
                            <tr class="border-b border-gray-100"><td class="py-4">Uang Pendaftaran</td><td class="py-4 text-right">Rp 200.000</td></tr>
                            <tr class="border-b border-gray-100"><td class="py-4">Uang Gedung</td><td class="py-4 text-right">Rp 3.500.000</td></tr>
                            <tr class="border-b border-gray-100"><td class="py-4">Uang Raport</td><td class="py-4 text-right">Rp 110.000</td></tr>
                            <tr class="border-b border-gray-100"><td class="py-4">SPP Bulan Juli</td><td class="py-4 text-right">Rp 225.000</td></tr>
                            <tr class="border-b border-gray-100"><td class="py-4">Seragam (Batik & OR)</td><td class="py-4 text-right">Rp 235.000</td></tr>
                        </tbody>
                        <tfoot>
                            <tr class="bg-[#F4D03F]/20 rounded-xl">
                                <td class="py-4 px-4 font-black text-[#1B4D3E] uppercase text-[10px]">Total Pembayaran</td>
                                <td class="py-4 px-4 text-right font-black text-[#1B4D3E] text-lg tracking-tighter">Rp 4.270.000</td>
                            </tr>
                        </tfoot>
                    </table>

                    <div class="p-6 bg-[#1B4D3E] rounded-3xl text-center relative overflow-hidden group">
                        <div class="absolute inset-0 bg-[#4ADE80] opacity-0 group-hover:opacity-10 transition-opacity duration-500"></div>
                        <p class="text-[#F4D03F] text-[10px] font-black uppercase tracking-widest mb-3">Transfer Bank BNI</p>
                        <p class="text-white text-2xl font-black tracking-tighter mb-1">0003462644</p>
                        <p class="text-green-200 text-[10px] font-bold uppercase tracking-wider">a.n Ratih Royhanah Mayasari</p>
                    </div>

                    <a href="{{ route('pendaftaran.form') }}" class="block w-full text-center mt-6 bg-white border-2 border-[#1B4D3E] text-[#1B4D3E] py-4 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-[#1B4D3E] hover:text-[#F4D03F] transition-all">
                        Isi Formulir Online →
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection