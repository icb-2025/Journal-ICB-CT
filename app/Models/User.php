<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'kode_perusahaan',
        'input_by',
        'input_date',
        'nama_jurusan',
        'nisn'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class, 'kode_perusahaan', 'kode_perusahaan');
    }

    public function inputBy()
    {
        return $this->belongsTo(User::class, 'input_by');
    }

    // Relasi ke tabel siswa
    public function siswa()
    {
        return $this->hasOne(Siswa::class, 'nis', 'nisn'); 
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'nama_jurusan', 'nama_jurusan');
    }
}
