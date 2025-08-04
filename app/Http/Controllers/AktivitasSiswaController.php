<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perusahaan;
use App\Models\AktivitasSiswa;
use App\Models\KategoriTugas;
use Illuminate\Support\Str;
class AktivitasSiswaController extends Controller
{

    public function index()
{
    $aktivitas = AktivitasSiswa::with(['perusahaan', 'kategoriTugas', 'siswa'])->get();

    return view('guru.laporan.index', compact('aktivitas'));
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
    // Validasi basic
    $request->validate([
        'company_code' => 'required|array',
        'input_date' => 'required|array',
        'start_time' => 'required|array',
        'end_time' => 'required|array',
        'description' => 'required|array',
    ]);

    $siswaId = auth()->id();

    foreach ($request->company_code as $i => $perusahaanId) {
        $tanggal = $request->input_date[$i];

        // Cek apakah sudah ada data aktivitas untuk siswa ini di tanggal tersebut
        $existing = AktivitasSiswa::where('siswa_id', $siswaId)
                        ->where('tanggal', $tanggal)
                        ->exists();

        if ($existing) {
            return redirect()->back()->with('error', 'Data aktivitas untuk tanggal ' . $tanggal . ' sudah pernah disimpan.');
        }

        $deskripsi = $request->description[$i];
        $kategori_id = $request->category[$i] ?? $this->deteksiKategori($deskripsi);

        AktivitasSiswa::create([
            'perusahaan_id' => $perusahaanId,
            'tanggal' => $tanggal,
            'mulai' => $request->start_time[$i],
            'selesai' => $request->end_time[$i],
            'deskripsi' => $deskripsi,
            'kategori_tugas_id' => $kategori_id,
            'siswa_id' => $siswaId,
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


