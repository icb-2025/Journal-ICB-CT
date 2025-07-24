<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\KategoriTugas;
use Illuminate\Http\Request;

class KategoriTugasController extends Controller
{
    public function index()
    {
        $kategoris = KategoriTugas::all();
        return view('guru.data-kategori.index', compact('kategoris'));
    }

    public function create()
    {
        return view('guru.data-kategori.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'deskripsi' => 'required|string',
    ]);

    $kategori_id = $this->deteksiKategori($request->deskripsi);

    AktivitasSiswa::create([
        'deskripsi' => $request->deskripsi,
        'kategori_tugas_id' => $kategori_id,
        'siswa_id' => auth()->id(),
    ]);

    return back()->with('success', 'Aktivitas berhasil dicatat.');
}

    public function edit($id)
    {
        $kategori = KategoriTugas::findOrFail($id);
        return view('guru.data-kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $kategori = KategoriTugas::findOrFail($id);
        $kategori->update($request->all());

        return redirect()->route('guru.data-kategori.index')->with('success', 'Kategori berhasil diperbarui');
    }

    public function destroy($id)
    {
        $kategori = KategoriTugas::findOrFail($id);
        $kategori->delete();

        return redirect()->route('guru.data-kategori.index')->with('success', 'Kategori berhasil dihapus');
    }

    function deteksiKategori($kalimat)
{
    $kalimat = strtolower($kalimat);
    $kategoris = KategoriTugas::all();

    foreach ($kategoris as $kategori) {
        $keywords = explode(',', strtolower($kategori->keywords ?? ''));

        foreach ($keywords as $keyword) {
            $keyword = trim($keyword);
            if (str_contains($kalimat, $keyword)) {
                return $kategori->id;
            }
        }
    }

    return null; // jika tidak cocok
}
}
