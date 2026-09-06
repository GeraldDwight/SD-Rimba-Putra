<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'user_id', 
        'judul', 
        'file_path', 
        'tipe'
    ];

    // Relasi balik ke User (Opsional tapi disarankan)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}