<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\SchoolProfile;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Akun ADMIN (Simpan ke variabel $admin)
        $admin = User::firstOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'Administrator Sekolah',
                'email' => 'admin@rimbaputra.sch.id',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        // 2. Buat Akun SISWA
        User::firstOrCreate(
            ['username' => 'budi'],
            [
                'name' => 'Budi Santoso',
                'email' => 'budi@gmail.com',
                'password' => Hash::make('budi123'),
                'role' => 'siswa',
            ]
        );

        // 3. Buat Profil Sekolah (Tambahkan user_id)
        if (SchoolProfile::count() == 0) {
            SchoolProfile::create([
                'user_id' => $admin->id, // <--- INI KUNCI AGAR TIDAK ERROR 1364
                'yayasan_nama' => 'DR. Retno Maryani Ruwanda, M.Sc.',
                'yayasan_sambutan' => 'Yayasan berkomitmen penuh menyediakan sarana terbaik.',
                'kepsek_nama' => 'Ibu Amelia Putri, S.Pd., M.Pd.',
                'kepsek_nip' => 'NIP. 19850310 201001 2 015',
                'kepsek_sambutan' => 'Selamat datang di SD Rimba Putra.',
                'visi' => 'Mewujudkan generasi yang unggul dalam IPTEK dan IMTAQ.',
                'misi' => "Menyelenggarakan pendidikan berkualitas.\nMengembangkan potensi bakat siswa."
            ]);
        }
    }
}