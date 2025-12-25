<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Guru\PerusahaanExport;
use Barryvdh\DomPDF\Facade\Pdf;

class DataPerusahaanController extends Controller
{
    public function index()
{
    $perusahaans = Perusahaan::with('user')->get();

    foreach ($perusahaans as $perusahaan) {
        $kode = $perusahaan->kode_perusahaan;
        $parts = explode('-', $kode);

        if (count($parts) === 3) {
            $kodePrefix = $parts[0];    
            $kodeBulan = $parts[1];   
            $kodeRandom = $parts[2];     

            $currentMonth = now()->format('Ym'); 

            if ($kodeBulan !== $currentMonth) {
                $kodeBaru = $kodePrefix . '-' . $currentMonth . '-' . strtoupper(Str::random(8));
                $perusahaan->kode_perusahaan = $kodeBaru;
                $perusahaan->save(); 
            }
        }
    }

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

$bulanTahun = \Carbon\Carbon::create(2025, 10, 1)->format('Ym');


    $random = strtoupper(Str::random(5));

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


public function exportExcel()
    {
        return Excel::download(new PerusahaanExport, 'data-perusahaan-'.now()->format('Y-m-d').'.xlsx');
    }

    public function exportPdf()
    {
        $perusahaans = Perusahaan::with('user')->get();
        
        $pdf = Pdf::loadView('superuser.data-perusahaan.export.pdf', [
            'perusahaans' => $perusahaans,
            'tanggal' => now()->format('d F Y')
        ]);
        
        return $pdf->download('data-perusahaan-'.now()->format('Y-m-d').'.pdf');
    }



}
