@extends('layouts.dashboard')

@section('title', 'Data Pendaftar')

@section('content')

@if(session('success'))
<div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-r shadow-sm flex justify-between items-center animate-fade-in-up">
    <div class="flex items-center gap-2">
        <span>✅</span>
        <span class="font-bold">{{ session('success') }}</span>
    </div>
    <button class="text-xl font-bold hover:text-green-900" onclick="this.parentElement.style.display='none'">&times;</button>
</div>
@endif

<div class="bg-white rounded-[2rem] p-8 border border-gray-100 shadow-sm">
    
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
        <div>
            <h3 class="text-xl font-black text-[#1B4D3E] uppercase tracking-tight">Data Calon Siswa</h3>
            <p class="text-sm text-gray-400 font-bold">Total Pendaftar: {{ $pendaftar->total() }} Siswa</p>
        </div>
        
        <div class="relative hidden md:block">
            <input type="text" placeholder="Cari nama siswa..." class="pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:border-[#1B4D3E] outline-none text-xs font-bold w-64 transition-all focus:w-72">
            <span class="absolute left-3 top-3 text-gray-400 text-sm">🔍</span>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-[#1B4D3E] text-xs uppercase font-black tracking-wider">
                    <th class="p-4 rounded-l-xl">No</th>
                    <th class="p-4">Nama Siswa</th>
                    <th class="p-4">Asal Sekolah</th>
                    <th class="p-4">Dokumen</th>
                    <th class="p-4">Status</th>
                    <th class="p-4 rounded-r-xl text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm font-medium text-gray-600">
                @forelse($pendaftar as $index => $siswa)
                <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition duration-200">
                    
                    <td class="p-4 font-bold text-gray-400">{{ $pendaftar->firstItem() + $index }}</td>
                    
                    <td class="p-4">
                        <div class="font-black text-gray-800 text-sm">{{ $siswa->nama_lengkap }}</div>
                        <div class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mt-1">
                            NIK: {{ $siswa->nik }}
                        </div>
                    </td>
                    
                    <td class="p-4 font-semibold">{{ $siswa->asal_sekolah }}</td>
                    
                    <td class="p-4">
                        <div class="flex flex-wrap gap-2">
                            @if($siswa->file_kk)
                                <a href="{{ Storage::url($siswa->file_kk) }}" target="_blank" class="group inline-flex items-center gap-1.5 bg-blue-50 text-blue-600 px-2.5 py-1.5 rounded-lg hover:bg-blue-600 hover:text-white transition-all duration-300 border border-blue-100">
                                    <span class="text-xs">📄</span>
                                    <span class="text-[9px] font-black uppercase tracking-wider">KK</span>
                                </a>
                            @endif

                            @if($siswa->file_akta)
                                <a href="{{ Storage::url($siswa->file_akta) }}" target="_blank" class="group inline-flex items-center gap-1.5 bg-blue-50 text-blue-600 px-2.5 py-1.5 rounded-lg hover:bg-blue-600 hover:text-white transition-all duration-300 border border-blue-100">
                                    <span class="text-xs"></span>
                                    <span class="text-[9px] font-black uppercase tracking-wider">Akta</span>
                                </a>
                            @endif

                            @if($siswa->file_ijazah)
                                <a href="{{ Storage::url($siswa->file_ijazah) }}" target="_blank" class="group inline-flex items-center gap-1.5 bg-blue-50 text-blue-600 px-2.5 py-1.5 rounded-lg hover:bg-blue-600 hover:text-white transition-all duration-300 border border-blue-100">
                                    <span class="text-xs">🎓</span>
                                    <span class="text-[9px] font-black uppercase tracking-wider">Ijazah</span>
                                </a>
                            @endif

                            @if(!$siswa->file_kk && !$siswa->file_akta)
                                <span class="text-red-400 text-[10px] font-black uppercase tracking-wider bg-red-50 px-2 py-1 rounded border border-red-100">Belum Upload</span>
                            @endif
                        </div>
                    </td>
                    
                    <td class="p-4">
                        @if($siswa->status == 'menunggu_verifikasi')
                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-wider border border-yellow-200 shadow-sm">
                                ⏳ Pending
                            </span>
                        @elseif($siswa->status == 'diterima')
                            <span class="bg-green-100 text-green-700 px-3 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-wider border border-green-200 shadow-sm">
                                ✅ Diterima
                            </span>
                        @else
                            <span class="bg-red-100 text-red-700 px-3 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-wider border border-red-200 shadow-sm">
                                ❌ Ditolak
                            </span>
                        @endif
                    </td>
                    
                    <td class="p-4 text-center">
                        <div class="flex items-center justify-center gap-2">
                            
                            <form action="{{ route('admin.pendaftar.status', $siswa->id) }}" method="POST">
                                @csrf
                                <select name="status" onchange="this.form.submit()" class="text-[10px] font-bold uppercase tracking-wider border border-gray-200 rounded-lg px-2 py-2 focus:border-[#1B4D3E] outline-none cursor-pointer bg-white hover:bg-gray-50 transition-colors shadow-sm w-28">
                                    <option value="menunggu_verifikasi" {{ $siswa->status == 'menunggu_verifikasi' ? 'selected' : '' }}>⏳ Pending</option>
                                    <option value="diterima" {{ $siswa->status == 'diterima' ? 'selected' : '' }}>✅ Terima</option>
                                    <option value="ditolak" {{ $siswa->status == 'ditolak' ? 'selected' : '' }}>❌ Tolak</option>
                                </select>
                            </form>

                            <form action="{{ route('admin.pendaftar.destroy', $siswa->id) }}" method="POST" onsubmit="return confirm('⚠️ PERINGATAN!\n\nApakah Anda yakin ingin menghapus data {{ $siswa->nama_lengkap }}?\n\nData yang dihapus beserta seluruh file tidak dapat dikembalikan.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-white text-red-400 hover:bg-red-500 hover:text-white p-2 rounded-lg transition-all duration-300 shadow-sm border border-red-100 group" title="Hapus Permanen">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                            
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="p-12 text-center">
                        <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-3 text-2xl">📭</div>
                        <p class="text-gray-400 font-bold">Belum ada data pendaftar masuk.</p>
                        <p class="text-[10px] text-gray-300 uppercase tracking-widest mt-1">Data akan muncul otomatis saat siswa mendaftar</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-8 flex justify-center">
        {{ $pendaftar->links() }}
    </div>
</div>

<style>
    /* Custom Pagination Style */
    .pagination { display: flex; gap: 0.5rem; }
    .page-item.active .page-link { background-color: #1B4D3E; border-color: #1B4D3E; color: white; }
    .page-link { padding: 0.5rem 1rem; border-radius: 0.5rem; font-size: 0.75rem; font-weight: 800; color: #1B4D3E; text-decoration: none; border: 1px solid #eee; }
    .page-link:hover { background-color: #f9fafb; }
</style>

@endsection