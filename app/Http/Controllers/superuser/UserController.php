<?php

namespace App\Http\Controllers\Superuser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Perusahaan;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\Jurusan;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index()
    {
        $users = User::with('inputBy')->paginate(10);
        $jurusans = Jurusan::all();
        $perusahaans = Perusahaan::all();


        return view('superuser.data-user.index', compact('users', 'perusahaans', 'jurusans'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        $perusahaans = Perusahaan::all();
        $jurusans = Jurusan::all();
        return view('superuser.data-user.create', compact('perusahaans', 'jurusans'));
    }

    /**
     * Store a newly created user in storage.
     */
   public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:6',
        'role' => 'required|in:superuser,guru',
        'kode_perusahaan' => 'nullable|string',
        'jurusan_id' => 'nullable|exists:jurusans,id',
    ]);

    $kodePerusahaan = null;
    $namaJurusan = null;

    if ($validated['role'] === 'guru') {
        $kodePerusahaan = $request->kode_perusahaan ?: null;
        $jurusan = Jurusan::find($request->jurusan_id);
        $namaJurusan = $jurusan ? $jurusan->nama_jurusan : null;
    }

    if ($validated['role'] === 'superuser') {
    $validated['kode_perusahaan'] = null;
    $validated['nama_jurusan'] = null;
} elseif ($validated['role'] === 'guru') {
    $validated['kode_perusahaan'] = $request->kode_perusahaan ?: null;
    $jurusan = Jurusan::find($request->jurusan_id);
    $validated['nama_jurusan'] = $jurusan ? $jurusan->nama_jurusan : null;
}


    User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
        'role' => $validated['role'],
        'kode_perusahaan' => $kodePerusahaan,
        'nama_jurusan' => $namaJurusan,
        'input_by' => auth()->id(),
        'input_date' => now(),
    ]);

    return redirect()->route('superuser.data-user.index')->with('success', 'User berhasil ditambahkan.');
}


    /**
     * Show the form for editing the specified user.
     */
   public function edit(User $data_user)
{
    return view('superuser.data-user.edit', ['user' => $data_user]);
}


    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $data_user)
{
    $validated = $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email,' . $data_user->id,
        'password' => 'nullable|string|min:6',
        'role' => 'required',
        'kode_perusahaan' => 'nullable|string',
    ]);

    if ($request->filled('password')) {
        $validated['password'] = bcrypt($request->password);
    } else {
        unset($validated['password']); // jika kosong, jangan update password
    }

    $validated['input_by'] = auth()->id();
    $validated['input_date'] = now();

    $data_user->update($validated);

    return redirect()->route('superuser.data-user.index')->with('success', 'User berhasil diupdate.');
}


    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $data_user)
{
    $data_user->delete();
    return redirect()->route('superuser.data-user.index')->with('success', 'User berhasil dihapus.');
}

}
