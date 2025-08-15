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
            <button type="submit" id="simpanDataBtn"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            Simpan Data
                        </button>

            <a href="{{ route('superuser.data-jurusan.index') }}" 
                        class="ml-2 px-4 py-2 border border-blue-300 rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
                            <i class="fas fa-times mr-1"></i> Batal
                    </a>
        </div>
    </form>
</div>
@endsection
