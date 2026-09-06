<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Tabel Utama Pengguna (Admin & Siswa)
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            
            // [PENTING] Kolom username untuk login (bisa diisi NIK Siswa atau 'admin')
            $table->string('username')->unique(); 
            
            // Email dibuat nullable (boleh kosong) karena siswa SD mungkin belum punya email
            $table->string('email')->nullable(); 
            
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            
            // Pembeda hak akses: Admin vs Siswa
            $table->enum('role', ['admin', 'siswa'])->default('siswa'); 
            
            $table->rememberToken();
            $table->timestamps();
        });

        // 2. Tabel Token Reset Password (Bawaan Laravel)
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // 3. Tabel Manajemen Sesi (Bawaan Laravel)
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};