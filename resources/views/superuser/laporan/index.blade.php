@extends('layouts.super')

@section('title', 'Laporan Aktivitas Siswa')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Laporan Aktivitas Siswa</h2>
        <div class="flex space-x-2 mt-4 md:mt-0">
            <a href="{{ route('laporan.export.excel') }}" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 flex items-center transition-colors duration-200">
                <i class="fas fa-file-excel mr-2"></i> Export Excel
            </a>
            <a href="{{ route('laporan.export.pdf') }}" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 flex items-center transition-colors duration-200">
                <i class="fas fa-file-pdf mr-2"></i> Export PDF
            </a>
        </div>
    </div>

    <!-- Card Container -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="p-6">
            <!-- Search Input -->
            <div class="mb-6 relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
                <input type="text" id="search" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Cari berdasarkan nama siswa, aktivitas...">
            </div>
            
            <!-- Table Container -->
            <div class="overflow-x-auto">
                <div id="table-container">
                    @include('superuser.laporan.partials.table', ['aktivitas' => $aktivitas])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Debounce function to limit API calls
    function debounce(func, wait) {
        let timeout;
        return function() {
            const context = this, args = arguments;
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(context, args), wait);
        };
    }

    // Loading indicator template
    const loadingHTML = `
        <tr>
            <td colspan="8" class="px-6 py-4 text-center">
                <div class="flex justify-center items-center space-x-2 text-gray-500">
                    <i class="fas fa-spinner fa-spin"></i>
                    <span>Memuat data...</span>
                </div>
            </td>
        </tr>
    `;

    // Error template
    const errorHTML = (message) => `
        <tr>
            <td colspan="8" class="px-6 py-4 text-center">
                <div class="flex justify-center items-center space-x-2 text-red-500">
                    <i class="fas fa-exclamation-circle"></i>
                    <span>${message}</span>
                </div>
            </td>
        </tr>
    `;

    // Handle search function
    const handleSearch = debounce(function() {
        const searchTerm = $('#search').val().trim();
        const tableBody = $('#table-container tbody');
        
        // Show loading indicator
        tableBody.html(loadingHTML);
        
        $.ajax({
            url: "{{ route('laporan.index') }}",
            type: "GET",
            data: { search: searchTerm },
            success: function(response) {
                if (response.success) {
                    $('#table-container').html(response.html);
                } else {
                    tableBody.html(errorHTML('Data tidak ditemukan'));
                }
            },
            error: function(xhr) {
                tableBody.html(errorHTML(xhr.statusText || 'Terjadi kesalahan'));
                console.error('Error:', xhr.responseText);
            }
        });
    }, 500); // 500ms delay

    // Event listener
    $('#search').on('input', handleSearch);
});
</script>
@endpush 