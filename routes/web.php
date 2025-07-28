<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Guru\DataSiswaController;
use App\Http\Controllers\Guru\DataPerusahaanController;
use App\Http\Controllers\Guru\UserController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\Guru\KategoriTugasController;
use App\Http\Controllers\AktivitasSiswaController;
use App\Http\Controllers\LaporankeseluruhanController; 
use App\Http\Controllers\superuser\DataPerusahaanController as SuperuserDataPerusahaanController;



// routes/web.php
Route::prefix('guru')->middleware(['auth', 'role:guru'])->group(function() {
    // ... route lainnya
    
    // Tambahkan route untuk export
    Route::get('/data-siswa/export/excel', [DataSiswaController::class, 'exportExcel'])
        ->name('guru.data-siswa.export.excel');
    
    Route::get('/data-siswa/export/pdf', [DataSiswaController::class, 'exportPdf'])
        ->name('guru.data-siswa.export.pdf');
});

Route::prefix('laporan')->group(function() {
    Route::get('/', [LaporankeseluruhanController::class, 'index'])->name('laporan.index');
});
Route::middleware(['auth'])->group(function () {
    Route::prefix('laporan')->group(function() {
    Route::get('/', [LaporankeseluruhanController::class, 'index'])->name('laporan.index');
    Route::get('/export-excel', [LaporankeseluruhanController::class, 'exportExcel'])->name('laporan.export.excel');
    Route::get('/export-pdf', [LaporankeseluruhanController::class, 'exportPdf'])->name('laporan.export.pdf');
});

    Route::get('/', [AktivitasSiswaController::class, 'create']);

    Route::get('/dashboard', function () {
        $role = auth()->user()->role;

        return match ($role) {
            'superuser' => redirect()->route('superuser.dashboard'),
            'guru' => redirect()->route('guru.dashboard'),
            default => view('dashboard'),
        };
    })->name('dashboard');

    Route::middleware('role:siswa')->prefix('siswa')->name('siswa.')->group(function () {
        Route::get('input-kategori', [AktivitasSiswaController::class, 'create'])->name('input-kategori.create');
        Route::post('input-kategori', [AktivitasSiswaController::class, 'store'])->name('input-kategori.store');
    });

    // Superuser
    Route::middleware('role:superuser')->group(function () {
        Route::get('/superuser', fn() => view('superuser.dashboard'))->name('superuser.dashboard');
        Route::get('/superuser/data-perusahaan', [DataPerusahaanController::class, 'index'])->name('superuser.data-perusahaan.index');
        Route::get('/superuser/data-siswa', fn() => view('superuser.data-siswa.index'))->name('superuser.data-siswa.index');
        Route::get('/superuser/data-kategori', fn() => view('superuser.data-kategori.index'))->name('superuser.data-kategori.index');
        Route::get('/superuser/data-user', fn() => view('superuser.data-user.index'))->name('superuser.data-user.index');
        Route::get('/superuser/laporan', [LaporankeseluruhanController::class, 'index'])->name('superuser.laporan.index');
        Route::resource('data-siswa', DataSiswaController::class);
        Route::get('/superuser/data-perusahaan', [SuperuserDataPerusahaanController::class, 'index'])->name('superuser.data-perusahaan.index');
        Route::resource('data-perusahaan', SuperuserDataPerusahaanController::class)->names('data-perusahaan');
        Route::resource('data-user', UserController::class)->names('data-user');
        Route::resource('data-kategori', KategoriTugasController::class)->names('data-kategori');
    });

    // Guru
    Route::middleware('role:superuser,guru')->group(function () {
        Route::get('/guru', fn() => view('guru.dashboard'))->name('guru.dashboard');
        Route::get('/guru/data-perusahaan', [DataPerusahaanController::class, 'index'])->name('guru.data-perusahaan.index');
        Route::get('/guru/data-siswa', fn() => view('guru.data-siswa.index'))->name('guru.data-siswa.index');
        Route::get('/guru/data-kategori', fn() => view('guru.data-kategori.index'))->name('guru.data-kategori.index');
        Route::get('/guru/laporan', [LaporankeseluruhanController::class, 'index'])->name('guru.laporan.index');
    });

    Route::middleware('role:superuser,guru')->prefix('guru')->name('guru.')->group(function () {
        Route::resource('data-siswa', DataSiswaController::class);
        Route::resource('data-perusahaan', DataPerusahaanController::class);
        Route::resource('data-user', UserController::class)->names('data-user');
        Route::resource('data-kategori', KategoriTugasController::class)->names('data-kategori');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php'; 