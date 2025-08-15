@extends('layouts.super')

@section('title', 'Tambah Perusahaan')

@section('content')
<div class="container px-4 py-6 mx-auto">
    <div class="p-6 bg-white rounded shadow-md">
        <h2 class="mb-4 text-2xl font-semibold">Edit Perusahaan</h2>
<form action="{{ route('superuser.data-perusahaan.update', ['data_perusahaan' => $perusahaan]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                    <label>Nama Industri</label>
                    <input type="text" name="nama_industri" value="{{ $perusahaan->nama_industri }}" class="w-full p-2 border rounded" required>
                </div>
                <div>
                    <label>Bidang Usaha</label>
                    <input type="text" name="bidang_usaha" value="{{ $perusahaan->bidang_usaha }}" class="w-full p-2 border rounded" required>
                </div>
                <div class="md:col-span-2">
                    <label>Alamat</label>
                    <textarea name="alamat" class="w-full p-2 border rounded" required>{{ $perusahaan->alamat }}</textarea>
                </div>
                <div>
                    <label>No Telepon</label>
                    <input type="text" value="{{ $perusahaan->no_telepon }}" name="no_telepon" class="w-full p-2 border rounded">
                </div>
                <div>
                    <label>Nama Direktur</label>
                    <input type="text" value="{{ $perusahaan->nama_direktur }}" name="nama_direktur" class="w-full p-2 border rounded" required>
                </div>
                <div class="md:col-span-2">
                    <label>Nama Pembimbing</label>
                    <input type="text" value="{{ $perusahaan->nama_pembimbing }}" name="nama_pembimbing" class="w-full p-2 border rounded" required>
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" id="simpanDataBtn"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            Simpan Data
                        </button>
                <a href="{{ route('superuser.data-perusahaan.index') }}" 
                        class="ml-2 px-4 py-2 border border-blue-300 rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
                            <i class="fas fa-times mr-1"></i> Batal
                </a>
            </div>
            
        </form>
    </div>
</div>
@endsection
