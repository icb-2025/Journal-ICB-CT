@extends('layouts.super')

@section('title', 'Data Jurusan')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Data Jurusan Tugas</h1>

    @if (session('success'))
            <div 
                id="success-alert" 
                class="mb-4 flex items-center p-4 rounded-lg bg-green-100 border border-green-300 shadow-md animate-fade-in"
            >
                <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" stroke-width="2" 
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" 
                        d="M5 13l4 4L19 7" />
                </svg>
                <span class="text-green-800 font-medium">{{ session('success') }}</span>
            </div>

            <script>
                setTimeout(() => {
                    const alert = document.getElementById('success-alert');
                    if (alert) {
                        alert.classList.add('animate-fade-out');
                        setTimeout(() => alert.remove(), 500); // hapus setelah fade-out
                    }
                }, 2000); // hilang setelah 2 detik
            </script>

            <style>
                @keyframes fadeIn {
                    from { opacity: 0; transform: translateY(-5px); }
                    to { opacity: 1; transform: translateY(0); }
                }
                @keyframes fadeOut {
                    from { opacity: 1; transform: translateY(0); }
                    to { opacity: 0; transform: translateY(-5px); }
                }
                .animate-fade-in {
                    animation: fadeIn 0.3s ease-out;
                }
                .animate-fade-out {
                    animation: fadeOut 0.3s ease-in;
                }
            </style>
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
                            <!-- Edit -->
                                <a href="{{ route('superuser.data-jurusan.edit', $jurusan->id) }}" 
                                   class="text-indigo-600 hover:text-indigo-900 p-1 rounded-full hover:bg-indigo-50 transition-colors" 
                                   title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" 
                                         viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 
                                              2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>

                                <!-- Delete -->
                                <form action="{{ route('superuser.data-jurusan.destroy', $jurusan->id) }}" method="POST" class="form-delete">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn-delete text-red-600 hover:text-red-800 p-1 rounded-full hover:bg-red-50 transition-colors"
                                            title="Delete">
                                            
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" 
                                             viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 
                                                  7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 
                                                  00-1 1v3M4 7h16" />
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