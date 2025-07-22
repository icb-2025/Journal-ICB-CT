<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Guru\DataSiswaController;

Route::get('/', function () {
    return view('index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        $role = auth()->user()->role;

        return match ($role) {
            'superuser' => redirect()->route('superuser.dashboard'),
            'guru' => redirect()->route('guru.dashboard'),
            default => view('dashboard'), // siswa tetap di dashboard
        };
    })->name('dashboard');

    // Superuser
    Route::middleware('role:superuser')->group(function () {
        Route::get('/superuser', fn() => view('superuser.dashboard'))->name('superuser.dashboard');
    });

    // Guru
    Route::middleware('role:superuser,guru')->group(function () {
        Route::get('/guru', fn() => view('guru.dashboard'))->name('guru.dashboard');
        Route::get('/guru/data-perusahaan', fn() => view('guru.perusahaan'))->name('guru.perusahaan');
        Route::get('/guru/data-user', fn() => view('guru.user'))->name('guru.user');
        Route::get('/guru/data-siswa', fn() => view('guru.data-siswa.index'))->name('guru.data-siswa.index');
        Route::get('/guru/data-kategori', fn() => view('guru.kategori'))->name('guru.kategori');
    });
    Route::middleware('role:superuser,guru')->prefix('guru')->name('guru.')->group(function () {
        Route::resource('data-siswa', DataSiswaController::class);
    });


});


require __DIR__.'/auth.php';
