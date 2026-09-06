<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('school_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            // IDENTITAS KETUA YAYASAN
            $table->string('yayasan_nama')->nullable();
            $table->string('yayasan_foto')->nullable(); // Menyimpan path gambar
            $table->text('yayasan_sambutan')->nullable();

            // IDENTITAS KEPALA SEKOLAH
            $table->string('kepsek_nama')->nullable();
            $table->string('kepsek_nip')->nullable();
            $table->string('kepsek_foto')->nullable(); // Menyimpan path gambar
            $table->text('kepsek_sambutan')->nullable();

            // VISI & MISI
            $table->text('visi')->nullable();
            $table->text('misi')->nullable(); // Disimpan sebagai text panjang

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('school_profiles');
    }
};