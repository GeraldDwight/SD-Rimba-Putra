<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username', // Pastikan ini ada sesuai migrasi terakhir
        'email',
        'password',
        'role',     // admin atau siswa
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];
    
    /**
     * Relasi: User (Siswa) memiliki satu data Pendaftaran (CalonSiswa)
     * Ini penting agar di DashboardController kita bisa panggil: Auth::user()->calonSiswa
     */
    public function calonSiswa()
    {
        return $this->hasOne(CalonSiswa::class);
    }
}