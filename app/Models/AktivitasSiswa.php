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
        'kategori_tugas_id',
        'status',
        'id_jurusan'
    ];

    public function perusahaan()
{
    return $this->belongsTo(Perusahaan::class, 'perusahaan_id', 'kode_perusahaan');
}


public function kategoriTugas() {
    return $this->belongsTo(KategoriTugas::class, 'kategori_tugas_id');
}


public function siswa() {
    return $this->belongsTo(Siswa::class, 'siswa_id');
}


}
