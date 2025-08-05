<?php

namespace App\Http\Controllers\Superuser;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Jurusan;

class DashboardController extends Controller
{
    public function index()
    {
        // Hari kerja Senin - Jumat
        $hariUrut = [
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat'
        ];

        $labels = array_values($hariUrut);

        // Mapping hari ke WEEKDAY() MySQL (0=Senin, ..., 4=Jumat)
        $dayMap = ['Monday'=>0, 'Tuesday'=>1, 'Wednesday'=>2, 'Thursday'=>3, 'Friday'=>4];

        // Ambil semua jurusan
        $jurusans = Jurusan::all();

        $datasets = [];

        $warnaJurusan = [
    'Rekayasa Perangkat Lunak' => '#FF6384',
    'Teknik Komputer Jaringan' => '#36A2EB',
    'Otomotif' => '#FFCE56',
    'Farmasi' => '#4BC0C0',
    'Keperawatan' => '#9966FF',
    // tambahkan sesuai nama jurusan lain yang ada di DB
];


foreach ($jurusans as $jurusan) {
    $dataPerHari = [];

    foreach ($dayMap as $en => $weekdayNumber) {
        $jumlahHadir = DB::table('aktivitas_siswas')
            ->where('aktivitas_siswas.id_jurusan', $jurusan->id)
            ->whereRaw("LOWER(aktivitas_siswas.status) = 'masuk'")
            ->whereRaw("WEEKDAY(aktivitas_siswas.tanggal) = ?", [$weekdayNumber])
            ->count();

        $dataPerHari[] = $jumlahHadir;
    }

    $color = $warnaJurusan[$jurusan->nama_jurusan] ?? '#0e0e0eff';

    $datasets[] = [
    'label' => $jurusan->nama_jurusan,
    'data' => $dataPerHari,
    'fill' => false,
    'borderColor' => $color,
    'backgroundColor' => $color,
    'pointBackgroundColor' => $color,
    'pointBorderColor' => $color,
    'tension' => 0.3,
    'borderWidth' => 2, // Tambahkan ini!
];


}

        

        return view('superuser.dashboard', [
            'labels' => $labels,
            'datasets' => $datasets,
        ]);
    }

    private function generateRandomColor()
    {
        return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
    }
}
