@extends('layouts.dashboard')

@section('title', 'Formulir Pendaftaran')

@section('content')
<div class="max-w-4xl mx-auto pb-20">
    
    <div class="bg-white rounded-[2rem] shadow-lg overflow-hidden border border-gray-100 mb-8">
        <div class="bg-[#1B4D3E] p-8 text-center relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-[#4ADE80] rounded-full blur-[80px] opacity-20 pointer-events-none"></div>
            <div class="relative z-10">
                <h2 class="text-2xl md:text-3xl font-black text-white uppercase tracking-tight mb-2">
                    Formulir Calon Siswa
                </h2>
                <p class="text-green-100 font-medium text-sm">Tahun Ajaran {{ date('Y') }}/{{ date('Y')+1 }} • SD Rimba Putra</p>
            </div>
        </div>

        <div class="p-8 md:p-12">
            
            @if(session('success'))
                <div class="mb-8 p-4 bg-green-50 border-l-4 border-[#1B4D3E] text-[#1B4D3E] rounded-r-xl shadow-sm flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    <p class="font-bold text-sm">{{ session('success') }}</p>
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-8 p-4 bg-red-50 border-l-4 border-red-500 text-red-600 rounded-r-xl shadow-sm">
                    <p class="font-bold text-xs uppercase tracking-wider mb-2">Mohon periksa kembali:</p>
                    <ul class="list-disc list-inside text-sm font-medium">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('pendaftaran.simpan') }}" method="POST" enctype="multipart/form-data" class="space-y-12">
                @csrf

                <div>
                    <h3 class="flex items-center gap-3 text-lg font-black text-[#1B4D3E] uppercase tracking-wider mb-6 border-b border-gray-100 pb-4">
                        <span class="w-8 h-8 rounded-full bg-[#1B4D3E] text-[#F4D03F] flex items-center justify-center text-sm shadow-md">1</span>
                        Data Calon Siswa
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="col-span-2 md:col-span-1">
                            <label class="block text-xs font-bold uppercase text-gray-500 mb-2 ml-1">Nama Lengkap <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" class="w-full px-5 py-3 bg-gray-50 border-2 border-transparent focus:border-[#1B4D3E] focus:bg-white rounded-xl outline-none transition-all font-bold text-gray-700 placeholder-gray-300" placeholder="Sesuai Akta Kelahiran" required>
                        </div>
                        <div class="col-span-2 md:col-span-1">
                            <label class="block text-xs font-bold uppercase text-gray-500 mb-2 ml-1">NIK (16 Digit) <span class="text-red-500">*</span></label>
                            <input type="number" name="nik" value="{{ old('nik') }}" class="w-full px-5 py-3 bg-gray-50 border-2 border-transparent focus:border-[#1B4D3E] focus:bg-white rounded-xl outline-none transition-all font-bold text-gray-700 placeholder-gray-300" placeholder="Nomor Induk Kependudukan" required>
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase text-gray-500 mb-2 ml-1">Tempat Lahir <span class="text-red-500">*</span></label>
                            <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}" class="w-full px-5 py-3 bg-gray-50 border-2 border-transparent focus:border-[#1B4D3E] focus:bg-white rounded-xl outline-none transition-all font-bold text-gray-700" required>
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase text-gray-500 mb-2 ml-1">Tanggal Lahir <span class="text-red-500">*</span></label>
                            <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" class="w-full px-5 py-3 bg-gray-50 border-2 border-transparent focus:border-[#1B4D3E] focus:bg-white rounded-xl outline-none transition-all font-bold text-gray-700" required>
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase text-gray-500 mb-2 ml-1">Jenis Kelamin <span class="text-red-500">*</span></label>
                            <select name="jenis_kelamin" class="w-full px-5 py-3 bg-gray-50 border-2 border-transparent focus:border-[#1B4D3E] focus:bg-white rounded-xl outline-none transition-all font-bold text-gray-700 cursor-pointer" required>
                                <option value="">Pilih...</option>
                                <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase text-gray-500 mb-2 ml-1">Asal Sekolah (TK/RA)</label>
                            <input type="text" name="asal_sekolah" value="{{ old('asal_sekolah') }}" class="w-full px-5 py-3 bg-gray-50 border-2 border-transparent focus:border-[#1B4D3E] focus:bg-white rounded-xl outline-none transition-all font-bold text-gray-700 placeholder-gray-300" placeholder="Nama Sekolah Sebelumnya">
                        </div>
                        <div class="col-span-2">
                            <label class="block text-xs font-bold uppercase text-gray-500 mb-2 ml-1">Alamat Lengkap <span class="text-red-500">*</span></label>
                            <textarea name="alamat_lengkap" rows="3" class="w-full px-5 py-3 bg-gray-50 border-2 border-transparent focus:border-[#1B4D3E] focus:bg-white rounded-xl outline-none transition-all font-bold text-gray-700 placeholder-gray-300" placeholder="Nama Jalan, RT/RW, Kelurahan, Kecamatan" required>{{ old('alamat_lengkap') }}</textarea>
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="flex items-center gap-3 text-lg font-black text-[#1B4D3E] uppercase tracking-wider mb-6 border-b border-gray-100 pb-4">
                        <span class="w-8 h-8 rounded-full bg-[#1B4D3E] text-[#F4D03F] flex items-center justify-center text-sm shadow-md">2</span>
                        Data Orang Tua
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold uppercase text-gray-500 mb-2 ml-1">Nama Ayah <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_ayah" value="{{ old('nama_ayah') }}" class="w-full px-5 py-3 bg-gray-50 border-2 border-transparent focus:border-[#1B4D3E] focus:bg-white rounded-xl outline-none transition-all font-bold text-gray-700" required>
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase text-gray-500 mb-2 ml-1">Nama Ibu <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_ibu" value="{{ old('nama_ibu') }}" class="w-full px-5 py-3 bg-gray-50 border-2 border-transparent focus:border-[#1B4D3E] focus:bg-white rounded-xl outline-none transition-all font-bold text-gray-700" required>
                        </div>
                        <div class="col-span-2">
                            <label class="block text-xs font-bold uppercase text-gray-500 mb-2 ml-1">No. WhatsApp Aktif <span class="text-red-500">*</span></label>
                            <input type="text" name="nomor_hp" value="{{ old('nomor_hp') }}" class="w-full px-5 py-3 bg-gray-50 border-2 border-transparent focus:border-[#1B4D3E] focus:bg-white rounded-xl outline-none transition-all font-bold text-gray-700 placeholder-gray-300" placeholder="0812xxxx" required>
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="flex items-center gap-3 text-lg font-black text-[#1B4D3E] uppercase tracking-wider mb-6 border-b border-gray-100 pb-4">
                        <span class="w-8 h-8 rounded-full bg-[#1B4D3E] text-[#F4D03F] flex items-center justify-center text-sm shadow-md">3</span>
                        Dokumen Persyaratan
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        
                        <div class="bg-yellow-50 border-2 border-dashed border-yellow-200 rounded-2xl p-6 text-center group hover:border-[#1B4D3E] transition-all">
                            <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center mx-auto mb-3 shadow-sm text-2xl group-hover:scale-110 transition-transform">👨‍👩‍👧‍👦</div>
                            <label class="block text-sm font-bold text-[#1B4D3E] mb-2 cursor-pointer">
                                <span class="underline decoration-[#F4D03F] decoration-2">Upload KK</span> <span class="text-red-500">*</span>
                                <input type="file" name="dokumen_kk" accept=".pdf,.jpg,.jpeg,.png" class="hidden" required onchange="document.getElementById('name-kk').innerText = this.files[0].name">
                            </label>
                            <p class="text-[10px] text-gray-500 font-bold uppercase tracking-wider">Max 2MB (JPG/PDF)</p>
                            <p id="name-kk" class="text-xs font-black text-[#1B4D3E] mt-3 truncate"></p>
                        </div>

                        <div class="bg-yellow-50 border-2 border-dashed border-yellow-200 rounded-2xl p-6 text-center group hover:border-[#1B4D3E] transition-all">
                            <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center mx-auto mb-3 shadow-sm text-2xl group-hover:scale-110 transition-transform"></div>
                            <label class="block text-sm font-bold text-[#1B4D3E] mb-2 cursor-pointer">
                                <span class="underline decoration-[#F4D03F] decoration-2">Upload Akta Lahir</span> <span class="text-red-500">*</span>
                                <input type="file" name="dokumen_akta" accept=".pdf,.jpg,.jpeg,.png" class="hidden" required onchange="document.getElementById('name-akta').innerText = this.files[0].name">
                            </label>
                            <p class="text-[10px] text-gray-500 font-bold uppercase tracking-wider">Max 2MB (JPG/PDF)</p>
                            <p id="name-akta" class="text-xs font-black text-[#1B4D3E] mt-3 truncate"></p>
                        </div>

                        <div class="bg-gray-50 border-2 border-dashed border-gray-200 rounded-2xl p-6 text-center group hover:border-[#1B4D3E] transition-all">
                            <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center mx-auto mb-3 shadow-sm text-2xl group-hover:scale-110 transition-transform">🎓</div>
                            <label class="block text-sm font-bold text-gray-500 group-hover:text-[#1B4D3E] mb-2 cursor-pointer transition-colors">
                                <span class="underline decoration-gray-300 group-hover:decoration-[#F4D03F] decoration-2">Upload Ijazah TK</span>
                                <input type="file" name="dokumen_ijazah" accept=".pdf,.jpg,.jpeg,.png" class="hidden" onchange="document.getElementById('name-ijazah').innerText = this.files[0].name">
                            </label>
                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">Opsional (Max 2MB)</p>
                            <p id="name-ijazah" class="text-xs font-black text-[#1B4D3E] mt-3 truncate"></p>
                        </div>

                    </div>
                </div>

                <div class="pt-6">
                    <div class="flex items-start space-x-3 mb-8 bg-gray-50 p-4 rounded-xl border border-gray-100">
                        <input type="checkbox" id="agreement" name="agreement" required class="mt-1 w-5 h-5 rounded border-gray-300 text-[#1B4D3E] focus:ring-[#1B4D3E] cursor-pointer">
                        <label for="agreement" class="text-xs font-medium text-gray-500 leading-relaxed cursor-pointer select-none">
                            Saya menyatakan bahwa seluruh data dan dokumen yang saya unggah adalah benar. Apabila di kemudian hari ditemukan ketidakbenaran, saya bersedia menerima sanksi sesuai ketentuan sekolah.
                        </label>
                    </div>

                    <button type="submit" class="w-full bg-[#1B4D3E] text-white py-4 rounded-xl text-sm font-black uppercase tracking-[0.2em] shadow-lg hover:bg-[#F4D03F] hover:text-[#1B4D3E] transition-all duration-300 transform hover:-translate-y-1">
                        Kirim Pendaftaran
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection