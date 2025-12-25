<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function index()
    {
        $nis = Auth::user()->nisn;

        $siswas = Siswa::with('jurusan')
            ->where('nis', $nis)
            ->paginate(10);

        return view('users', compact('siswas'));
    }
}
