@extends('layouts.super')

@section('title', 'Data Siswa')
@section('page-id', 'data-siswa')

@section('content')
<div class="container px-4 py-6 mx-auto">

    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Data Siswa</h2>

        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif
    </div>

    <!-- Filter & Action Buttons -->
    <div class="p-6 bg-white rounded-lg shadow-md mb-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div>
                <label for="search" class="block text-sm font-medium text-gray-700">Cari Siswa</label>
                <div class="relative mt-1">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text" id="search" placeholder="Cari berdasarkan NIS/Nama..."
                        class="block w-full pl-10 rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                </div>
            </div>

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

        <div class="flex space-x-2">
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

    <!-- Table Data Siswa -->
 <div id="table-container" class="p-6 bg-white rounded-lg shadow-md overflow-x-auto">
    @include('superuser.data-siswa.partials.table', ['siswas' => $siswas])
</div>

</div>

<!-- Modal Detail -->
<div id="detailModal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50">
    <div class="bg-white p-6 rounded-lg w-96 max-w-full mx-4 relative">
        <h2 class="text-xl font-bold mb-4">Detail Siswa</h2>
        <div id="modalContent" class="space-y-2 text-sm text-gray-700"></div>
        <div class="mt-4 flex justify-end">
            <button onclick="closeModal()" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Tutup
            </button>
        </div>
    </div>
</div>

<script>
    function showModal(
        nama, nis, ttl, golDarah, sekolah, alamatSekolah, teleponSekolah, 
        namaWali, alamatWali, teleponWali, jurusan, inputBy
    ) {
        const modal = document.getElementById('detailModal');
        const content = `
            <p><strong>Nama Lengkap:</strong> ${nama}</p>
            <p><strong>NIS:</strong> ${nis}</p>
            <p><strong>Tempat, Tanggal Lahir:</strong> ${ttl}</p>
            <p><strong>Golongan Darah:</strong> ${golDarah}</p>
            <p><strong>Sekolah:</strong> ${sekolah}</p>
            <p><strong>Alamat Sekolah:</strong> ${alamatSekolah}</p>
            <p><strong>Telepon Sekolah:</strong> ${teleponSekolah}</p>
            <p><strong>Nama Wali:</strong> ${namaWali}</p>
            <p><strong>Alamat Wali:</strong> ${alamatWali}</p>
            <p><strong>Telp Wali:</strong> ${teleponWali}</p>
            <p><strong>Jurusan:</strong> ${jurusan}</p>
            <p><strong>Input by:</strong> ${inputBy}</p>
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

    document.addEventListener("DOMContentLoaded", function () {
        const deleteButtons = document.querySelectorAll(".btn-delete");
        deleteButtons.forEach(button => {
            button.addEventListener("click", function (e) {
                e.preventDefault();
                const form = this.closest("form");
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
        });
    });

    $(document).on('click', '#table-container .pagination a', function(e) {
    e.preventDefault();
    let url = $(this).attr('href');

    // Bisa parsing parameter di url dan panggil ajax lagi
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                $('#table-container').html(response.html);
            }
        },
        error: function() {
            alert('Gagal memuat data.');
        }
    });
});

</script>
@endsection
