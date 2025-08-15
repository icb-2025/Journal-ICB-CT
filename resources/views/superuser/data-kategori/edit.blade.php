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

        <button type="submit" id="simpanDataBtn"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            Simpan Data
                        </button>
        <a href="{{ route('superuser.data-kategori.index') }}" 
                        class="ml-2 px-4 py-2 border border-blue-300 rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
                            <i class="fas fa-times mr-1"></i> Batal
                    </a>
    </form>
</div>
@endsection
