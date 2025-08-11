<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aktivitas;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AktivitasExport;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporankeseluruhanController extends Controller
{
    public function index(Request $request)
    {
        $query = Aktivitas::with(['siswa.jurusan', 'perusahaan', 'kategoriTugas']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('siswa', function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%$search%");
            });
        }

        $aktivitas = $query->orderBy('tanggal', 'desc')
                          ->orderBy('mulai', 'desc')
                          ->paginate(10);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'html' => view('guru.laporan.partials.table', compact('aktivitas'))->render()
            ]);
        }

        return view('guru.laporan.index', compact('aktivitas'));
    }

    public function exportExcel(Request $request)
    {
        $search = $request->search ?? null;
        return Excel::download(new AktivitasExport($search), 'aktivitas-siswa.xlsx');
    }

    public function exportPdf(Request $request)
    {
        $query = Aktivitas::with(['siswa.jurusan', 'perusahaan', 'kategoriTugas']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('siswa', function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%$search%");
            });
        }

        $aktivitas = $query->orderBy('tanggal', 'desc')->get();

        $pdf = Pdf::loadView('guru.laporan.export.export', compact('aktivitas'));
        return $pdf->download('aktivitas-siswa.pdf');
    }
}
