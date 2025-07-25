<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AktivitasSiswa extends Model
{
    protected $fillable = [
        'siswa_id',
        'perusahaan_id',
        'tanggal',
        'mulai',
        'selesai',
        'deskripsi',
        'kategori_tugas_id'   
    ];

    public function perusahaan() {
    return $this->belongsTo(Perusahaan::class, 'perusahaan_id');
}

public function kategoriTugas() {
    return $this->belongsTo(KategoriTugas::class, 'kategori_tugas_id');
}


public function siswa() {
    return $this->belongsTo(User::class, 'siswa_id'); // pastikan relasi ini benar
}

}
