<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perusahaan;
use App\Models\AktivitasSiswa;
use App\Models\KategoriTugas;

class AktivitasSiswaController extends Controller
{
    public function create()
{
    $user = auth()->user();

    // Ambil perusahaan berdasarkan kode_perusahaan user
    $perusahaanUser = Perusahaan::where('kode_perusahaan', $user->kode_perusahaan)->first();

    // Kirim ke view (ubah 'index' jika view-nya bukan itu)
    return view('index', compact('perusahaanUser'));
}


    public function store(Request $request)
    {
        // Validasi basic
        $request->validate([
            'company_code' => 'required|array',
            'input_date' => 'required|array',
            'start_time' => 'required|array',
            'end_time' => 'required|array',
            'description' => 'required|array',
        ]);

        // Simpan semua baris yang diinput
        foreach ($request->company_code as $i => $perusahaanId) {
            $deskripsi = $request->description[$i];

            $kategori_id = $this->deteksiKategori($deskripsi);

            AktivitasSiswa::create([
                'perusahaan_id' => $perusahaanId,
                'tanggal' => $request->input_date[$i],
                'mulai' => $request->start_time[$i],
                'selesai' => $request->end_time[$i],
                'deskripsi' => $deskripsi,
                'kategori_tugas_id' => $kategori_id,
                'siswa_id' => auth()->id(),
            ]);
        }

        return redirect()->back()->with('success', 'Aktivitas berhasil disimpan.');
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


