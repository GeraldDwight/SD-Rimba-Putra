<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
    'judul', 
    'slug', 
    'konten', 
    'gambar', 
    'kategori', 
    'user_id']; // <--- Pastikan ini user_id, bukan penulis
}