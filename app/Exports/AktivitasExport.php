<?php

namespace App\Exports;

use App\Models\Aktivitas;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;

class AktivitasExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        // Eager load relasi siswa->jurusan agar bisa akses nama jurusan
        return Aktivitas::with(['siswa.jurusan', 'perusahaan', 'kategoriTugas'])->get();
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
            'Jurusan',
            'Status',
        ];
    }
    
    public function map($aktivitas_siswas): array
    {
        return [
            $aktivitas_siswas->id,
            $aktivitas_siswas->siswa->nama_lengkap ?? '-',
            $aktivitas_siswas->perusahaan->nama_industri ?? '-',
            Carbon::parse($aktivitas_siswas->tanggal)->format('d/m/Y'),
            Carbon::parse($aktivitas_siswas->mulai)->format('H:i'),
            Carbon::parse($aktivitas_siswas->selesai)->format('H:i'),
            $aktivitas_siswas->deskripsi ?? '-',
            $aktivitas_siswas->kategoriTugas->nama_kategori ?? '-',
            $aktivitas_siswas->siswa->jurusan->nama_jurusan ?? '-',
            $aktivitas_siswas->status ?? '-',
        ];
    }

}
