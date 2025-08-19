@extends('layouts.guru')

@section('title', 'Laporan Aktivitas Siswa')


@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Laporan Aktivitas Siswa</h2>
        <div class="flex flex-wrap gap-2 mt-4 md:mt-0">
            <button id="filter-toggle" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 flex items-center transition-colors duration-200">
                <i class="fas fa-filter mr-2"></i> Filter
            </button>
            <a href="{{ route('laporan.export.excel') }}" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 flex items-center transition-colors duration-200">
                <i class="fas fa-file-excel mr-2"></i> Export Excel
            </a>
            <a href="{{ route('laporan.export.pdf') }}" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 flex items-center transition-colors duration-200">
                <i class="fas fa-file-pdf mr-2"></i> Export PDF
            </a>
        </div>
    </div>

    <!-- Filter Card (Initially hidden) -->
    <div id="filter-card" class="bg-white rounded-lg shadow-md overflow-hidden mb-6 hidden">
        <div class="p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Filter Laporan</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Jurusan -->
                <div>
                    <label for="department" class="block text-sm font-medium text-gray-700 mb-1">Jurusan</label>
                    <select id="department" class="block w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                        <option value="">Semua Jurusan</option>
                        @if(isset($jurusans) && count($jurusans) > 0)
                            @foreach($jurusans as $jurusan)
                                <option value="{{ $jurusan->id }}">{{ $jurusan->nama_jurusan }}</option>
                            @endforeach
                        @else
                            <option value="" disabled>Data jurusan tidak tersedia</option>
                        @endif
                    </select>
                </div>
                <!-- filter perusahaan-->
                <div>
                    <label for="company" class="block text-sm font-medium text-gray-700 mb-1">Perusahaan</label>
                    <select id="company" class="block w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                        <option value="">Semua Perusahaan</option>
                        @foreach($perusahaans as $perusahaan)
                            <option value="{{ $perusahaan->id }}">{{ $perusahaan->nama_industri }}</option>
                        @endforeach
                    </select>
                </div>
                                                
                <!-- Date Range Filter -->
                <div>
                    <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Mulai</label>
                    <input type="date" id="start_date" class="block w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                </div>
                
                <div>
                    <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Akhir</label>
                    <input type="date" id="end_date" class="block w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                </div>
            </div>
            
            <div class="mt-4 flex justify-end">
                <button id="reset-filters" class="mr-2 px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                    Reset Filter
                </button>
                <button id="apply-filters" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700">
                    Terapkan Filter
                </button>
            </div>
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
                <input type="text" id="search" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Cari berdasarkan nama siswa, aktivitas, perusahaan...">
            </div>
            
            <!-- Table Container -->
            <div class="overflow-x-auto">
                <div id="table-container">
                    @include('superuser.laporan.partials.table', ['aktivitas' => $aktivitas])
                </div>
            </div>
            
            <!-- Pagination -->
            @if($aktivitas->hasPages())
            <div class="mt-4">
                {{ $aktivitas->links() }}
            </div>
            @endif
        </div>
    </div>
</div>

@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .filter-transition {
        transition: all 0.3s ease-in-out;
    }
    .btn-spinner {
        display: inline-block;
        width: 1rem;
        height: 1rem;
        border: 2px solid rgba(255,255,255,0.3);
        border-radius: 50%;
        border-top-color: #fff;
        animation: spin 1s ease-in-out infinite;
    }
    @keyframes spin {
        to { transform: rotate(360deg); }
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$(document).ready(function() {
    // Toggle filter card
    $('#filter-toggle').click(function() {
        $('#filter-card').toggleClass('hidden filter-transition');
        $(this).toggleClass('bg-blue-600 bg-blue-700');
    });

    // Loading indicator template
    const loadingHTML = `
        <tr>
            <td colspan="8" class="px-6 py-4 text-center">
                <div class="flex justify-center items-center space-x-2 text-gray-500">
                    <div class="btn-spinner"></div>
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

    // Function to fetch data with filters
    function fetchData() {
        const searchTerm = $('#search').val().trim();
        const department = $('#department').val();
        const company = $('#company').val();
        const startDate = $('#start_date').val();
        const endDate = $('#end_date').val();
        
        const tableBody = $('#table-container tbody');
        const pagination = $('#table-container').next('.mt-4');
        
        // Show loading indicator
        tableBody.html(loadingHTML);
        if(pagination.length) pagination.hide();
        
        $.ajax({
            url: "{{ route('laporan.index') }}",
            type: "GET",
            data: { 
                search: searchTerm,
                department_id: department,
                perusahaan_id: company,
                start_date: startDate,
                end_date: endDate
            },
            success: function(response) {
                if (response.success) {
                    $('#table-container').html(response.html);
                    
                    // Update company dropdown to maintain selection
                    if (company) {
                        $('#company').val(company);
                    }
                    
                    if(response.html.includes('pagination')) {
                        pagination.show();
                    } else {
                        pagination.hide();
                    }
                } else {
                    tableBody.html(errorHTML('Data tidak ditemukan'));
                    pagination.hide();
                }
            },
            error: function(xhr) {
                tableBody.html(errorHTML(xhr.statusText || 'Terjadi kesalahan'));
                pagination.hide();
                console.error('Error:', xhr.responseText);
            }
        });
    }

    // Company dropdown change (TIDAK menutup filter card lagi)
    $('#company').change(function() {
        fetchData();
    });

    // Debounce function to limit API calls
    function debounce(func, wait) {
        let timeout;
        return function() {
            const context = this, args = arguments;
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(context, args), wait);
        };
    }

    // Apply filters button
    $('#apply-filters').click(function() {
        fetchData();
        $('#filter-card').addClass('hidden');
        $('#filter-toggle').removeClass('bg-blue-700').addClass('bg-blue-600');
    });

    // Reset filters button
    $('#reset-filters').click(function() {
        $('#department').val('');
        $('#company').val('').trigger('change'); // reset perusahaan juga
        $('#start_date').val('');
        $('#end_date').val('');
        fetchData();
    });

    // Live search with debounce
    $('#search').on('input', debounce(fetchData, 500));

    // Department filter change
    $('#department').change(debounce(fetchData, 300));

    // Date range filter change
    $('#start_date, #end_date').change(function() {
        if($('#start_date').val() && $('#end_date').val()) {
            fetchData();
        }
    });
});
</script>
@endpush