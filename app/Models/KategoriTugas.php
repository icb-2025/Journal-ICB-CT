<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriTugas extends Model
{
    use HasFactory;

    protected $table = 'kategori_tugas';

    protected $fillable = ['nama_kategori', 'deskripsi'];
}

