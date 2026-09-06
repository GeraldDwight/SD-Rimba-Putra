<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eskul extends Model
{
    use HasFactory;

    // TAMBAHKAN BARIS INI (PENTING!)
    // Ini artinya: "Tidak ada kolom yang dijaga, silakan isi semuanya"
    protected $guarded = []; 
}