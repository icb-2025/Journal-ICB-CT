@extends('layouts.super')

@section('title', 'Data Jurusan')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Data Jurusan Tugas</h1>

    @if (session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tombol Tambah -->
    <div class="mb-6">
        <a href="{{ route('superuser.data-jurusan.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            + Tambah Jurusan
        </a>
    </div>

    <!-- Tabel Jurusan -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded shadow">
            <thead>
                <tr class="bg-gray-200 text-gray-700 text-left">
                    <th class="py-3 px-4">No</th>
                    <th class="py-3 px-4">Kode Jurusan</th>
                    <th class="py-3 px-4">Nama Jurusan</th>
                    <th class="py-3 px-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($jurusans as $index => $jurusan)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-3 px-4">{{ $index + 1 }}</td>
                        <td class="py-3 px-4 font-mono text-sm text-gray-700">{{ $jurusan->kode_jurusan }}</td>
                        <td class="py-3 px-4 font-semibold">{{ $jurusan->nama_jurusan }}</td>
                        <td class="py-3 px-4 text-center flex items-center justify-center gap-3">
                            <!-- Tombol Edit -->
                            <a href="{{ route('superuser.data-jurusan.edit', $jurusan->id) }}" class="text-indigo-600 hover:text-indigo-900" title="Edit">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M13.586 3.586a2 2 0 112.828 2.828L14.828 8l-2.828-2.828L13.586 3.586zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                </svg>
                            </a>

                            <!-- Tombol Hapus -->
                            <form action="{{ route('superuser.data-jurusan.destroy', $jurusan->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jurusan ini?')" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" title="Hapus">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-4 px-4 text-center text-gray-500">Belum ada jurusan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="mt-4" id="pagination-container">
            {{ $jurusans->links() }}
        </div>
    </div>
</div>
@endsection
