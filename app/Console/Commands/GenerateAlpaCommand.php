<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Siswa;
use App\Models\AktivitasSiswa;
use App\Models\JadwalLibur;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Perusahaan;

class GenerateAlpaCommand extends Command
{
    protected $signature = 'absen:generate-alpa';
    protected $description = 'Generate data ALPA otomatis untuk siswa yang tidak mengisi absen hari ini';

    public function handle()
    {
        $today = Carbon::today()->format('Y-m-d');

        // Ambil semua siswa yang punya kode_perusahaan, NIS, dan ada di users
        

$siswaList = User::with('perusahaan')
    ->whereNotNull('nisn')             // pastikan punya NISN
    ->whereNotNull('kode_perusahaan')  // pastikan punya perusahaan
    ->where('role', 'siswa')           // optional: pastikan role siswa jika ada
    ->get();






        foreach ($siswaList as $siswa) {
            // Cek apakah hari ini libur untuk perusahaan siswa ini
            $libur = JadwalLibur::where('perusahaan_id', $siswa->perusahaan?->id)
                        ->whereDate('hari_libur', $today)
                        ->exists();

            if ($libur) {
                continue;
            }

            // Cek apakah siswa sudah absen
            $sudahAbsen = AktivitasSiswa::where('siswa_id', $siswa->id)
                        ->whereDate('tanggal', $today)
                        ->exists();

            if (!$sudahAbsen) {
                $perusahaan = $siswa->perusahaan;

                AktivitasSiswa::create([
                    'siswa_id'       => $siswa->id,
                    'perusahaan_id'  => $perusahaan?->id,
                    'tanggal'        => $today,
                    'status'         => 'alpa',
                    'mulai'          => '06:00:00',
                    'selesai'        => '21:00:00',
                    'deskripsi'      => 'Tidak hadir',
                    'kategori_tugas_id' => null,
                    'id_jurusan'     => $siswa->id_jurusan,
                ]);
            }
        }

        $this->info('Proses generate ALPA selesai.');
    }
}
