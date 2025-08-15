<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function index()
    {
        // Ambil NIS user yang login
        $nis = Auth::user()->nisn;

        // Ambil siswa berdasarkan NIS tersebut
        $siswas = Siswa::with('jurusan')
            ->where('nis', $nis)
            ->paginate(10);

        return view('users', compact('siswas'));
    }
}
