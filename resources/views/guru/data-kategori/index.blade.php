@extends('layouts.guru')

@section('title', 'Data Kategori')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Data Kategori Tugas</h1>

    @if(session('success'))
        <div id="success-message" class="fixed top-4 right-4 z-50 flex items-center p-4 mb-4 text-green-800 bg-green-100 border-l-4 border-green-500 rounded-lg shadow-lg animate-fade-in">
            <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-200 rounded-lg">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <div class="ml-3 text-sm font-medium">
                {{ session('success') }}
            </div>
            <button type="button" onclick="dismissMessage()" class="ml-auto -mx-1.5 -my-1.5 bg-green-100 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex h-8 w-8">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>

        <script>
            // Auto dismiss after 5 seconds
            setTimeout(function() {
                dismissMessage();
            }, 5000);

            function dismissMessage() {
                const message = document.getElementById('success-message');
                if (message) {
                    message.classList.add('animate-fade-out');
                    setTimeout(() => message.remove(), 300); // Wait for animation to finish
                }
            }
        </script>

        <style>
            .animate-fade-in {
                animation: fadeIn 0.3s ease-in-out;
            }
            
            .animate-fade-out {
                animation: fadeOut 0.3s ease-in-out;
            }
            
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(-20px); }
                to { opacity: 1; transform: translateY(0); }
            }
            
            @keyframes fadeOut {
                from { opacity: 1; transform: translateY(0); }
                to { opacity: 0; transform: translateY(-20px); }
            }
        </style>
    @endif

    <!-- Tombol Tambah -->
    <div class="mb-6">
        <a href="{{ route('guru.data-kategori.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Tambah Kategori</a>
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
                            <a href="{{ route('guru.data-kategori.edit', $kategori->id) }}" class="text-blue-600 hover:underline mr-3">Edit</a>
                            <form action="{{ route('guru.data-kategori.destroy', $kategori->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin hapus kategori ini?')">
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
