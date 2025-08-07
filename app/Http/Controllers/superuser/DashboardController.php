<?php

namespace App\Http\Controllers\Superuser;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Events\AktivitasSiswaUpdated;
class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $timeRange = $request->input('time_range', 'week');
        
        if ($request->ajax()) {
            return $this->getReportData($timeRange);
        }
        
        return view('superuser.dashboard', $this->getReportData($timeRange));
    }

    public function getReportData($timeRange)
    {
        switch($timeRange) {
            case 'month':
                return $this->monthlyReport();
            case 'year':
                return $this->yearlyReport();
            default:
                return $this->weeklyReport();
        }
    }

    private function weeklyReport()
    {
        $hariUrut = [
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat'
        ];

        $labels = array_values($hariUrut);
        $dayMap = ['Monday'=>0, 'Tuesday'=>1, 'Wednesday'=>2, 'Thursday'=>3, 'Friday'=>4];
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
                $dataPerHari[] = DB::table('aktivitas_siswas')
                    ->where('id_jurusan', $jurusan->id)
                    ->whereRaw("LOWER(status) = 'masuk'")
                    ->whereRaw("WEEKDAY(tanggal) = ?", [$weekdayNumber])
                    ->whereBetween('tanggal', [
                        Carbon::now()->startOfWeek(),
                        Carbon::now()->endOfWeek()
                    ])
                    ->count();
            }

            $datasets[] = [
                'label' => $jurusan->nama_jurusan,
                'data' => $dataPerHari,
                'fill' => false,
                'borderColor' => $warnaJurusan[$jurusan->nama_jurusan] ?? $this->generateRandomColor(),
                'backgroundColor' => $warnaJurusan[$jurusan->nama_jurusan] ?? $this->generateRandomColor(),
                'pointBackgroundColor' => $warnaJurusan[$jurusan->nama_jurusan] ?? $this->generateRandomColor(),
                'pointBorderColor' => $warnaJurusan[$jurusan->nama_jurusan] ?? $this->generateRandomColor(),
                'tension' => 0.3,
                'borderWidth' => 2,
            ];
        }

        return [
            'labels' => $labels,
            'datasets' => $datasets,
            'time_range' => 'week'
        ];
    }

    private function monthlyReport()
    {
        $labels = ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4'];
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

                $dataPerMinggu[] = DB::table('aktivitas_siswas')
                    ->where('id_jurusan', $jurusan->id)
                    ->whereRaw("LOWER(status) = 'masuk'")
                    ->whereBetween('tanggal', [$startDate, $endDate])
                    ->count();
            }

            $datasets[] = [
                'label' => $jurusan->nama_jurusan,
                'data' => $dataPerMinggu,
                'fill' => false,
                'borderColor' => $warnaJurusan[$jurusan->nama_jurusan] ?? $this->generateRandomColor(),
                'backgroundColor' => $warnaJurusan[$jurusan->nama_jurusan] ?? $this->generateRandomColor(),
                'pointBackgroundColor' => $warnaJurusan[$jurusan->nama_jurusan] ?? $this->generateRandomColor(),
                'pointBorderColor' => $warnaJurusan[$jurusan->nama_jurusan] ?? $this->generateRandomColor(),
                'tension' => 0.3,
                'borderWidth' => 2,
            ];
        }

        return [
            'labels' => $labels,
            'datasets' => $datasets,
            'time_range' => 'month'
        ];
    }

    private function yearlyReport()
    {
        $labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];
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

                $dataPerBulan[] = DB::table('aktivitas_siswas')
                    ->where('id_jurusan', $jurusan->id)
                    ->whereRaw("LOWER(status) = 'masuk'")
                    ->whereBetween('tanggal', [$startDate, $endDate])
                    ->count();
            }

            $datasets[] = [
                'label' => $jurusan->nama_jurusan,
                'data' => $dataPerBulan,
                'fill' => false,
                'borderColor' => $warnaJurusan[$jurusan->nama_jurusan] ?? $this->generateRandomColor(),
                'backgroundColor' => $warnaJurusan[$jurusan->nama_jurusan] ?? $this->generateRandomColor(),
                'pointBackgroundColor' => $warnaJurusan[$jurusan->nama_jurusan] ?? $this->generateRandomColor(),
                'pointBorderColor' => $warnaJurusan[$jurusan->nama_jurusan] ?? $this->generateRandomColor(),
                'tension' => 0.3,
                'borderWidth' => 2,
            ];
        }

        return [
            'labels' => $labels,
            'datasets' => $datasets,
            'time_range' => 'year'
        ];
    }

    private function generateRandomColor()
    {
        return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
    }

    public function updateAktivitas(Request $request)
{
    // Validasi dan simpan data baru...
    // DB::table(...)->update(...); atau model->save();

    // Ambil data chart terbaru
    $data = $this->getReportData('week');

    // Kirim ke Pusher
    event(new AktivitasSiswaUpdated($data));

    return response()->json(['message' => 'Data updated and broadcast sent']);
}

}