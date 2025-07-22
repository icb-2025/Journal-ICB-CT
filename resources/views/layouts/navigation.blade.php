@extends('layouts.guru')

@section('title', 'Dashboard Guru')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
    <h2 class="text-xl font-semibold mb-4">Selamat Datang, {{ Auth::user()->name }}</h2>
    <p class="text-gray-600">Anda berhasil login sebagai guru.</p>
</div>
@endsection
