@extends('layouts.guru')

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
                    @include('guru.laporan.partials.table', ['aktivitas' => $aktivitas])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection