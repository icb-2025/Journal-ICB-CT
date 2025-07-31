<?php

namespace App\Http\Controllers\Superuser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jurusan;
use Illuminate\Support\Str;

class SuperuserDataJurusanController extends Controller
{
    public function index()
    {
        $jurusans = Jurusan::oldest()->paginate(10);
        return view('superuser.data-jurusan.index', compact('jurusans'));
    }

    public function create()
    {
        return view('superuser.data-jurusan.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'nama_jurusan' => 'required|string|max:255',
    ]);

    $kode = $this->generateKodeJurusan();

    Jurusan::create([
        'nama_jurusan' => $request->nama_jurusan,
        'kode_jurusan' => $kode,
    ]);

    return redirect()->route('superuser.data-jurusan.index')->with('success', 'Jurusan berhasil ditambahkan.');
}


private function generateKodeJurusan(): string
{
    do {
        $kode = Str::upper(Str::random(8));
    } while (Jurusan::where('kode_jurusan', $kode)->exists());

    return $kode;
}

    public function edit(Jurusan $data_jurusan)
    {
        return view('superuser.data-jurusan.edit', compact('data_jurusan'));
    }

    public function update(Request $request, Jurusan $data_jurusan)
    {
        $request->validate([
            'nama_jurusan' => 'required|string|max:255',
        ]);

        $data_jurusan->update($request->all());
        return redirect()->route('superuser.data-jurusan.index')->with('success', 'Jurusan berhasil diperbarui.');
    }

    public function destroy(Jurusan $data_jurusan)
    {
        $data_jurusan->delete();
        return back()->with('success', 'Jurusan berhasil dihapus.');
    }
}
