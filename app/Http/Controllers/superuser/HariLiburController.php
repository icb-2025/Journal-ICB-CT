<?php

namespace App\Http\Controllers\Superuser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JadwalLibur;
use App\Models\Perusahaan;

class HariLiburController extends Controller
{
    
    public function index(Request $request)
    {
        // =========================
        // 1️⃣ Ambil tanggal yang dicek
        // =========================
        $today = $request->input('tanggal', date('Y-m-d')); 
        $today = date('Y-m-d', strtotime($today)); 
        $hariList = ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'];
        $hariIni = $hariList[date('N', strtotime($today)) - 1];

        // =========================
        // 2️⃣ Ambil data jadwal perusahaan
        // =========================
        $jadwal = JadwalLibur::with('perusahaan')->latest()->get();

        // =========================
        // 3️⃣ Ambil data libur nasional
        // =========================
        $nationalHolidays = [];
        try {
            $response = file_get_contents('https://api-harilibur.vercel.app/api');
            $holidays = json_decode($response, true);
            foreach ($holidays as $holiday) {
                $holidayDateRaw = trim($holiday['holiday_date'] ?? $holiday['date'] ?? '');
                if ($holidayDateRaw) {
                    $holidayDate = date('Y-m-d', strtotime($holidayDateRaw));
                    $nationalHolidays[] = $holidayDate;
                }
            }
        } catch (\Exception $e) {
            $nationalHolidays = [];
        }

        // =========================
        // 4️⃣ Transform status jadwal
        // =========================
        $jadwal->transform(function ($item) use ($hariList, $hariIni, $today, $nationalHolidays) {
    // Libur nasional prioritas
    if (in_array($today, $nationalHolidays)) {
        $item->status = 'Libur (Libur Nasional)';
        return $item;
    }

    // Cek range hari libur perusahaan
    $parts = explode('-', $item->hari_libur);
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

    $item->status = in_array($hariIni, $range) ? 'Libur (Perusahaan)' : 'Masuk';
    return $item;
});


        $perusahaan = Perusahaan::all();

        return view('superuser.jadwal-hari-libur.index', compact('jadwal', 'perusahaan', 'today'));
    }
    
    public function create()
    {
        $perusahaan = Perusahaan::all();
        return view('superuser.jadwal-hari-libur.create', compact('perusahaan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'perusahaan_id' => 'required|exists:perusahaans,kode_perusahaan',
            'mulai_libur'   => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'selesai_libur' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
        ]);

        $hariLibur = $request->mulai_libur . '-' . $request->selesai_libur;

        // Status default: Sabtu/Minggu libur, selain itu masuk
        $status = (in_array($request->mulai_libur, ['Sabtu','Minggu']) || in_array($request->selesai_libur, ['Sabtu','Minggu']))
                    ? 'Libur'
                    : 'Masuk';

        JadwalLibur::create([
            'perusahaan_id' => $request->perusahaan_id,
            'hari_libur'    => $hariLibur,
            'status'        => $status
        ]);

        return redirect()->route('superuser.jadwal-hari-libur.index')
                         ->with('success', 'Jadwal libur berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $jadwal = JadwalLibur::findOrFail($id);
        $perusahaans = Perusahaan::all();
        return view('superuser.jadwal-hari-libur.edit', compact('jadwal', 'perusahaans'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'perusahaan_id' => 'required|exists:perusahaans,kode_perusahaan',
            'mulai_libur'   => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'selesai_libur' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
        ]);

        $hariLibur = $request->mulai_libur . '-' . $request->selesai_libur;

        $status = (in_array($request->mulai_libur, ['Sabtu','Minggu']) || in_array($request->selesai_libur, ['Sabtu','Minggu']))
                    ? 'Libur'
                    : 'Masuk';

        $jadwal = JadwalLibur::findOrFail($id);
        $jadwal->update([
            'perusahaan_id' => $request->perusahaan_id,
            'hari_libur'    => $hariLibur,
            'status'        => $status
        ]);

        return redirect()->route('superuser.jadwal-hari-libur.index')
                         ->with('success', 'Jadwal libur berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $jadwal = JadwalLibur::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('superuser.jadwal-hari-libur.index')
                         ->with('success', 'Jadwal libur berhasil dihapus.');
    }
}
