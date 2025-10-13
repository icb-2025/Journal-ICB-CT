<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\AktivitasSiswa;
use App\Models\JadwalLibur;
use Carbon\Carbon;

class AutoMarkAlpa extends Command
{
    protected $signature = 'absen:auto-alpa';
    protected $description = 'Otomatis menandai siswa yang tidak absen sebagai Alpa jika status masuk';

    public function handle()
    {
        $today = Carbon::today()->toDateString();
        $hariIni = Carbon::now()->locale('id')->dayName; // Senin, Selasa, dst

        // Ambil semua perusahaan & status liburnya
        $jadwalLibur = JadwalLibur::with('perusahaan')->get();

        foreach ($jadwalLibur as $jadwal) {
            // Cek status hari ini
            $statusHariIni = $this->cekStatusHariIni($jadwal->hari_libur, $hariIni);

            if (strtolower($statusHariIni) === 'masuk') {
                // Cari siswa di perusahaan ini yang tidak punya absen hari ini
                $siswaBelumAbsen = \DB::table('users')
                    ->where('kode_perusahaan', $jadwal->perusahaan->kode_perusahaan)
                    ->whereNotExists(function ($query) use ($today) {
                        $query->select(\DB::raw(1))
                              ->from('aktivitas_siswa')
                              ->whereColumn('siswa_id', 'users.id')
                              ->where('tanggal', $today);
                    })
                    ->get();

                foreach ($siswaBelumAbsen as $siswa) {
                    AktivitasSiswa::create([
                        'siswa_id' => $siswa->id,
                        'perusahaan_id' => $jadwal->perusahaan_id,
                        'tanggal' => $today,
                        'mulai' => '-',
                        'selesai' => '-',
                        'deskripsi' => '-',
                        'kategori_tugas_id' => null,
                        'status' => 'Alpa',
                        'id_jurusan' => $siswa->id_jurusan
                    ]);
                }
            }
        }

        $this->info('Proses auto-alpa selesai.');
    }

    private function cekStatusHariIni($hariLibur, $hariIni)
    {
        $hariList = ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'];
        $parts = explode('-', $hariLibur);
        $mulai = $parts[0];
        $selesai = $parts[1] ?? $parts[0];

        $startIndex = array_search($mulai, $hariList);
        $endIndex   = array_search($selesai, $hariList);

        $range = [];
        if ($startIndex !== false && $endIndex !== false) {
            if ($startIndex <= $endIndex) {
                $range = array_slice($hariList, $startIndex, $endIndex - $startIndex + 1);
            } else {
                $range = array_merge(
                    array_slice($hariList, $startIndex),
                    array_slice($hariList, 0, $endIndex + 1)
                );
            }
        }

        return in_array($hariIni, $range) ? 'Libur' : 'Masuk';
    }
}
