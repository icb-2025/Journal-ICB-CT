@extends('layouts.super')

@section('title', 'Tambah Jurusan')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Tambah Kategori</h1>
    <form action="{{ route('superuser.data-jurusan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Nama Jurusan</label>
            <input type="text" name="nama_jurusan" class="w-full border rounded px-3 py-2" required>
        </div>
</div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Tambah</button>
    </form>
</div>
@endsection
