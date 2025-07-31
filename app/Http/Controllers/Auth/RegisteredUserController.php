<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Perusahaan;
use App\Models\Jurusan;
class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
{
    $perusahaans = Perusahaan::all();
    $jurusans = Jurusan::all();

    return view('auth.register', compact('perusahaans', 'jurusans'));
}

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
    'name' => ['required', 'string', 'max:255'],
    'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
    'password' => ['required', 'confirmed', Rules\Password::defaults()],
    'kode_perusahaan' => ['nullable'],
    'nama_jurusan' => ['nullable'],
]);

$user = User::create([
    'name' => $request->name,
    'email' => $request->email,
    'password' => Hash::make($request->password),
    'kode_perusahaan' => $request->kode_perusahaan,
    'nama_jurusan' => $request->nama_jurusan,
    
]);


        event(new Registered($user));

        Auth::login($user);

        return redirect(route('index', absolute: false));
    }
}
