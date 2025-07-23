<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Perusahaan; // ✅ Tambahkan baris ini
use Illuminate\Support\Facades\Hash; // ✅ Tambahkan ini
use Carbon\Carbon;
class UserController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index()
{
    $users = User::with('inputBy')->get(); // atau sesuaikan query-mu
    $perusahaans = Perusahaan::all();

    return view('guru.data-user.index', compact('users', 'perusahaans'));
}

    /**
     * Show the form for creating a new user.
     */
    public function create()
{
    $perusahaans = Perusahaan::all(); // atau bisa juga pakai orderBy jika ingin urutan tertentu
    return view('guru.data-user.create', compact('perusahaans'));
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
        'role' => 'required|in:superuser,guru,siswa',
        'kode_perusahaan' => 'nullable|string' // ✅ tambahkan ini
    ]);

    User::create([
    'name' => $request->name,
    'email' => $request->email,
    'password' => Hash::make($request->password),
    'role' => $request->role,
    'kode_perusahaan' => $request->kode_perusahaan,
    'input_by' => auth()->id(), // ✅ gunakan ID user, bukan nama
    'input_date' => Carbon::now(),       // ✅ tanggal dan waktu saat ini
]);


    return redirect()->route('guru.data-user.index')->with('success', 'User berhasil ditambahkan.');
}




    /**
     * Show the form for editing the specified user.
     */
    public function edit($id)
{
    $user = User::findOrFail($id);
    $perusahaans = Perusahaan::all(); // ← tambahkan baris ini
    return view('guru.data-user.edit', compact('user', 'perusahaans'));
}



    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
{
    $validated = $request->validate([
    'name' => 'required',
    'email' => 'required|email|unique:users,email',
    'password' => 'required',
    'role' => 'required',
    'kode_perusahaan' => 'nullable|string',
]);


    if ($request->filled('password')) {
        $validated['password'] = bcrypt($request->password);
    } else {
        unset($validated['password']);
    }

    $validated['input_by'] = auth()->id();
    $validated['input_date'] = now();

    $user->update($validated);

    return redirect()->route('guru.data-user.index')->with('success', 'User berhasil diupdate.');
}


    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('guru.data-user.index')->with('success', 'User berhasil dihapus.');
    }
}
