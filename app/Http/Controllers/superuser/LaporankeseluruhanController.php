<?php

namespace App\Http\Controllers\Superuser;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Aktivitas; // Pastikan model Aktivitas ada
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AktivitasExport;
use Barryvdh\DomPDF\Facade\Pdf; // Perbaikan import PDF
use App\Models\Perusahaan;
use App\Models\Jurusan;

class LaporankeseluruhanController extends Controller
{
public function index(Request $request)
{
    if ($request->ajax()) {
        $query = Aktivitas::with(['siswa', 'perusahaan', 'kategoriTugas']);

        if ($request->search) {
            $query->whereHas('siswa', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->jurusan) {
            $query->whereHas('siswa', function ($q) use ($request) {
                $q->where('nama_jurusan', $request->jurusan);
            });
        }

        if ($request->perusahaan) {
            $query->whereHas('perusahaan', function ($q) use ($request) {
                $q->where('nama_industri', $request->perusahaan);
            });
        }

        $aktivitas = $query->oldest()->get();

        $html = view('superuser.laporan.partials.table', compact('aktivitas'))->render();

        return response()->json([
            'success' => true,
            'html' => $html
        ]);
    }

    // Untuk non-AJAX: halaman awal
    return view('superuser.laporan.index', [
        'aktivitas' => Aktivitas::with(['siswa', 'perusahaan', 'kategoriTugas'])->latest()->paginate(25),
        'jurusans' => Jurusan::all(),
        'perusahaans' => Perusahaan::all(),
    ]);
}

    
    public function exportExcel()
    {
        return Excel::download(new AktivitasExport, 'aktivitas-siswa.xlsx');
    }
    
    public function exportPdf()
    {
        $aktivitas = Aktivitas::with(['siswa', 'perusahaan', 'kategoriTugas'])->get();
        $pdf = Pdf::loadView('superuser.laporan.export.export', compact('aktivitas'));
        return $pdf->download('aktivitas-siswa.pdf');
    }
}