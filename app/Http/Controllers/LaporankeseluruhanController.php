<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aktivitas;
use App\Models\Jurusan;
use App\Models\Perusahaan;
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
            $query->where(function($q) use ($search) {
                $q->whereHas('siswa', function ($q) use ($search) {
                    $q->where('nama_lengkap', 'like', "%$search%");
                })
                ->orWhereHas('perusahaan', function ($q) use ($search) {
                    $q->where('nama_industri', 'like', "%$search%");
                })
                ->orWhere('deskripsi', 'like', "%$search%");
            });
        }

        if ($request->filled('department_id')) {
            $query->whereHas('siswa.jurusan', function ($q) use ($request) {
                $q->where('id', $request->department_id);
            });
        }

        if ($request->filled('perusahaan_id')) {
            if ($request->perusahaan_id === 'search') {
                if ($request->filled('company_search')) {
                    $companySearch = $request->company_search;
                    $query->whereHas('perusahaan', function ($q) use ($companySearch) {
                        $q->where('nama_industri', 'like', "%$companySearch%");
                    });
                }
            } else {
                $query->whereHas('perusahaan', function ($q) use ($request) {
                    $q->where('id', $request->perusahaan_id);
                });
            }
        }

        if ($request->filled('start_date')) {
            $query->where('tanggal', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->where('tanggal', '<=', $request->end_date);
        }

        $aktivitas = $query->orderBy('tanggal', 'desc')
                        ->orderBy('mulai', 'desc')
                        ->paginate(10);

        $jurusans = Jurusan::orderBy('nama_jurusan')->get();
        $perusahaans = $request->filled('company_search') 
            ? Perusahaan::where('nama_industri', 'like', '%'.$request->company_search.'%')->get()
            : Perusahaan::orderBy('nama_industri')->get();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'html' => view('guru.laporan.partials.table', compact('aktivitas'))->render(),
                'companies' => $perusahaans
            ]);
        }

        return view('guru.laporan.index', compact('aktivitas', 'jurusans', 'perusahaans'));
    }

    public function exportExcel(Request $request)
    {
        $query = Aktivitas::with(['siswa.jurusan', 'perusahaan', 'kategoriTugas']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('siswa', function ($q) use ($search) {
                    $q->where('nama_lengkap', 'like', "%$search%");
                })
                ->orWhereHas('perusahaan', function ($q) use ($search) {
                    $q->where('nama_industri', 'like', "%$search%");
                })
                ->orWhere('deskripsi', 'like', "%$search%");
            });
        }

        if ($request->filled('department_id')) {
            $query->whereHas('siswa.jurusan', function ($q) use ($request) {
                $q->where('id', $request->department_id);
            });
        }

        if ($request->filled('perusahaan_id')) {
            $query->whereHas('perusahaan', function ($q) use ($request) {
                $q->where('id', $request->perusahaan_id);
            });
        }

        if ($request->filled('start_date')) {
            $query->where('tanggal', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->where('tanggal', '<=', $request->end_date);
        }

        $aktivitas = $query->orderBy('tanggal', 'desc')->get();

        return Excel::download(new AktivitasExport($aktivitas), 'aktivitas-siswa.xlsx');
    }

    public function exportPdf(Request $request)
    {
        $query = Aktivitas::with(['siswa.jurusan', 'perusahaan', 'kategoriTugas']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('siswa', function ($q) use ($search) {
                    $q->where('nama_lengkap', 'like', "%$search%");
                })
                ->orWhereHas('perusahaan', function ($q) use ($search) {
                    $q->where('nama_industri', 'like', "%$search%");
                })
                ->orWhere('deskripsi', 'like', "%$search%");
            });
        }

        if ($request->filled('department_id')) {
            $query->whereHas('siswa.jurusan', function ($q) use ($request) {
                $q->where('id', $request->department_id);
            });
        }

        if ($request->filled('perusahaan_id')) {
            $query->whereHas('perusahaan', function ($q) use ($request) {
                $q->where('id', $request->perusahaan_id);
            });
        }

        if ($request->filled('start_date')) {
            $query->where('tanggal', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->where('tanggal', '<=', $request->end_date);
        }

        $aktivitas = $query->orderBy('tanggal', 'desc')->get();

        $pdf = Pdf::loadView('guru.laporan.export.export', compact('aktivitas'));
        return $pdf->download('aktivitas-siswa.pdf');
}
}