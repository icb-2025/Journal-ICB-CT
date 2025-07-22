<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;

class DataSiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = Siswa::query();

        if ($request->filled('search')) {
            $query->where('nama_lengkap', 'like', '%' . $request->search . '%');
        }

        $siswas = $query->paginate(10);

        return view('guru.data-siswa.index', compact('siswas'));
    }

    public function create()
    {
        return view('guru.data-siswa.create');
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

        return redirect()->route('guru.data-siswa.index')->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $siswa = Siswa::findOrFail($id);
        return view('guru.data-siswa.show', compact('siswa'));
    }

    public function edit(string $id)
    {
        $siswa = Siswa::findOrFail($id);
        return view('guru.data-siswa.edit', compact('siswa'));
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

        return redirect()->route('guru.data-siswa.index')->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();

        return redirect()->route('guru.data-siswa.index')->with('success', 'Data siswa berhasil dihapus.');
    }
}
