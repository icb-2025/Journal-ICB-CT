<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

// Default bawaan Laravel
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Tambahkan ini untuk ambil data libur nasional
Route::get('/national-holidays', function () {
    $response = Http::get('https://api-harilibur.vercel.app/api');

    if ($response->successful()) {
        return $response->json();
    }

    return response()->json(['error' => 'Gagal mengambil data libur nasional'], 500);
});
