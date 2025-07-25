<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Guru\DataSiswaController;
use App\Http\Controllers\Guru\DataPerusahaanController;
use App\Http\Controllers\Guru\UserController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\Guru\KategoriTugasController;
use App\Http\Controllers\AktivitasSiswaController;

Route::prefix('guru')->middleware(['auth', 'role:guru'])->group(function() {
    Route::resource('data-siswa', DataSiswaController::class);
    Route::get('data-siswa/export/excel', [DataSiswaController::class, 'exportExcel'])->name('guru.data-siswa.export.excel');
    Route::get('data-siswa/export/pdf', [DataSiswaController::class, 'exportPdf'])->name('guru.data-siswa.export.pdf');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/', [AktivitasSiswaController::class, 'create']);
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

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

    Route::middleware('role:siswa')->prefix('siswa')->name('siswa.')->group(function () {
   Route::get('input-kategori', [AktivitasSiswaController::class, 'create'])->name('input-kategori.create');
    Route::post('input-kategori', [AktivitasSiswaController::class, 'store'])->name('input-kategori.store');
});

 // Superuser
Route::middleware('role:superuser')->prefix('superuser')->name('superuser.')->group(function () {
    Route::get('/', fn() => view('superuser.dashboard'))->name('dashboard');
    Route::get('/laporan', [AktivitasSiswaController::class, 'index'])->name('laporan.index');
    Route::resource('data-siswa', DataSiswaController::class);
    Route::resource('data-perusahaan', DataPerusahaanController::class);
    Route::resource('data-user', UserController::class);
    Route::resource('data-kategori', KategoriTugasController::class);
});

// Guru
Route::middleware('role:superuser,guru')->prefix('guru')->name('guru.')->group(function () {
    Route::get('/', fn() => view('guru.dashboard'))->name('dashboard');
    Route::get('/laporan', [AktivitasSiswaController::class, 'index'])->name('laporan.index');
    Route::resource('data-siswa', DataSiswaController::class);
    Route::resource('data-perusahaan', DataPerusahaanController::class);
    Route::resource('data-user', UserController::class);
    Route::resource('data-kategori', KategoriTugasController::class);
});
});


require __DIR__.'/auth.php';
