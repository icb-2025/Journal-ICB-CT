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
        return $this->query->with('jurusan');
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Lengkap',
            'NIS',
            'Tempat, Tanggal Lahir',
            'Golongan Darah',
            'Sekolah',
            'Jurusan',
            'Alamat Sekolah',
            'Nomor Telepon/Faximile',
            'Nama Orang Tua/Wali',
            'Alamat Orang Tua/Wali',
            'No Telepon Orang Tua/Wali',
        ];
    }

    public function map($siswa): array
    {
        return [
            $siswa->id,
            $siswa->nama_lengkap ?? '-',
            $siswa->nis ?? '-',
            ($siswa->tempat_lahir ?? '-') . ', ' . $this->formatTanggal($siswa->tanggal_lahir),
            $siswa->gol_darah ?? '-',
            $siswa->sekolah ?? '-',
            $siswa->jurusan->nama_jurusan ?? '-',
            $siswa->alamat_sekolah ?? '-',
            $siswa->telepon_sekolah ?? '-',
            $siswa->nama_wali ?? '-',
            $siswa->alamat_wali ?? '-',
            $siswa->telepon_wali ?? '-',
        ];
    }

    protected function formatTanggal($date)
    {
        try {
            return $date ? Carbon::parse($date)->format('d/m/Y') : '-';
        } catch (\Exception $e) {
            return $date ?? '-';
        }
    }
}
