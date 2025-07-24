<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;

class SiswaExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    protected $query;

    public function __construct($query)
    {
        $this->query = $query;
    }

    public function query()
    {
        return $this->query;
    }

    public function headings(): array
    {
        return [
            'Nama Lengkap',
            'NIS',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Golongan Darah',
            'Sekolah',
            'Nama Wali'
        ];
    }

    public function map($siswa): array
    {
        return [
            $siswa->nama_lengkap,
            $siswa->nis,
            $siswa->tempat_lahir,
            $this->formatTanggal($siswa->tanggal_lahir),
            $siswa->gol_darah,
            $siswa->sekolah,
            $siswa->nama_wali
        ];
    }

    protected function formatTanggal($date)
    {
        try {
            return Carbon::parse($date)->format('d/m/Y');
        } catch (\Exception $e) {
            return $date; // Fallback ke nilai asli jika parsing gagal
        }
    }
}