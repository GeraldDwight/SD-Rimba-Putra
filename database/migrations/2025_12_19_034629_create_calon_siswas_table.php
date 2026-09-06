<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // PERUBAHAN 1: Nama tabel diganti jadi 'calon_siswas'
        // Agar cocok dengan Model CalonSiswa.php
        Schema::create('calon_siswas', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke User
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // Data Pribadi (LENGKAP SESUAI FORMULIR)
            $table->string('nama_lengkap');
            $table->string('nik', 16);
            $table->string('tempat_lahir'); // Tambahan (ada di form)
            $table->date('tanggal_lahir');  // Tambahan (ada di form)
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('asal_sekolah');
            $table->text('alamat');
            
            // Data Orang Tua (LENGKAP SESUAI FORMULIR)
            $table->string('nama_ayah'); // Tambahan (ada di form)
            $table->string('nama_ibu');
            $table->string('nomor_hp');
            
            // Dokumen & Status
            // PERUBAHAN 2: Nama kolom disamakan dengan Controller ('file_kk')
            $table->string('file_kk')->nullable(); 
            $table->string('file_akta')->nullable(); // Tambahan Akta
            $table->string('file_ijazah')->nullable(); // Tambahan Ijazah
            $table->enum('status', ['menunggu_verifikasi', 'diterima', 'ditolak'])->default('menunggu_verifikasi');
            
            $table->timestamps(); 
        });
    }

    public function down(): void
    {
        // Jangan lupa ubah ini juga biar kalau rollback tidak error
        Schema::dropIfExists('calon_siswas');
    }
};