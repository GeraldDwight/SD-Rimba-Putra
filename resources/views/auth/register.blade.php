<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - SD Rimba Putra</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen p-6">

    <div class="w-full max-w-lg bg-white rounded-[2.5rem] shadow-2xl overflow-hidden border border-gray-100 p-8 md:p-10">
        
        <div class="text-center mb-8">
            <h2 class="text-2xl font-black text-[#1B4D3E] uppercase mb-1">Daftar Akun</h2>
            <p class="text-gray-400 text-xs font-bold uppercase tracking-wider">Silakan isi data diri Anda</p>
        </div>

        @if ($errors->any())
        <div class="mb-6 bg-red-50 text-red-700 p-4 rounded-xl text-xs font-bold">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('register.post') }}" method="POST" class="space-y-4">
            @csrf
            
            <input type="text" name="name" class="w-full px-5 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:border-[#1B4D3E] outline-none font-bold text-gray-800 text-sm" placeholder="Nama Lengkap" required>
            
            <input type="text" name="username" class="w-full px-5 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:border-[#1B4D3E] outline-none font-bold text-gray-800 text-sm" placeholder="Username (Tanpa Spasi)" required>
            
            <input type="email" name="email" class="w-full px-5 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:border-[#1B4D3E] outline-none font-bold text-gray-800 text-sm" placeholder="Alamat Email" required>
            
            <div class="grid grid-cols-2 gap-4">
                <input type="password" name="password" class="w-full px-5 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:border-[#1B4D3E] outline-none font-bold text-gray-800 text-sm" placeholder="Password" required>
                <input type="password" name="password_confirmation" class="w-full px-5 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:border-[#1B4D3E] outline-none font-bold text-gray-800 text-sm" placeholder="Ulangi Pass" required>
            </div>

            <button type="submit" class="w-full bg-[#1B4D3E] text-white py-4 rounded-xl text-sm font-black uppercase tracking-widest shadow-xl hover:bg-[#F4D03F] hover:text-[#1B4D3E] transition-all mt-4">
                Daftar Sekarang
            </button>
        </form>

        <div class="mt-6 text-center">
            <a href="{{ route('login') }}" class="text-xs font-bold text-gray-400 hover:text-[#1B4D3E]">← Sudah punya akun? Login</a>
        </div>
    </div>

</body>
</html>