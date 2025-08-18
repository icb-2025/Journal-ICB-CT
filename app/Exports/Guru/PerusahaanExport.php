<?php

namespace App\Exports\Guru;

use App\Models\Perusahaan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PerusahaanExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Perusahaan::with('user')->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Kode Perusahaan',
            'Nama Industri', 
            'Bidang Usaha',
            'Alamat',
            'No Telepon',
            'Nama Direktur',
            'Nama Pembimbing',
            'Input Oleh',
            'Tanggal Input'
        ];
    }

    public function map($perusahaan): array
    {
        static $i = 1;
        return [
            $i++,
            $perusahaan->kode_perusahaan,
            $perusahaan->nama_industri,
            $perusahaan->bidang_usaha,
            $perusahaan->alamat,
            $perusahaan->no_telepon,
            $perusahaan->nama_direktur,
            $perusahaan->nama_pembimbing,
            $perusahaan->user->name ?? 'System',
            $perusahaan->created_at->format('d/m/Y H:i')
        ];
    }
}