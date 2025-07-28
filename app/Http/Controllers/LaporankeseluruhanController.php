<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aktivitas; // Pastikan model Aktivitas ada
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AktivitasExport;
use Barryvdh\DomPDF\Facade\Pdf; // Perbaikan import PDF

class LaporankeseluruhanController extends Controller
{
    public function index(Request $request)
    {
        $query = Aktivitas::with(['siswa', 'perusahaan', 'kategoriTugas']);
        
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('siswa', function($q) use ($search) {
                    $q->where('name', 'like', "%$search%");
                })
                ->orWhereHas('perusahaan', function($q) use ($search) {
                    $q->where('nama_industri', 'like', "%$search%");
                })
                ->orWhere('deskripsi', 'like', "%$search%")
                ->orWhere('tanggal', 'like', "%$search%");
            });
        }
        
        $aktivitas = $query->latest()->paginate(10);
        
        if ($request->ajax()) {
            return view('guru.laporan.partials.table', compact('aktivitas'))->render();
        }
        
        return view('guru.laporan.index', compact('aktivitas'));
    }
    
    public function exportExcel()
    {
        return Excel::download(new AktivitasExport, 'aktivitas-siswa.xlsx');
    }
    
    public function exportPdf()
    {
        $aktivitas = Aktivitas::with(['siswa', 'perusahaan', 'kategoriTugas'])->get();
        $pdf = Pdf::loadView('guru.laporan.export', compact('aktivitas'));
        return $pdf->download('aktivitas-siswa.pdf');
    }
}