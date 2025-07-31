@extends('layouts.super')

@section('title', 'Data Kategori')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Data Kategori Tugas</h1>

    @if (session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tombol Tambah -->
    <div class="mb-6">
        <a href="{{ route('superuser.data-kategori.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Tambah Kategori</a>
    </div>

    <!-- Tabel Kategori -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded shadow">
            <thead>
                <tr class="bg-gray-200 text-gray-700 text-left">
                    <th class="py-3 px-4">No</th>
                    <th class="py-3 px-4">Nama Kategori</th>
                    <th class="py-3 px-4">Deskripsi</th>
                    <th class="py-3 px-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($kategoris as $index => $kategori)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-3 px-4">{{ $index + 1 }}</td>
                        <td class="py-3 px-4 font-semibold">{{ $kategori->nama_kategori }}</td>
                        <td class="py-3 px-4 text-sm text-gray-600">{{ $kategori->deskripsi ?? '-' }}</td>
                        <td class="py-3 px-4 text-center">
                            <a href="{{ route('superuser.data-kategori.edit', $kategori->id) }}" class="text-blue-600 hover:underline mr-3">Edit</a>
                            <form action="{{ route('superuser.data-kategori.destroy', $kategori->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin hapus kategori ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-4 px-4 text-center text-gray-500">Belum ada kategori.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-4" id="pagination-container">
            {{ $kategoris->links() }}
        </div>
    </div>
</div>
@endsection
