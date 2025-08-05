@extends('layouts.guru')

@section('title', 'Data Siswa')

@section('content')
<div class="container px-4 py-6 mx-auto">
    <!-- Header with Export Buttons -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4 md:mb-0">Data Siswa</h2>
        <div class="flex flex-col sm:flex-row sm:space-x-2 space-y-2 sm:space-y-0">
            <a href="{{ route('guru.data-siswa.export.excel') }}" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 flex items-center justify-center transition-colors duration-200">
                <i class="fas fa-file-excel mr-2"></i> Export Excel
            </a>
            <a href="{{ route('guru.data-siswa.export.pdf') }}" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 flex items-center justify-center transition-colors duration-200">
                <i class="fas fa-file-pdf mr-2"></i> Export PDF
            </a>
        </div>
    </div>

    <!-- Search and Filter Card -->
    <div class="p-6 bg-white rounded-lg shadow-md mb-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Search Input -->
            <div>
                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Cari Siswa</label>
                <div class="relative mt-1 rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text" id="search" name="search" placeholder="Cari berdasarkan NIS/Nama..." 
                           class="block w-full pl-10 pr-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            </div>
            
            <!-- Blood Type Filter -->
            <div>
                <label for="gol_darah" class="block text-sm font-medium text-gray-700 mb-1">Golongan Darah</label>
                <select id="gol_darah" name="gol_darah" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                    <option value="">Semua</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="AB">AB</option>
                    <option value="O">O</option>
                </select>
            </div>
            
            <!-- School Filter -->
            <div>
                <label for="sekolah" class="block text-sm font-medium text-gray-700 mb-1">Sekolah</label>
                <select id="sekolah" name="sekolah" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                    <option value="">Semua</option>
                    <option value="SMK ICB Cinta Teknika">SMK ICB Cinta Teknika</option>
                    <option value="SMA ICB Cinta Bangsa">SMA ICB Cinta Bangsa</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Table Card -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <div id="table-container" class="min-w-full divide-y divide-gray-200">
                @include('guru.data-siswa.partials.table', ['siswas' => $siswas])
            </div>
        </div>
        
        <!-- Pagination -->
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200" id="pagination-container">
            {{ $siswas->links() }}
        </div>
    </div>
</div>

<!-- Modal View -->
<div id="viewModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <!-- Modal content remains the same -->
</div>

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Enhanced debounce function
    function debounce(func, wait) {
        let timeout;
        return function() {
            const context = this, args = arguments;
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(context, args), wait);
        };
    }

    // Main data loading function
    function loadData() {
        const searchTerm = $('#search').val()?.trim() || '';
        const bloodType = $('#gol_darah').val() || '';
        const school = $('#sekolah').val() || '';

        // Show loading state
        $('#table-container').html(`
            <div class="text-center py-8 animate-pulse">
                <div class="mx-auto w-12 h-12 rounded-full bg-indigo-100 flex items-center justify-center">
                    <i class="fas fa-spinner fa-spin fa-lg text-indigo-600"></i>
                </div>
                <p class="mt-3 text-gray-600">Mencari data siswa...</p>
            </div>
        `);

        $.ajax({
            url: "{{ route('guru.data-siswa.index') }}",
            type: "GET",
            data: { 
                search: searchTerm,
                gol_darah: bloodType,
                sekolah: school 
            },
            success: function(response) {
                if (response.html) {
                    $('#table-container').hide().html(response.html).fadeIn(300);
                }
                if (response.pagination) {
                    $('#pagination-container').html(response.pagination);
                }
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
                console.error("Error:", xhr.responseText);
            }
        });
    }

    // Initialize with 300ms debounce for better UX
    const debouncedSearch = debounce(loadData, 300);
    
    // Event listeners with existence checks
    if ($('#search').length) {
        $('#search').on('input', debouncedSearch);
    }
    if ($('#gol_darah').length) {
        $('#gol_darah').on('change', loadData);
    }
    if ($('#sekolah').length) {
        $('#sekolah').on('change', loadData);
    }

    // Initial load if table container exists
    if ($('#table-container').length) {
        loadData();
    }
});
</script>
@endpush
@endsection