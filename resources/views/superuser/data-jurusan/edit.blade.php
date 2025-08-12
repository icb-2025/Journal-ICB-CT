{{-- resources/views/superuser/data-jurusan/edit.blade.php --}}
@extends('layouts.super')

@section('content')
<div class="max-w-lg mx-auto bg-white shadow-md rounded-lg p-6">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Edit Data Jurusan</h2>

    <form action="{{ route('superuser.data-jurusan.update', $data_jurusan->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf
        @method('PUT')

        <!-- Nama Jurusan -->
        <div>
            <label for="nama_jurusan" class="block text-sm font-medium text-gray-700">Nama Jurusan</label>
            <input 
                type="text" 
                name="nama_jurusan" 
                id="nama_jurusan" 
                value="{{ $data_jurusan->nama_jurusan }}" 
                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                placeholder="Masukkan nama jurusan"
            >
        </div>

        <!-- Tombol -->
        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('superuser.data-jurusan.index') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition">
                Batal
            </a>
            <button 
                type="submit" 
                class="px-4 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-1"
            >
                Update
            </button>
        </div>
    </form>
</div>
@endsection