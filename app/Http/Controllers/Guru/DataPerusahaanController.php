<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DataPerusahaanController extends Controller
{
    public function index()
{
    $perusahaans = Perusahaan::with('user')->get();

    foreach ($perusahaans as $perusahaan) {
        // Ambil kode sekarang
        $kode = $perusahaan->kode_perusahaan;
        $parts = explode('-', $kode);

        if (count($parts) === 3) {
            $kodePrefix = $parts[0];     // "KODE"
            $kodeBulan = $parts[1];      // contoh: "202507"
            $kodeRandom = $parts[2];     // contoh: "H4GTTJX7"

            $currentMonth = now()->format('Ym'); // "202508"

            // Jika bulan kode berbeda dengan bulan sekarang
            if ($kodeBulan !== $currentMonth) {
                $kodeBaru = $kodePrefix . '-' . $currentMonth . '-' . strtoupper(Str::random(8));
                $perusahaan->kode_perusahaan = $kodeBaru;
                $perusahaan->save(); // simpan perubahan ke database
            }
        }
    }

    // Ambil ulang hasil paginasi
    $paginated = Perusahaan::with('user')->oldest()->paginate(10);

    return view('guru.data-perusahaan.index', ['perusahaans' => $paginated]);
}


    public function create()
    {
        return view('guru.data-perusahaan.create');
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'nama_industri'   => 'required|string|max:255',
        'bidang_usaha'    => 'required|string|max:255',
        'alamat'          => 'required|string',
        'no_telepon'      => 'nullable|string|max:20',
        'nama_direktur'   => 'required|string|max:255',
        'nama_pembimbing' => 'required|string|max:255',
    ]);

    // Format kode: KODE-YYYYMM-ABCDE
    // $bulanTahun = now()->format('Ym'); // Contoh: 202507

    // Untuk testing: anggap sekarang adalah 1 Agustus 2025
$bulanTahun = \Carbon\Carbon::create(2025, 10, 1)->format('Ym'); // hasil: 202508


    $random = strtoupper(Str::random(5)); // 5 huruf acak

    $validated['kode_perusahaan'] = 'KODE-' . $bulanTahun . '-' . $random;
    $validated['input_by'] = auth()->id();

    Perusahaan::create($validated);

    return redirect()->route('guru.data-perusahaan.index')->with('success', 'Data perusahaan berhasil ditambahkan.');
}


    public function edit(Perusahaan $data_perusahaan)
    {
        return view('guru.data-perusahaan.edit', ['perusahaan' => $data_perusahaan]);
    }

    public function update(Request $request, Perusahaan $data_perusahaan)
    {
        $validated = $request->validate([
            'nama_industri'   => 'required|string|max:255',
            'bidang_usaha'    => 'required|string|max:255',
            'alamat'          => 'required|string',
            'no_telepon'      => 'nullable|string|max:20',
            'nama_direktur'   => 'required|string|max:255',
            'nama_pembimbing' => 'required|string|max:255',
        ]);

        $data_perusahaan->update($validated);

        return redirect()->route('guru.data-perusahaan.index')->with('success', 'Data perusahaan berhasil diperbarui.');
    }

    public function destroy(Perusahaan $data_perusahaan)
{
    $data_perusahaan->delete();
    return redirect()->route('guru.data-perusahaan.index')->with('success', 'Data perusahaan berhasil dihapus.');
}



}
