<?php

namespace App\Http\Controllers\Superuser;

use App\Http\Controllers\Controller;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DataPerusahaanController extends Controller
{
    public function index()
    {
        $perusahaans = Perusahaan::with('user')->oldest()->paginate(10);
        return view('superuser.data-perusahaan.index', ['perusahaans' => $perusahaans]);
    }

    public function create()
    {
        return view('superuser.data-perusahaan.create');
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

        $bulanTahun = now()->format('Ym'); 
        $random = strtoupper(Str::random(5));

        $validated['kode_perusahaan'] = 'KODE-' . $bulanTahun . '-' . $random;
        $validated['input_by'] = auth()->id();

        Perusahaan::create($validated);

        return redirect()->route('superuser.data-perusahaan.index')->with('success', 'Data perusahaan berhasil ditambahkan.');
    }

    public function edit(Perusahaan $data_perusahaan)
    {
        return view('superuser.data-perusahaan.edit', ['perusahaan' => $data_perusahaan]);
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

        return redirect()->route('superuser.data-perusahaan.index')->with('success', 'Data perusahaan berhasil diperbarui.');
    }

    public function destroy(Perusahaan $data_perusahaan)
    {
        $data_perusahaan->delete();
        return redirect()->route('superuser.data-perusahaan.index')->with('success', 'Data perusahaan berhasil dihapus.');
    }
}
