@extends('layouts.guru')

@section('title', 'Data Siswa')

@section('content')
<div class="container px-4 py-6 mx-auto">
    <div class="p-6 bg-white rounded-lg shadow-md">
        <!-- ... (keep your existing header, buttons, and filter section) ... -->

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

<!-- Modal -->
<div id="viewModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        
        <!-- Modal content -->
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Detail Siswa
                        </h3>
                        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500">NIS:</p>
                                <p class="mt-1 text-sm text-gray-900" id="modal-nis"></p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Nama Lengkap:</p>
                                <p class="mt-1 text-sm text-gray-900" id="modal-nama"></p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Jenis Kelamin:</p>
                                <p class="mt-1 text-sm text-gray-900" id="modal-jenis-kelamin"></p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Golongan Darah:</p>
                                <p class="mt-1 text-sm text-gray-900" id="modal-gol-darah"></p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Tempat, Tanggal Lahir:</p>
                                <p class="mt-1 text-sm text-gray-900" id="modal-tanggal-lahir"></p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Alamat:</p>
                                <p class="mt-1 text-sm text-gray-900" id="modal-alamat"></p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Sekolah:</p>
                                <p class="mt-1 text-sm text-gray-900" id="modal-sekolah"></p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Kelas:</p>
                                <p class="mt-1 text-sm text-gray-900" id="modal-kelas"></p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Nama Orang Tua/Wali:</p>
                                <p class="mt-1 text-sm text-gray-900" id="modal-nama-ortu"></p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">No. HP Orang Tua/Wali:</p>
                                <p class="mt-1 text-sm text-gray-900" id="modal-no-hp-ortu"></p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Status:</p>
                                <p class="mt-1 text-sm text-gray-900" id="modal-status"></p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Input By:</p>
                                <p class="mt-1 text-sm text-gray-900" id="modal-inputby"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" onclick="hideModal()" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function showModal(
        nis, 
        nama, 
        jenisKelamin, 
        golDarah, 
        tanggalLahir, 
        alamat, 
        sekolah, 
        kelas, 
        namaOrtu, 
        noHpOrtu, 
        status,
        inputBy
    ) {
        document.getElementById('modal-nis').textContent = nis;
        document.getElementById('modal-nama').textContent = nama;
        document.getElementById('modal-jenis-kelamin').textContent = jenisKelamin;
        document.getElementById('modal-gol-darah').textContent = golDarah;
        document.getElementById('modal-tanggal-lahir').textContent = tanggalLahir;
        document.getElementById('modal-alamat').textContent = alamat;
        document.getElementById('modal-sekolah').textContent = sekolah;
        document.getElementById('modal-kelas').textContent = kelas;
        document.getElementById('modal-nama-ortu').textContent = namaOrtu;
        document.getElementById('modal-no-hp-ortu').textContent = noHpOrtu;
        document.getElementById('modal-status').textContent = status;
        document.getElementById('modal-inputby').textContent = inputBy;
        
        document.getElementById('viewModal').classList.remove('hidden');
    }

    function hideModal() {
        document.getElementById('viewModal').classList.add('hidden');
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('viewModal');
        if (event.target === modal) {
            hideModal();
        }
    }

    // Close modal with ESC key
    document.onkeydown = function(evt) {
        evt = evt || window.event;
        if (evt.keyCode === 27) {
            hideModal();
        }
    };
</script>

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