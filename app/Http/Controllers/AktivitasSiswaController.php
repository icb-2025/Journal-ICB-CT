<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perusahaan;
use App\Models\AktivitasSiswa;
use App\Models\KategoriTugas;
use Illuminate\Support\Str;
use App\Events\AktivitasSiswaUpdated;
use App\Http\Controllers\Superuser\DashboardController;

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

    $user = auth()->user();
    $dataSiswa = $user->siswa; // Ambil relasi siswa


    $request->validate([
    'company_code' => 'required|array',
    'input_date' => 'required|array',
    'description' => 'required|array',
    'status' => 'required|array',
    // Jangan validasi time & category dulu, validasi manual di loop
]);

    // $siswaId = auth()->id();

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
        'tanggal' => $request->input_date[$i],
        'mulai' => $start,
        'selesai' => $end,
        'deskripsi' => $request->description[$i],
        'kategori_tugas_id' => $kategori_id,
        'siswa_id' => auth()->id(),
        'status' => $status, // ✅ Tambahkan ini!
        'id_jurusan' => $dataSiswa?->id_jurusan, // ✅ Ambil dari relasi siswa
    ]);
}
// Ambil data terbaru dan kirim event realtime
$data = (new DashboardController())->getReportData('week');
event(new AktivitasSiswaUpdated($data));


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


