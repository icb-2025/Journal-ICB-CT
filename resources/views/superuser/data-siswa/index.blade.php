@extends('layouts.super')

@section('title', 'Data Siswa')

@section('content')
<div class="container px-4 py-6 mx-auto">
    <!-- Header with Export Buttons -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Data Siswa</h2>
        <div class="flex space-x-2 mt-4 md:mt-0">
            <a href="{{ route('data-siswa.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 flex items-center transition-colors duration-200">
                <i class="fas fa-plus mr-2"></i> Tambah Data
            </a>
            <a href="{{ route('data-siswa.export.excel') }}" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 flex items-center transition-colors duration-200">
                <i class="fas fa-file-excel mr-2"></i> Export Excel
            </a>
            <a href="{{ route('data-siswa.export.pdf') }}" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 flex items-center transition-colors duration-200">
                <i class="fas fa-file-pdf mr-2"></i> Export PDF
            </a>
        </div>
    </div>

    <div class="p-6 bg-white rounded-lg shadow-md">
        <!-- Search and Filter Section -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div>
                <label for="search" class="block text-sm font-medium text-gray-700">Cari Siswa</label>
                <div class="relative mt-1 rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text" id="search" name="search" placeholder="Cari berdasarkan NIS/Nama..." 
                           class="block w-full pl-10 rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>
            </div>
            <div>
                <label for="gol_darah" class="block text-sm font-medium text-gray-700">Golongan Darah</label>
                <select id="gol_darah" name="gol_darah" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    <option value="">Semua</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="AB">AB</option>
                    <option value="O">O</option>
                </select>
            </div>
            <div>
                <label for="sekolah" class="block text-sm font-medium text-gray-700">Sekolah</label>
                <select id="sekolah" name="sekolah" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    <option value="">Semua</option>
                    <option value="SMK ICB Cinta Teknika">SMK ICB Cinta Teknika</option>
                    <option value="SMA ICB Cinta Bangsa">SMA ICB Cinta Bangsa</option>
                </select>
            </div>
        </div>

        <!-- Table Section -->
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

<!-- Modal View -->
<div id="viewModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <!-- Modal content remains the same -->
</div>

<script>
    // Modal functions remain the same
    function showModal(nis, nama, jenisKelamin, golDarah, tanggalLahir, alamat, sekolah, kelas, namaOrtu, noHpOrtu, status, inputBy) {
        // Existing implementation
    }

    function hideModal() {
        // Existing implementation
    }

    // Close modal handlers remain the same
    window.onclick = function(event) {
        // Existing implementation
    }

    document.onkeydown = function(evt) {
        // Existing implementation
    };
</script>

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Debounce function remains the same
    function debounce(func, wait, immediate) {
        // Existing implementation
    }

    // Enhanced loadData function with better loading state
    function loadData() {
        var search = $('#search').val();
        var gol_darah = $('#gol_darah').val();
        var sekolah = $('#sekolah').val();

        // Show loading indicator with animation
        $('#table-container').html(`
            <div class="text-center py-8 animate-pulse">
                <div class="mx-auto w-12 h-12 rounded-full bg-indigo-100 flex items-center justify-center">
                    <i class="fas fa-spinner fa-spin fa-lg text-indigo-600"></i>
                </div>
                <p class="mt-3 text-gray-600">Memuat data siswa...</p>
            </div>
        `);

        $.ajax({
            url: "{{ route('superuser.data-siswa.index') }}",
            type: "GET",
            data: {
                search: search,
                gol_darah: gol_darah,
                sekolah: sekolah
            },
            success: function(response) {
                $('#table-container').html(response.html);
                $('#pagination-container').html(response.pagination);
                
                // Add smooth transition
                $('#table-container').hide().fadeIn(300);
            },
            error: function(xhr) {
                $('#table-container').html(`
                    <div class="text-center py-8">
                        <div class="mx-auto w-12 h-12 rounded-full bg-red-100 flex items-center justify-center">
                            <i class="fas fa-exclamation-circle fa-lg text-red-600"></i>
                        </div>
                        <p class="mt-3 text-red-600">Gagal memuat data. Silakan coba lagi.</p>
                        <button onclick="loadData()" class="mt-2 px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 text-sm">
                            <i class="fas fa-sync-alt mr-1"></i> Coba Lagi
                        </button>
                    </div>
                `);
                console.error(xhr.responseText);
            }
        });
    }

    // Event listeners with better debounce
    const searchHandler = debounce(loadData, 500);
    
    $('#search').on('keyup', searchHandler);
    $('#gol_darah, #sekolah').on('change', loadData);
});
</script>
@endpush
@endsection 