<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';

    protected $fillable = [
        'nama_lengkap',
        'nis',
        'tempat_lahir',
        'tanggal_lahir',
        'gol_darah',
        'sekolah',
        'alamat_sekolah',
        'telepon_sekolah',
        'nama_wali',
        'alamat_wali',
        'telepon_wali',
        'input_by',
        'kode_perusahaan', 
    ];

    public function guru()
    {
        return $this->belongsTo(User::class, 'input_by');
    }
    public function inputBy()
{
    return $this->belongsTo(User::class, 'input_by');
}

}
