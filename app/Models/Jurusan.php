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

}
