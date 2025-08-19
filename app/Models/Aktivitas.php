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
    'id_jurusan', // tambahkan ini
    'tanggal',
    'mulai',
    'selesai',
    'deskripsi'
    ];


    public function siswa() {
    return $this->belongsTo(User::class, 'siswa_id'); // pastikan relasi ini benar
}

    public function perusahaan()
{
    // Jika kolom di aktivitas_siswas bernama 'perusahaan_id' dan PK perusahaan 'id'
    return $this->belongsTo(Perusahaan::class, 'perusahaan_id', 'id');

    // Jika kolom di aktivitas_siswas bernama 'kode_perusahaan' dan PK perusahaan 'kode_perusahaan'
    // return $this->belongsTo(Perusahaan::class, 'kode_perusahaan', 'kode_perusahaan');
}


    public function kategoriTugas()
    {
        return $this->belongsTo(KategoriTugas::class, 'kategori_tugas_id');
    }
    
}