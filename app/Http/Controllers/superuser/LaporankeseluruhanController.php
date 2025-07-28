<?php

namespace App\Http\Controllers\Superuser;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Aktivitas; // Pastikan model Aktivitas ada
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AktivitasExport;
use Barryvdh\DomPDF\Facade\Pdf; // Perbaikan import PDF

class LaporankeseluruhanController extends Controller
{
    public function index(Request $request)
    {
        $query = Aktivitas::with(['siswa', 'perusahaan', 'kategoriTugas']);
        
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->whereHas('siswa', function($q) use ($search) {
                $q->where('name', 'like', "%$search%");
            });
        }
        
        $aktivitas = $query->orderBy('tanggal', 'desc')
                        ->orderBy('mulai', 'desc')
                        ->paginate(10);
        
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'html' => view('superuser.laporan.partials.table', compact('aktivitas'))->render()
            ]);
        }
        
        return view('superuser.laporan.index', compact('aktivitas'));
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