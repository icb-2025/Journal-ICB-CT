<?php

// app/Models/Jurusan.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
  protected $fillable = ['nama_jurusan', 'kode_jurusan'];


public function siswas()
{
    return $this->hasMany(Siswa::class, 'id_jurusan');
}

// app/Models/User.php
public function jurusan()
{
    // Kalau di tabel `users` kolomnya bernama `id_jurusan`
    return $this->belongsTo(Jurusan::class, 'id_jurusan', 'id');
    
    // Kalau di tabel `users` kolomnya `nama_jurusan`, dan itu foreign key ke `jurusan.nama_jurusan`
    // return $this->belongsTo(Jurusan::class, 'nama_jurusan', 'nama_jurusan');
}

}
