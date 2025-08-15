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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            {{-- Form Tambah Jurusan --}}
            <form action="{{ route('superuser.data-jurusan.store') }}" method="POST" enctype="multipart/form-data"
                class="space-y-4">
                @csrf
                <div>
                    <label for="nama_jurusan" class="block mb-1 text-sm font-medium text-gray-700">Nama Jurusan</label>
                    <input type="text" name="nama_jurusan" id="nama_jurusan"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Masukkan nama jurusan" required>
                </div>

                <div class="flex justify-end gap-2">
                    <button type="submit" id="simpanDataBtn"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            Tambah
                        </button>
                    <a href="{{ route('superuser.data-jurusan.index') }}" 
                        class="ml-2 px-4 py-2 border border-blue-300 rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
                            <i class="fas fa-times mr-1"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection