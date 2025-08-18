<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perusahaan;
use App\Models\AktivitasSiswa;
use App\Models\KategoriTugas;
use Illuminate\Support\Str;
use App\Events\AktivitasSiswaUpdated;
use Illuminate\Database\QueryException;
use App\Http\Controllers\Superuser\DashboardController;
use App\Models\Siswa;
use App\Models\JadwalLibur;
use Carbon\Carbon;
class AktivitasSiswaController extends Controller
{

    
public function index()
{
    $tanggalHariIni = Carbon::now()->toDateString();
    $jamSekarang    = Carbon::now()->format('H:i');

    $user = auth()->user();
    $kodePerusahaan = $user->kode_perusahaan;

    // Ambil jadwal libur untuk perusahaan ini
    $jadwalLibur = JadwalLibur::whereHas('perusahaan', function($q) use ($kodePerusahaan) {
        $q->where('kode_perusahaan', $kodePerusahaan);
    })->get();

    $hariList = ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'];
    $hariIni  = $hariList[date('N') - 1];

    // Tentukan status hari ini
    $statusHariIni = 'Masuk';
foreach ($jadwalLibur as $jadwal) {
    $parts = explode('-', $jadwal->hari_libur);
    $mulai = $parts[0];
    $selesai = $parts[1] ?? $parts[0];

    $startIndex = array_search($mulai, $hariList);
    $endIndex   = array_search($selesai, $hariList);

    $range = ($startIndex <= $endIndex)
        ? array_slice($hariList, $startIndex, $endIndex - $startIndex + 1)
        : array_merge(
            array_slice($hariList, $startIndex),
            array_slice($hariList, 0, $endIndex + 1)
        );

    if (in_array($hariIni, $range)) {
        $statusHariIni = 'Libur';
        break;
    }
}


    // Ambil semua siswa + aktivitas mereka hari ini
    $siswaList = Siswa::with(['aktivitas' => function($q) use ($tanggalHariIni) {
        $q->where('tanggal', $tanggalHariIni);
    }])
    ->where('kode_perusahaan', $kodePerusahaan)
    ->get();

  foreach ($siswaList as $siswa) {
    if ($statusHariIni === 'Masuk') {
        if ($siswa->aktivitas->isEmpty()) {
            if ($jamSekarang >= '21:00') {
                $perusahaan = null;
                if ($siswa->kode_perusahaan) {
                    $perusahaan = Perusahaan::where('kode_perusahaan', $siswa->kode_perusahaan)->first();
                }

                AktivitasSiswa::create([
                    'perusahaan_id'    => $perusahaan?->kode_perusahaan, // dari kode_perusahaan
                    'tanggal'          => $tanggalHariIni,
                    'mulai'            => '06:00:00',
                    'selesai'          => '21:00:00',
                    'deskripsi'        => 'Tidak hadir',
                    'kategori_tugas_id'=> null,
                    'siswa_id'         => $siswa->id,
                    'status'           => 'Alpa',
                    'id_jurusan'       => $siswa->id_jurusan,
                ]);
            } else {
                $siswa->status_otomatis = '-';
            }
        } else {
            $siswa->status_otomatis = $siswa->aktivitas->first()->status;
        }
    } else {
        $siswa->status_otomatis = '-';
    }
}




    return view('guru.laporan.index', [
        'siswaList' => $siswaList,
        'statusHariIni' => $statusHariIni,
        'tanggalHariIni' => $tanggalHariIni
    ]);
}

   public function create()
{
    $user = auth()->user();
    $perusahaanUser = Perusahaan::where('kode_perusahaan', $user->kode_perusahaan)->first();
    $kategoriTugas = KategoriTugas::all();

    $aktivitasSiswa = AktivitasSiswa::where('siswa_id', $user->id)
                    ->with('kategoriTugas')
                    ->orderByDesc('tanggal')
                    ->paginate(5);

    // Check if it's an AJAX request
    if (request()->ajax()) {
        return view('partials.activity-history', [
            'aktivitasSiswa' => $aktivitasSiswa,
            'perusahaanUser' => $perusahaanUser,
            'kodeBelakang' => $perusahaanUser ? Str::afterLast($perusahaanUser->kode_perusahaan, '-') : null
        ]);
    }

    return view('index', compact('perusahaanUser', 'kategoriTugas', 'aktivitasSiswa'));
}



 public function store(Request $request)
{

    $user = auth()->user();
    $dataSiswa = $user->siswa;

    $request->validate([
        'company_code' => 'required|array',
        'input_date'   => 'required|array',
        'description'  => 'required|array',
        'status'       => 'required|array',
    ]);

    try {
        foreach ($request->company_code as $i => $perusahaanId) {
            $status = $request->status[$i] ?? 'masuk';

            if ($status === 'sakit') {
                $start = '-';
                $end = '-';
                $kategori_id = null;
            } elseif ($status === 'izin') {
                $start = $request->start_time[$i];
                $end = $request->end_time[$i];
                $kategori_id = null;
            } else {
                $start = $request->start_time[$i];
                $end = $request->end_time[$i];
                $kategori_id = $request->category[$i] ?? $this->deteksiKategori($request->description[$i]);
            }

            AktivitasSiswa::create([
                'perusahaan_id' => $perusahaanId,
                'tanggal'       => $request->input_date[$i],
                'mulai'         => $start,
                'selesai'       => $end,
                'deskripsi'     => $request->description[$i],
                'kategori_tugas_id' => $kategori_id,
                'siswa_id'      => auth()->id(),
                'status'        => $status,
                'id_jurusan'    => $dataSiswa?->id_jurusan,
            ]);
        }

        $data = (new DashboardController())->getReportData('week');
        event(new AktivitasSiswaUpdated($data));

        return redirect()->back()->with('success', 'Aktivitas berhasil disimpan.');
    }
    catch (QueryException $e) {
        if ($e->getCode() === '23000') {
            return redirect()->back()->with('error', 'Aktivitas untuk tanggal tersebut sudah pernah diinput.');
        }
        throw $e;
    }
}

    private function deteksiKategori($kalimat)
    {
        $kalimat = strtolower($kalimat);
        $kategoris = KategoriTugas::all();

        foreach ($kategoris as $kategori) {
            $keywords = explode(',', strtolower($kategori->keywords ?? ''));
            foreach ($keywords as $keyword) {
                $keyword = trim($keyword);
                if (str_contains($kalimat, $keyword)) {
                    return $kategori->id;
                }
            }
        }

        return null; // fallback
    }
}


