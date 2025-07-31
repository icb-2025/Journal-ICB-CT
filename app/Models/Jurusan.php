<?php

// app/Models/Jurusan.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
  protected $fillable = ['nama_jurusan', 'kode_jurusan'];


  public function jurusan() {
    return $this->belongsTo(Jurusan::class, 'nama_jurusan'); // pastikan relasi ini benar
}
}
