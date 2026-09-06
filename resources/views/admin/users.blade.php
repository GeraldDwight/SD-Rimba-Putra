@extends('layouts.dashboard')

@section('title', 'Manajemen User')

@section('content')

@if(session('success'))
<div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-r shadow-sm flex justify-between items-center">
    <span class="font-bold">✅ {{ session('success') }}</span>
    <button onclick="this.parentElement.style.display='none'">&times;</button>
</div>
@endif
@if($errors->any())
<div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-r shadow-sm">
    <ul class="list-disc list-inside text-sm font-bold">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    
    <div class="lg:col-span-1">
        <div class="bg-white rounded-[2rem] p-6 border border-gray-100 shadow-sm sticky top-6">
            <h3 class="text-lg font-black text-[#1B4D3E] uppercase mb-4 border-b pb-2">Tambah User Baru</h3>
            
            <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="text-[10px] font-bold uppercase text-gray-400">Nama Lengkap</label>
                    <input type="text" name="name" required class="w-full px-4 py-2 bg-gray-50 border rounded-xl focus:border-[#1B4D3E] outline-none text-sm font-bold">
                </div>
                <div>
                    <label class="text-[10px] font-bold uppercase text-gray-400">Username</label>
                    <input type="text" name="username" required class="w-full px-4 py-2 bg-gray-50 border rounded-xl focus:border-[#1B4D3E] outline-none text-sm font-bold">
                </div>
                <div>
                    <label class="text-[10px] font-bold uppercase text-gray-400">Email</label>
                    <input type="email" name="email" required class="w-full px-4 py-2 bg-gray-50 border rounded-xl focus:border-[#1B4D3E] outline-none text-sm font-bold">
                </div>
                <div>
                    <label class="text-[10px] font-bold uppercase text-gray-400">Password</label>
                    <input type="password" name="password" required class="w-full px-4 py-2 bg-gray-50 border rounded-xl focus:border-[#1B4D3E] outline-none text-sm font-bold">
                </div>
                <div>
                    <label class="text-[10px] font-bold uppercase text-gray-400">Role (Peran)</label>
                    <select name="role" class="w-full px-4 py-2 bg-gray-50 border rounded-xl focus:border-[#1B4D3E] outline-none text-sm font-bold">
                        <option value="siswa">🎓 Siswa</option>
                        <option value="admin">👑 Admin</option>
                    </select>
                </div>
                <button type="submit" class="w-full bg-[#1B4D3E] text-white py-3 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-[#F4D03F] hover:text-[#1B4D3E] transition-all shadow-lg">
                    + Simpan User
                </button>
            </form>
        </div>
    </div>

    <div class="lg:col-span-2">
        <div class="bg-white rounded-[2rem] p-8 border border-gray-100 shadow-sm">
            <h3 class="text-xl font-black text-[#1B4D3E] uppercase mb-6">Daftar Pengguna ({{ $users->total() }})</h3>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 text-[#1B4D3E] text-xs uppercase font-black tracking-wider">
                            <th class="p-4 rounded-l-xl">User</th>
                            <th class="p-4">Role</th>
                            <th class="p-4 rounded-r-xl text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm font-medium text-gray-600">
                        @foreach($users as $user)
                        <tr class="border-b border-gray-50 hover:bg-gray-50 transition">
                            <td class="p-4">
                                <div class="font-bold text-gray-800">{{ $user->name }}</div>
                                <div class="text-[10px] text-gray-400">{{ $user->email }}</div>
                                <div class="text-[10px] text-gray-400 italic">@ {{ $user->username }}</div>
                            </td>
                            <td class="p-4">
                                @if($user->role == 'admin')
                                    <span class="bg-[#1B4D3E] text-white px-3 py-1 rounded-full text-[10px] font-black uppercase">Admin</span>
                                @else
                                    <span class="bg-gray-100 text-gray-500 px-3 py-1 rounded-full text-[10px] font-black uppercase">Siswa</span>
                                @endif
                            </td>
                            <td class="p-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button onclick="openEditModal('{{ $user->id }}', '{{ $user->name }}', '{{ $user->email }}', '{{ $user->role }}')" class="bg-blue-50 text-blue-600 hover:bg-blue-500 hover:text-white p-2 rounded-lg transition-all" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </button>

                                    @if($user->id != auth()->id()) 
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus user ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-50 text-red-500 hover:bg-red-500 hover:text-white p-2 rounded-lg transition-all" title="Hapus">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-6">{{ $users->links() }}</div>
        </div>
    </div>
</div>

<div id="editModal" class="fixed inset-0 bg-black/50 z-50 hidden flex items-center justify-center backdrop-blur-sm">
    <div class="bg-white rounded-[2rem] p-8 w-full max-w-md shadow-2xl relative animate-fade-in-up">
        <button onclick="document.getElementById('editModal').classList.add('hidden')" class="absolute top-4 right-4 text-gray-400 hover:text-red-500 font-bold text-xl">&times;</button>
        
        <h3 class="text-xl font-black text-[#1B4D3E] uppercase mb-6">Edit User</h3>
        
        <form id="editForm" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            
            <div>
                <label class="text-[10px] font-bold uppercase text-gray-400">Nama Lengkap</label>
                <input type="text" id="editName" name="name" required class="w-full px-4 py-2 bg-gray-50 border rounded-xl focus:border-[#1B4D3E] outline-none text-sm font-bold">
            </div>
            <div>
                <label class="text-[10px] font-bold uppercase text-gray-400">Email</label>
                <input type="email" id="editEmail" name="email" required class="w-full px-4 py-2 bg-gray-50 border rounded-xl focus:border-[#1B4D3E] outline-none text-sm font-bold">
            </div>
            <div>
                <label class="text-[10px] font-bold uppercase text-gray-400">Role</label>
                <select name="role" id="editRole" class="w-full px-4 py-2 bg-gray-50 border rounded-xl focus:border-[#1B4D3E] outline-none text-sm font-bold">
                    <option value="siswa">🎓 Siswa</option>
                    <option value="admin">👑 Admin</option>
                </select>
            </div>
            <div>
                <label class="text-[10px] font-bold uppercase text-gray-400">Password Baru (Opsional)</label>
                <input type="password" name="password" placeholder="Kosongkan jika tidak diubah" class="w-full px-4 py-2 bg-gray-50 border rounded-xl focus:border-[#1B4D3E] outline-none text-sm font-bold placeholder-gray-300">
            </div>
            
            <button type="submit" class="w-full bg-[#1B4D3E] text-white py-3 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-[#F4D03F] hover:text-[#1B4D3E] transition-all shadow-lg mt-4">
                Simpan Perubahan
            </button>
        </form>
    </div>
</div>

<script>
    function openEditModal(id, name, email, role) {
        // Isi form dengan data user
        document.getElementById('editName').value = name;
        document.getElementById('editEmail').value = email;
        document.getElementById('editRole').value = role;
        
        // Set action form ke URL update yang benar
        let url = "{{ route('admin.users.update', ':id') }}";
        url = url.replace(':id', id);
        document.getElementById('editForm').action = url;
        
        // Tampilkan modal
        document.getElementById('editModal').classList.remove('hidden');
    }
</script>

@endsection