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
}
