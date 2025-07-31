@extends('layouts.super')

@section('page-id', 'laporan')

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
<!-- Search + Filters (1 Row on Desktop) -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6 items-end">
    <div>
        <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Cari</label>
        <input id="search" type="text" placeholder="Cari nama siswa..." 
            class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 text-sm">
    </div>
    <div>
        <label for="filter-perusahaan" class="block text-sm font-medium text-gray-700 mb-1">Filter Perusahaan</label>
        <select id="perusahaan" class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 text-sm">
            <option value="">Semua Perusahaan</option>
            @foreach($perusahaans as $perusahaan)
                <option value="{{ $perusahaan->nama_industri }}">{{ $perusahaan->nama_industri }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="filter-jurusan" class="block text-sm font-medium text-gray-700 mb-1">Filter Jurusan</label>
        <select id="jurusan" class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 text-sm">
            <option value="">Semua Jurusan</option>
            @foreach($jurusans as $jurusan)
                <option value="{{ $jurusan->nama_jurusan }}">{{ $jurusan->nama_jurusan }}</option>
            @endforeach
        </select>
    </div>
</div>




            <!-- Table Container -->
<div class="overflow-x-auto">
    <!-- Table ONLY will be replaced by AJAX -->
    <div id="table-container">
        <table class="table table-bordered min-w-full divide-y divide-gray-200">
            @include('superuser.laporan.partials.table', ['aktivitas' => $aktivitas])
        </table>
    </div>
</div>

        </div>
    </div>
</div>
@endsection