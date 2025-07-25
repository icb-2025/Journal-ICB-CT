<?php

namespace App\Http\Controllers\Superuser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Exports\SiswaExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf; // Update this line
use Illuminate\Support\Str;

class DataSiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = $this->getFilteredQuery($request);
        $siswas = $query->paginate(10);

        if ($request->ajax()) {
            return response()->json([
                'html' => view('superuser.data-siswa.partials.table', compact('siswas'))->render(),
                'pagination' => $siswas->links()->toHtml()
            ]);
        }

        return view('superuser.data-siswa.index', compact('siswas'));
    }

    public function create()
    {
        return view('superuser.data-siswa.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap'     => 'required|string|max:255',
            'nis'              => 'required|string|max:50|unique:siswa,nis',
            'tempat_lahir'     => 'required|string|max:255',
            'tanggal_lahir'    => 'required|date',
            'gol_darah'        => 'nullable|string|max:3',
            'sekolah'          => 'required|string|max:255',
            'alamat_sekolah'   => 'required|string',
            'telepon_sekolah'  => 'nullable|string|max:20',
            'nama_wali'        => 'required|string|max:255',
            'alamat_wali'      => 'required|string',
            'telepon_wali'     => 'nullable|string|max:20',
        ]);

        $validated['input_by'] = auth()->id();
        Siswa::create($validated);

        return redirect()->route('superuser.data-siswa.index')->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $siswa = Siswa::findOrFail($id);
        return view('superuser.data-siswa.show', compact('siswa'));
    }

    public function edit(string $id)
    {
        $siswa = Siswa::findOrFail($id);
        return view('superuser.data-siswa.edit', compact('siswa'));
    }

    public function update(Request $request, string $id)
    {
        $siswa = Siswa::findOrFail($id);

        $validated = $request->validate([
            'nama_lengkap'     => 'required|string|max:255',
            'nis'              => 'required|string|max:50|unique:siswa,nis,' . $siswa->id,
            'tempat_lahir'     => 'required|string|max:255',
            'tanggal_lahir'    => 'required|date',
            'gol_darah'        => 'nullable|string|max:3',
            'sekolah'          => 'required|string|max:255',
            'alamat_sekolah'   => 'required|string',
            'telepon_sekolah'  => 'nullable|string|max:20',
            'nama_wali'        => 'required|string|max:255',
            'alamat_wali'      => 'required|string',
            'telepon_wali'     => 'nullable|string|max:20',
        ]);

        $validated['input_by'] = auth()->id();
        $siswa->update($validated);

        return redirect()->route('superuser.data-siswa.index')->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();

        return redirect()->route('superuser.data-siswa.index')->with('success', 'Data siswa berhasil dihapus.');
    }

    public function exportExcel(Request $request)
    {
        $query = $this->getFilteredQuery($request);
        $filename = 'data-siswa-'.now()->format('Y-m-d');
        
        // Tambahkan filter ke nama file jika ada
        if ($request->filled('search')) {
            $filename .= '-search-'.$request->search;
        }
        if ($request->filled('gol_darah')) {
            $filename .= '-gol-'.$request->gol_darah;
        }
        if ($request->filled('sekolah')) {
            $filename .= '-sekolah-'.Str::slug($request->sekolah);
        }
        
        return Excel::download(new SiswaExport($query), $filename.'.xlsx');
    }

    public function exportPdf(Request $request)
    {
        $query = $this->getFilteredQuery($request);
        $siswas = $query->get();
        
        $filename = 'data-siswa-'.now()->format('Y-m-d');
        // Logika penamaan file yang sama seperti di Excel bisa diterapkan
        
        $pdf = PDF::loadView('superuser.data-siswa.export.pdf', [
            'siswas' => $siswas,
            'filters' => $request->only(['search', 'gol_darah', 'sekolah']) // Kirim filter ke view
        ])->setPaper('a4', 'landscape');
        
        return $pdf->download($filename.'.pdf');
    }

    private function getFilteredQuery(Request $request)
    {
        return Siswa::when($request->filled('search'), function($query) use ($request) {
                $query->where(function($q) use ($request) {
                    $q->where('nama_lengkap', 'like', '%'.$request->search.'%')
                    ->orWhere('nis', 'like', '%'.$request->search.'%');
                });
            })
            ->when($request->filled('gol_darah'), function($query) use ($request) {
                $query->where('gol_darah', $request->gol_darah);
            })
            ->when($request->filled('sekolah'), function($query) use ($request) {
                $query->where('sekolah', 'like', '%'.$request->sekolah.'%');
            });
    }
}