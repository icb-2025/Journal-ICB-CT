<?php

namespace App\Http\Controllers\Superuser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JadwalLibur;
use App\Models\Perusahaan;

class HariLiburController extends Controller
{
    public function index()
{
    $jadwal = JadwalLibur::with('perusahaan')->latest()->get();

    $hariList = ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'];

    $jadwal->transform(function ($item) use ($hariList) {
    $parts = explode('-', $item->hari_libur);

    // Jika hanya 1 hari, mulai & selesai sama
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

    $hariIni = $hariList[date('N') - 1];
    $item->status = in_array($hariIni, $range) ? 'Libur' : 'Masuk';

    return $item;
});


    $perusahaan = Perusahaan::all();
    return view('superuser.jadwal-hari-libur.index', compact('jadwal', 'perusahaan'));
}


    public function create()
    {
        $perusahaan = Perusahaan::all();
        return view('superuser.jadwal-hari-libur.create', compact('perusahaan'));
    }

    public function store(Request $request)
{
    $request->validate([
        'perusahaan_id' => 'required|exists:perusahaans,id',
        'mulai_libur'   => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
        'selesai_libur' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
    ]);

    $hariLibur = $request->mulai_libur . '-' . $request->selesai_libur;

    // Kalau mulai atau selesai libur itu Sabtu atau Minggu → status Libur, selain itu Masuk
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
        'perusahaan_id' => 'required|exists:perusahaans,id',
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
