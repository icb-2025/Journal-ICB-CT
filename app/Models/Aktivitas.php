<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aktivitas extends Model
{
    use HasFactory;

    protected $table = 'aktivitas_siswas';

    protected $fillable = [
    'siswa_id',
    'perusahaan_id', 
    'kategori_tugas_id',
    'id_jurusan',
    'tanggal',
    'mulai',
    'selesai',
    'deskripsi'
    ];


    public function siswa() {
    return $this->belongsTo(User::class, 'siswa_id'); 
}

    public function perusahaan()
{
    return $this->belongsTo(Perusahaan::class, 'perusahaan_id', 'id');
}


    public function kategoriTugas()
    {
        return $this->belongsTo(KategoriTugas::class, 'kategori_tugas_id');
    }
    
}