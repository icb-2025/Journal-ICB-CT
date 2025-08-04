<?php

namespace App\Http\Controllers\Superuser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Aktivitas;
use Carbon\Carbon;
class DashboardController extends Controller

{
public function index()
{
    $hariUrut = ['Monday' => 'Senin', 'Tuesday' => 'Selasa', 'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat'];
    $labels = array_values($hariUrut);

    $jurusans = DB::table('jurusans')->pluck('nama_jurusan');

    $dataChart = [];
    foreach ($jurusans as $jurusan) {
        $dataPerJurusan = [];

        foreach ($hariUrut as $en => $id) {
            $total = DB::table('aktivitas_siswas')
                ->join('siswa', 'aktivitas_siswas.id', '=', 'siswa.id')
                ->join('jurusans', 'siswa.id_jurusan', '=', 'jurusans.id')
                ->where('jurusans.nama_jurusan', $jurusan)
                ->whereRaw("DAYNAME(aktivitas_siswas.created_at) = ?", [$en])
                ->count();

            $dataPerJurusan[] = $total;
        }

        $dataChart[] = [
            'label' => $jurusan,
            'data' => $dataPerJurusan,
            'fill' => false,
            'borderColor' => '#' . substr(md5($jurusan), 0, 6), // warna random berdasar nama jurusan
            'tension' => 0.3,
        ];
    }

    return view('superuser.dashboard', [
        'labels' => $labels,
        'datasets' => $dataChart
    ]);
}


}
