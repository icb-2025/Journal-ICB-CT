

@extends('layouts.super')

@section('title', 'Tambah Jurusan')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white rounded-lg shadow p-6 max-w-lg mx-auto">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Tambah Data Jurusan</h1>

        {{-- Notifikasi Success --}}
        @if (session('success'))
            <div class="mb-4 flex items-center p-4 text-green-800 bg-green-100 border border-green-300 rounded-lg">
                <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                        d="M5 13l4 4L19 7" />
                </svg>
                {{ session('success') }}
            </div>
        @endif

        {{-- Form Tambah Jurusan --}}
        <form action="{{ route('superuser.data-jurusan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label for="nama_jurusan" class="block mb-1 text-sm font-medium text-gray-700">Nama Jurusan</label>
                <input type="text" name="nama_jurusan" id="nama_jurusan" 
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                    placeholder="Masukkan nama jurusan" required>
            </div>

            <div class="flex justify-end gap-2">
                <a href="{{ route('superuser.data-jurusan.index') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition">
                Batal
                </a>
                <button type="submit" 
                    class="inline-flex items-center bg-blue-600 text-white px-5 py-2.5 rounded-lg shadow hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 transition">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                            d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
