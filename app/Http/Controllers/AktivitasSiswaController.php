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
        $user = auth()->user();
        $tanggalHariIni = Carbon::now()->toDateString();

        $statusHariIni = $this->getStatusHariIni($user);

        $perusahaanUser    = $user->perusahaan;
        $kategoriTugas     = KategoriTugas::all();
        $sudahInputHariIni = AktivitasSiswa::where('siswa_id', $user->id)
                                ->whereDate('tanggal', $tanggalHariIni)
                                ->exists();
        $aktivitasSiswa    = AktivitasSiswa::where('siswa_id', $user->id)
                                ->latest()
                                ->paginate(5);

       


       return view('index', [
    'statusHariIni'      => $statusHariIni,
    'perusahaanUser'     => $perusahaanUser,
    'kategoriTugas'      => $kategoriTugas,
    'sudahInputHariIni'  => $sudahInputHariIni,
    'aktivitasSiswa'     => $aktivitasSiswa,
    'isLibur'            => str_contains(strtolower($statusHariIni), 'libur'),
    'statusDefault'      => str_contains(strtolower($statusHariIni), 'libur') ? 'libur' : 'masuk',
    'kodeBelakang'       => $perusahaanUser?->kode_perusahaan, 
]);


    }

    public function create()
    {
        return $this->index();
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
                    'perusahaan_id'     => $perusahaanId,
                    'tanggal'           => $request->input_date[$i],
                    'mulai'             => $start,
                    'selesai'           => $end,
                    'deskripsi'         => $request->description[$i],
                    'kategori_tugas_id' => $kategori_id,
                    'siswa_id'          => $user->id,
                    'status'            => $status,
                    'id_jurusan'        => $dataSiswa?->id_jurusan,
                ]);
            }

            $data = (new DashboardController())->getReportData('week');
            event(new AktivitasSiswaUpdated($data));

            return redirect()->back()->with('success', 'Aktivitas berhasil disimpan.');
        } catch (QueryException $e) {
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

        return null;
    }

    private function getStatusHariIni($user)
    {
        $tanggalHariIni = Carbon::now()->toDateString();
        $hariList = ['senin','selasa','rabu','kamis','jumat','sabtu','minggu'];
        $hariIni  = $hariList[date('N') - 1];

        $statusHariIni = 'Masuk';

        try {
            $response = file_get_contents('https://api-harilibur.vercel.app/api');
            $holidays = json_decode($response, true);
            foreach ($holidays as $holiday) {
                $holidayDateRaw = trim($holiday['holiday_date'] ?? $holiday['date'] ?? '');
                if ($holidayDateRaw) {
                    $holidayDate = date('Y-m-d', strtotime($holidayDateRaw));
                    if ($holidayDate === $tanggalHariIni) {
                        return 'Libur (Nasional)';
                    }
                }
            }
        } catch (\Exception $e) {}

        // 🔹 Cek libur perusahaan
        $jadwalLibur = JadwalLibur::whereHas('perusahaan', function($q) use ($user) {
            $q->where('kode_perusahaan', $user->kode_perusahaan);
        })->get();

        foreach ($jadwalLibur as $jadwal) {
            $parts   = explode('-', $jadwal->hari_libur);
            $mulai   = strtolower(trim($parts[0]));
            $selesai = strtolower(trim($parts[1] ?? $parts[0]));

            $startIndex = array_search($mulai, $hariList);
            $endIndex   = array_search($selesai, $hariList);

            if ($startIndex !== false && $endIndex !== false) {
                $range = ($startIndex <= $endIndex)
                    ? array_slice($hariList, $startIndex, $endIndex - $startIndex + 1)
                    : array_merge(
                        array_slice($hariList, $startIndex),
                        array_slice($hariList, 0, $endIndex + 1)
                    );

                if (in_array($hariIni, $range)) {
                    return 'Libur (Perusahaan)';
                }
            }
        }

        return $statusHariIni;
    }
}
