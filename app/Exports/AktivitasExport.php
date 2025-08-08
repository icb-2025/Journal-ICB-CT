<?php

namespace App\Exports;

use App\Models\Aktivitas; // Pastikan model Aktivitas ada
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AktivitasExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Aktivitas::with(['siswa', 'perusahaan', 'kategoriTugas'])->get();
    }
    
    public function headings(): array
    {
        return [
            'No',
            'Nama Siswa',
            'Perusahaan',
            'Tanggal',
            'Jam Mulai',
            'Jam Selesai',
            'Kegiatan',
            'Kategori Tugas',
            'id_jurusan',
            'status',
        ];
    }
    
    public function map($aktivitas): array
    {
        return [
            $aktivitas->id,
            $aktivitas->siswa->name ?? '-',
            $aktivitas->perusahaan->nama_industri ?? '-',
            $aktivitas->tanggal,
            $aktivitas->mulai,
            $aktivitas->selesai,
            $aktivitas->deskripsi,
            $aktivitas->kategoriTugas->nama_kategori ?? '-',
            $aktivitas->id_jurusan,
            $aktivitas->status
        ];
    }
}