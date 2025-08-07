<?php

namespace App\Http\Controllers\Superuser;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $timeRange = $request->input('time_range', 'week');
        
        if ($timeRange === 'week') {
            return $this->weeklyReport();
        } elseif ($timeRange === 'month') {
            return $this->monthlyReport();
        } else {
            return $this->yearlyReport();
        }
    }

    private function weeklyReport()
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
        ];

        foreach ($jurusans as $jurusan) {
            $dataPerHari = [];

            foreach ($dayMap as $en => $weekdayNumber) {
                $jumlahHadir = DB::table('aktivitas_siswas')
                    ->where('aktivitas_siswas.id_jurusan', $jurusan->id)
                    ->whereRaw("LOWER(aktivitas_siswas.status) = 'masuk'")
                    ->whereRaw("WEEKDAY(aktivitas_siswas.tanggal) = ?", [$weekdayNumber])
                    ->whereBetween('aktivitas_siswas.tanggal', [
                        Carbon::now()->startOfWeek(),
                        Carbon::now()->endOfWeek()
                    ])
                    ->count();

                $dataPerHari[] = $jumlahHadir;
            }

            $color = $warnaJurusan[$jurusan->nama_jurusan] ?? $this->generateRandomColor();

            $datasets[] = [
                'label' => $jurusan->nama_jurusan,
                'data' => $dataPerHari,
                'fill' => false,
                'borderColor' => $color,
                'backgroundColor' => $color,
                'pointBackgroundColor' => $color,
                'pointBorderColor' => $color,
                'tension' => 0.3,
                'borderWidth' => 2,
            ];
        }

        return view('superuser.dashboard', [
            'labels' => $labels,
            'datasets' => $datasets,
            'time_range' => 'week'
        ]);
    }

    private function monthlyReport()
    {
        // Buat label untuk minggu dalam bulan
        $labels = ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4'];

        // Ambil semua jurusan
        $jurusans = Jurusan::all();

        $datasets = [];

        $warnaJurusan = [
            'Rekayasa Perangkat Lunak' => '#FF6384',
            'Teknik Komputer Jaringan' => '#36A2EB',
            'Otomotif' => '#FFCE56',
            'Farmasi' => '#4BC0C0',
            'Keperawatan' => '#9966FF',
        ];

        foreach ($jurusans as $jurusan) {
            $dataPerMinggu = [];

            for ($week = 1; $week <= 4; $week++) {
                $startDate = Carbon::now()->startOfMonth()->addWeeks($week - 1);
                $endDate = $startDate->copy()->endOfWeek();

                $jumlahHadir = DB::table('aktivitas_siswas')
                    ->where('aktivitas_siswas.id_jurusan', $jurusan->id)
                    ->whereRaw("LOWER(aktivitas_siswas.status) = 'masuk'")
                    ->whereBetween('aktivitas_siswas.tanggal', [$startDate, $endDate])
                    ->count();

                $dataPerMinggu[] = $jumlahHadir;
            }

            $color = $warnaJurusan[$jurusan->nama_jurusan] ?? $this->generateRandomColor();

            $datasets[] = [
                'label' => $jurusan->nama_jurusan,
                'data' => $dataPerMinggu,
                'fill' => false,
                'borderColor' => $color,
                'backgroundColor' => $color,
                'pointBackgroundColor' => $color,
                'pointBorderColor' => $color,
                'tension' => 0.3,
                'borderWidth' => 2,
            ];
        }

        return view('superuser.dashboard', [
            'labels' => $labels,
            'datasets' => $datasets,
            'time_range' => 'month'
        ]);
    }

    private function yearlyReport()
    {
        // Label bulan
        $labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];

        // Ambil semua jurusan
        $jurusans = Jurusan::all();

        $datasets = [];

        $warnaJurusan = [
            'Rekayasa Perangkat Lunak' => '#FF6384',
            'Teknik Komputer Jaringan' => '#36A2EB',
            'Otomotif' => '#FFCE56',
            'Farmasi' => '#4BC0C0',
            'Keperawatan' => '#9966FF',
        ];

        foreach ($jurusans as $jurusan) {
            $dataPerBulan = [];

            for ($month = 1; $month <= 12; $month++) {
                $startDate = Carbon::now()->startOfYear()->month($month)->startOfMonth();
                $endDate = $startDate->copy()->endOfMonth();

                $jumlahHadir = DB::table('aktivitas_siswas')
                    ->where('aktivitas_siswas.id_jurusan', $jurusan->id)
                    ->whereRaw("LOWER(aktivitas_siswas.status) = 'masuk'")
                    ->whereBetween('aktivitas_siswas.tanggal', [$startDate, $endDate])
                    ->count();

                $dataPerBulan[] = $jumlahHadir;
            }

            $color = $warnaJurusan[$jurusan->nama_jurusan] ?? $this->generateRandomColor();

            $datasets[] = [
                'label' => $jurusan->nama_jurusan,
                'data' => $dataPerBulan,
                'fill' => false,
                'borderColor' => $color,
                'backgroundColor' => $color,
                'pointBackgroundColor' => $color,
                'pointBorderColor' => $color,
                'tension' => 0.3,
                'borderWidth' => 2,
            ];
        }

        return view('superuser.dashboard', [
            'labels' => $labels,
            'datasets' => $datasets,
            'time_range' => 'year'
        ]);
    }

    private function generateRandomColor()
    {
        return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
    }
}