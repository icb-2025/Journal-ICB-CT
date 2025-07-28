<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aktivitas extends Model
{
    use HasFactory;

    // Tambahkan ini untuk menentukan nama tabel secara eksplisit
    protected $table = 'aktivitas_siswas';

    protected $fillable = [
        'siswa_id',
        'perusahaan_id', 
        'kategori_tugas_id',
        'tanggal',
        'mulai',
        'selesai',
        'deskripsi'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class);
    }

    public function kategoriTugas()
    {
        return $this->belongsTo(KategoriTugas::class, 'kategori_tugas_id');
    }
}