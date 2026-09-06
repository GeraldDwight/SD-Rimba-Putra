<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalonSiswa extends Model
{
    use HasFactory;

    // Nama tabel di database (opsional jika sesuai standar, tapi aman ditulis)
    protected $table = 'calon_siswas';

    // Kolom yang boleh diisi (Harus cocok dengan Migration)
    protected $fillable = [
        'user_id',          // Relasi ke User
        'nama_lengkap',
        'nik',
        'tempat_lahir',     // Tambahan (sesuai form)
        'tanggal_lahir',    // Tambahan (sesuai form)
        'jenis_kelamin',
        'asal_sekolah',
        'alamat',
        'nama_ayah',        // Tambahan (sesuai form)
        'nama_ibu',         // Tambahan (sesuai form)
        'nomor_hp',
        'file_kk',
        'file_akta',
        'file_ijazah',          // Ganti dokumen_kk jadi file_kk (biar sama dgn migration)
        'status'            // menunggu_verifikasi, diterima, ditolak
    ];

    /**
     * Relasi: Data Calon Siswa ini milik satu User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}