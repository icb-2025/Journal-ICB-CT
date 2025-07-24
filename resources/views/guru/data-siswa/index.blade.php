@extends('layouts.guru')

@section('title', 'Data Siswa')

@section('content')
<div class="container px-4 py-6 mx-auto">
    <div class="p-6 bg-white rounded-lg shadow-md">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Data Siswa</h2>
            <div class="flex space-x-3">
                <!-- Export PDF Button -->
                <!-- Excel Export Button -->
                <a href="{{ route('guru.data-siswa.export.excel') }}" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors mr-2">
                    Export Excel
                </a>

                <!-- PDF Export Button -->
                <a href="{{ route('guru.data-siswa.export.pdf') }}" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors">
                    Export PDF
                </a>
                
                <!-- Add Student Button -->
                <a href="{{ route('guru.data-siswa.create') }}" class="flex items-center px-4 py-2 text-white bg-indigo-600 rounded-md hover:bg-indigo-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Tambah Siswa
                </a>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="grid grid-cols-1 gap-4 mb-6 md:grid-cols-3">
            <!-- Search Input -->
            <div>
                <label for="search" class="block text-sm font-medium text-gray-700">Cari Siswa</label>
                <input type="text" id="search" name="search" placeholder="Cari berdasarkan nama atau NIS..." 
                       class="w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <!-- Golongan Darah Filter -->
            <div>
                <label for="gol_darah" class="block text-sm font-medium text-gray-700">Golongan Darah</label>
                <select id="gol_darah" name="gol_darah" class="w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">Semua Golongan Darah</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="AB">AB</option>
                    <option value="O">O</option>
                </select>
            </div>

            <!-- Sekolah Filter -->
            <div>
                <label for="sekolah" class="block text-sm font-medium text-gray-700">Sekolah</label>
                <input type="text" id="sekolah" name="sekolah" placeholder="Filter berdasarkan sekolah..." 
                       class="w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            </div>
        </div>

        <!-- Table Section -->
        <div class="overflow-x-auto">
            <div id="table-container">
                @include('guru.data-siswa.partials.table', ['siswas' => $siswas])
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-4" id="pagination-container">
            {{ $siswas->links() }}
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Debounce function untuk menunda eksekusi
    function debounce(func, wait, immediate) {
        var timeout;
        return function() {
            var context = this, args = arguments;
            var later = function() {
                timeout = null;
                if (!immediate) func.apply(context, args);
            };
            var callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func.apply(context, args);
        };
    }

    // Fungsi untuk memuat data dengan AJAX
    function loadData() {
        var search = $('#search').val();
        var gol_darah = $('#gol_darah').val();
        var sekolah = $('#sekolah').val();

        $.ajax({
            url: "{{ route('guru.data-siswa.index') }}",
            type: "GET",
            data: {
                search: search,
                gol_darah: gol_darah,
                sekolah: sekolah
            },
            success: function(response) {
                if (response.html) {
                    $('#table-container').html(response.html);
                    $('#pagination-container').html(response.pagination);
                }
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    }

    // Event listeners untuk filter
    $('#search').on('keyup', debounce(function() {
        loadData();
    }, 500));

    $('#gol_darah, #sekolah').on('change keyup', debounce(function() {
        loadData();
    }, 500));
});
</script>

@endsection