<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Perusahaan;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index()
    {
        $users = User::with('inputBy')->get();
        $perusahaans = Perusahaan::all();

        return view('guru.data-user.index', compact('users', 'perusahaans'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        $perusahaans = Perusahaan::all();
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
            'kode_perusahaan' => 'nullable|string',
        ]);

        // Otomatis isi '-' jika role superuser/guru
        if (in_array($request->role, ['superuser', 'guru'])) {
            $validated['kode_perusahaan'] = '-';
        }

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'kode_perusahaan' => $validated['kode_perusahaan'],
            'input_by' => auth()->id(),
            'input_date' => Carbon::now(),
        ]);

        return redirect()->route('guru.data-user.index')->with('success', 'User berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified user.
     */
   public function edit(User $data_user)
{
    return view('guru.data-user.edit', ['user' => $data_user]);
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

    return redirect()->route('guru.data-user.index')->with('success', 'User berhasil diupdate.');
}


    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $data_user)
{
    $data_user->delete();
    return redirect()->route('guru.data-user.index')->with('success', 'User berhasil dihapus.');
}

}
