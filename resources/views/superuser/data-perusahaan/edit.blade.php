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
                <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
