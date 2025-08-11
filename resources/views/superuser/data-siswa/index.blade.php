@extends('layouts.super')

@section('title', 'Data-Siswa')
@section('page-id', 'data-siswa')

@section('content')
<div class="container px-4 py-6 mx-auto">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Data Siswa</h2>

        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex space-x-2 mt-4 md:mt-0">
            <a href="{{ route('superuser.data-siswa.create') }}"
               class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 flex items-center transition">
                <i class="fas fa-plus mr-2"></i> Tambah Data
            </a>
            <a href="{{ route('data-siswa.export.excel') }}"
               class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 flex items-center transition">
                <i class="fas fa-file-excel mr-2"></i> Export Excel
            </a>
            <a href="{{ route('data-siswa.export.pdf') }}"
               class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 flex items-center transition">
                <i class="fas fa-file-pdf mr-2"></i> Export PDF
            </a>
        </div>
    </div>

    <!-- Filter -->
    <div class="p-6 bg-white rounded-lg shadow-md">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div>
                <label for="search" class="block text-sm font-medium text-gray-700">Cari Siswa</label>
                <div class="relative mt-1">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text" id="search" placeholder="Cari berdasarkan NIS/Nama..."
                           class="block w-full pl-10 rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>
            </div>
            <div>
                <label for="gol_darah" class="block text-sm font-medium text-gray-700">Golongan Darah</label>
                <select id="gol_darah" class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    <option value="">Semua</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="AB">AB</option>
                    <option value="O">O</option>
                </select>
            </div>
            <div>
                <label for="sekolah" class="block text-sm font-medium text-gray-700">Sekolah</label>
                <select id="sekolah" class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    <option value="">Semua</option>
                    <option value="SMK ICB Cinta Teknika">SMK ICB Cinta Teknika</option>
                    <option value="SMA ICB Cinta Bangsa">SMA ICB Cinta Bangsa</option>
                </select>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <div id="table-container">
                @include('superuser.data-siswa.partials.table', ['siswas' => $siswas])
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-4" id="pagination-container">
            {{ $siswas->links() }}
        </div>
    </div>
</div>

<!-- Modal -->
<div id="viewModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black bg-opacity-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-lg max-w-lg w-full p-6 relative">
            <!-- Tombol Tutup -->
            <button type="button" id="closeModal"
                    class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
            <h3 class="text-xl font-semibold mb-4">Detail Siswa</h3>
            <div id="modalContent" class="space-y-2 text-sm">
                <!-- Konten siswa akan di-load via AJAX -->
            </div>
        </div>
    </div>
</div>

<!-- Script -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const viewModal = document.getElementById('viewModal');
    const closeModal = document.getElementById('closeModal');

    // Tutup modal
    closeModal.addEventListener('click', () => {
        viewModal.classList.add('hidden');
    });

    // Event untuk tombol detail siswa
    document.querySelectorAll('.btn-detail').forEach(btn => {
        btn.addEventListener('click', function () {
            const url = this.getAttribute('data-url');
            fetch(url)
                .then(res => res.text())
                .then(html => {
                    document.getElementById('modalContent').innerHTML = html;
                    viewModal.classList.remove('hidden');
                });
        });
    });
});
</script>
@endsection
