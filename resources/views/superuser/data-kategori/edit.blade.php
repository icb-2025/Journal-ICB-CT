@extends('layouts.super')

@section('title', 'Edit Kategori')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Edit Kategori</h1>
    <form action="{{ route('superuser.data-kategori.update', $kategori->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Nama Kategori</label>
            <input type="text" name="nama_kategori" value="{{ $kategori->nama_kategori }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Deskripsi</label>
            <textarea name="deskripsi" class="w-full border rounded px-3 py-2">{{ $kategori->deskripsi }}</textarea>
        </div>
        <div class="mb-4">
    <label class="block mb-1 font-semibold">Kata Kunci (dipisahkan dengan koma)</label>
    <textarea name="keywords" class="w-full border rounded px-3 py-2">{{ old('keywords', $kategori->keywords ?? '') }}</textarea>
    <p class="text-sm text-gray-500 mt-1">Contoh: belajar, membaca, coding, latihan</p>
</div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
    </form>
</div>
@endsection
