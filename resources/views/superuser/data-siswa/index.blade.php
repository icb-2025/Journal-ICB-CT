@extends('layouts.super')

@section('title', 'Data Siswa')
@section('page-id', 'data-siswa')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@section('content')
<div class="container px-4 py-6 mx-auto">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Data Siswa</h2>
        
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
    </div>
    
    <div class="flex flex-wrap gap-2 justify-end mb-4">
        <a href="{{ route('superuser.data-siswa.create') }}"
            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 flex items-center transition whitespace-nowrap">
            <i class="fas fa-plus mr-2"></i> Tambah Data
        </a>
        <a href="{{ route('data-siswa.export.excel') }}"
            class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 flex items-center transition whitespace-nowrap">
            <i class="fas fa-file-excel mr-2"></i> Export Excel
        </a>
        <a href="{{ route('data-siswa.export.pdf') }}"
            class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 flex items-center transition whitespace-nowrap">
            <i class="fas fa-file-pdf mr-2"></i> Export PDF
        </a>
    </div>

   <div class="container px-4 py-6 mx-auto">
    <!-- Filter + Table -->
    <div class="bg-white rounded-lg shadow-md p-6">

        <!-- Filter Section -->
        <div id="filter-section" class="mb-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Search Input with Loading Indicator -->
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700">Cari Siswa</label>
                    <div class="relative mt-1">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input type="text" id="search" placeholder="Cari berdasarkan NIS/Nama..."
                            class="block w-full pl-10 pr-10 rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                        <div id="search-loading" class="absolute inset-y-0 right-0 pr-3 flex items-center hidden">
                            <div class="animate-spin rounded-full h-4 w-4 border-b-2 border-gray-400"></div>
                        </div>
                    </div>
                </div>

                <!-- Blood Type Filter -->
                <div>
                    <label for="gol_darah" class="block text-sm font-medium text-gray-700">Golongan Darah</label>
                    <select id="gol_darah" 
                        class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <option value="">Semua</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="AB">AB</option>
                        <option value="O">O</option>
                    </select>
                </div>

                <!-- School Filter -->
                <div>
                    <label for="sekolah" class="block text-sm font-medium text-gray-700">Sekolah</label>
                    <select id="sekolah" 
                        class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <option value="">Semua</option>
                        <option value="SMK ICB Cinta Teknika">SMK ICB Cinta Teknika</option>
                        <option value="SMA ICB Cinta Bangsa">SMA ICB Cinta Bangsa</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Table Section -->
        <div id="table-section" class="overflow-x-auto">
            <!-- Loading State -->
            <div id="loading-indicator" class="hidden flex justify-center items-center py-8">
                <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-blue-500"></div>
            </div>
            
            <!-- Results -->
            <div id="table-content">
                @include('superuser.data-siswa.partials.table', ['siswas' => $siswas])
            </div>
        </div>
        
    </div>
</div>

</div>

<!-- Detail Modal -->
<div id="detailModal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50">
    <div class="bg-white p-6 rounded-lg w-full max-w-md mx-4 relative max-h-[90vh] overflow-y-auto">
        <h2 class="text-xl font-bold mb-4">Detail Siswa</h2>
        <div id="modalContent" class="space-y-3 text-sm text-gray-700"></div>

        <!-- Tombol Tutup -->
        <div class="mt-6 text-right">
            <button onclick="closeModal()" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                <i class="fas fa-times mr-1"></i> Tutup
            </button>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
   // Modal Functions
function showModal(
    nama, nis, ttl, golDarah, sekolah, alamatSekolah, teleponSekolah, 
    namaWali, alamatWali, teleponWali, jurusan, inputBy
) {
    const modal = document.getElementById('detailModal');
    const content = `
        <div class="grid grid-cols-2 gap-2">
            <p class="font-medium">Nama Lengkap:</p>
            <p>${nama}</p>
            
            <p class="font-medium">NIS:</p>
            <p>${nis}</p>
            
            <p class="font-medium">Tempat, Tanggal Lahir:</p>
            <p>${ttl}</p>
            
            <p class="font-medium">Golongan Darah:</p>
            <p>${golDarah}</p>
            
            <p class="font-medium">Sekolah:</p>
            <p>${sekolah}</p>
            
            <p class="font-medium">Alamat Sekolah:</p>
            <p>${alamatSekolah}</p>
            
            <p class="font-medium">Telepon Sekolah:</p>
            <p>${teleponSekolah}</p>
            
            <p class="font-medium">Nama Wali:</p>
            <p>${namaWali}</p>
            
            <p class="font-medium">Alamat Wali:</p>
            <p>${alamatWali}</p>
            
            <p class="font-medium">Telp Wali:</p>
            <p>${teleponWali}</p>
            
            <p class="font-medium">Jurusan:</p>
            <p>${jurusan}</p>
            
            <p class="font-medium">Input by:</p>
            <p>${inputBy}</p>
        </div>
    `;
    document.getElementById('modalContent').innerHTML = content;
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeModal() {
    const modal = document.getElementById('detailModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

// Delete Confirmation
$(document).on('click', '.btn-delete', function(e) {
    e.preventDefault();
    const form = $(this).closest('form');
    
    Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: "Data siswa akan dihapus permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
});
// Enhanced Live Search and Filter
$(document).ready(function() {
    function debounce(func, wait) {
        let timeout;
        return function() {
            const context = this;
            const args = arguments;
            clearTimeout(timeout);
            timeout = setTimeout(function() {
                func.apply(context, args);
            }, wait);
        };
    }

    function loadData(page = 1) {
        const searchTerm = $('#search').val()?.trim() || '';
        const bloodType = $('#gol_darah').val() || '';
        const school = $('#sekolah').val() || '';

        // Show loading state
        $('#table-content').html(`
            <div class="text-center py-8 animate-pulse">
                <div class="mx-auto w-12 h-12 rounded-full bg-indigo-100 flex items-center justify-center">
                    <i class="fas fa-spinner fa-spin fa-lg text-indigo-600"></i>
                </div>
                <p class="mt-3 text-gray-600">Mencari data siswa...</p>
            </div>
        `);

        $.ajax({
            url: '{{ route("superuser.data-siswa.index") }}',
            type: "GET",
            data: {
                page: page,
                search: searchTerm,
                gol_darah: bloodType,
                sekolah: school
            },
            context: this, // Preserve context
            success: function(response) {
                if (response.html) {
                    $('#table-content').hide().html(response.html).fadeIn(300);
                }
                if (response.pagination) {
                    $('#pagination-container').html(response.pagination);
                }
            },
            error: function(xhr) {
                $('#table-content').html(`
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
            }
        });
    }

    // Create debounced version with proper context
    const debouncedLoad = debounce(loadData, 300);

    // Search input events
    $('#search').on('input', function() {
        debouncedLoad.call(this);
    });
    
    // Filter change events
    $('#gol_darah, #sekolah').on('change', function() {
        loadData();
    });

    // Pagination Click Event
    $(document).on('click', '#table-content .pagination a', function(e) {
        e.preventDefault();
        const page = $(this).attr('href').split('page=')[1];
        loadData(page);
    });
    
    // Initial load
    loadData();
});
</script>
@endsection