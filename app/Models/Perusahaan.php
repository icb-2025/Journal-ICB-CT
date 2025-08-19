<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
class Perusahaan extends Model
{
    use HasFactory;
    protected $table = 'perusahaans';
    protected $primaryKey = 'kode_perusahaan'; // ✅ kasih tau Laravel
    public $incrementing = false;              // ✅ karena bukan integer auto increment
    protected $keyType = 'string';

    protected $fillable = [
        'kode_perusahaan',
        'nama_industri',
        'bidang_usaha',
        'alamat',
        'no_telepon',
        'nama_direktur',
        'nama_pembimbing',
        'input_by',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'input_by');
    }
    public function getKodeUnikAttribute()
{
    return Str::afterLast($this->kode_perusahaan, '-');
}
}

