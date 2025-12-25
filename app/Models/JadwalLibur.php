<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalLibur extends Model
{
    protected $table = 'jadwal_libur';
    protected $fillable = ['perusahaan_id', 'hari_libur', 'status'];

public function perusahaan()
{
    return $this->belongsTo(Perusahaan::class, 'perusahaan_id', 'kode_perusahaan');
}


}
