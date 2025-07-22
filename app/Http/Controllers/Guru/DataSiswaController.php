<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;
class DataSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $query = Siswa::query();

    if ($request->filled('search')) {
        $query->where('nama_lengkap', 'like', '%' . $request->search . '%');
    }

    $siswas = $query->paginate(10);

    return view('guru.data-siswa.index', compact('siswas'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('guru.data-siswa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
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

    \App\Models\Siswa::create($validated);

    return redirect()->route('guru.data-siswa.index')->with('success', 'Data siswa berhasil ditambahkan.');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
