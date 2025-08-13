@extends('layouts.super')

@section('content')
<div class="space-y-6">
    <!-- Company Holidays Section -->
    <div class="p-6 bg-white rounded-lg shadow">
        <div class="flex flex-col justify-between mb-6 space-y-4 md:flex-row md:items-center md:space-y-0">
            <h3 class="text-xl font-semibold text-gray-800">Jadwal Libur Perusahaan</h3>
            <div class="flex space-x-3">
                <button onclick="openCompanyModal()" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-700">
                    <i class="mr-2 fas fa-plus"></i>Tambah Libur Perusahaan
                </button>
                <div class="relative">
                    <select id="company-filter" class="block w-full px-4 py-2 text-sm border-gray-300 rounded-md focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Semua Perusahaan</option>
                        <option value="COMP001">Perusahaan A</option>
                        <option value="COMP002">Perusahaan B</option>
                        <option value="COMP003">Perusahaan C</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto border border-gray-200 rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Perusahaan</th>
                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Hari Libur</th>
                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-right text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="font-medium">Perusahaan A</div>
                            <div class="text-sm text-gray-500">COMP001</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="font-medium">17 Agustus 2024</div>
                            <div class="text-sm text-gray-500">Hari Kemerdekaan (Libur Perusahaan)</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex px-2 text-xs font-semibold leading-5 text-red-800 bg-red-100 rounded-full">Libur</span>
                        </td>
                        <td class="px-6 py-4 text-right whitespace-nowrap">
                            <button onclick="openEditCompanyModal()" class="p-1 text-indigo-600 hover:text-indigo-900">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button onclick="confirmDelete('company')" class="p-1 ml-2 text-red-600 hover:text-red-900">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="font-medium">Perusahaan B</div>
                            <div class="text-sm text-gray-500">COMP002</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="font-medium">25 Desember 2024</div>
                            <div class="text-sm text-gray-500">Hari Natal (Libur Nasional)</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">Sesuai Nasional</span>
                        </td>
                        <td class="px-6 py-4 text-right whitespace-nowrap">
                            <button onclick="openEditCompanyModal()" class="p-1 text-indigo-600 hover:text-indigo-900">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button onclick="confirmDelete('company')" class="p-1 ml-2 text-red-600 hover:text-red-900">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- National Holidays Section -->
    <div class="p-6 bg-white rounded-lg shadow">
        <div class="flex flex-col justify-between mb-6 space-y-4 md:flex-row md:items-center md:space-y-0">
            <h3 class="text-xl font-semibold text-gray-800">Jadwal Libur Nasional</h3>
            <div class="flex space-x-3">
                <button onclick="openNationalModal()" class="px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-md hover:bg-green-700">
                    <i class="mr-2 fas fa-plus"></i>Tambah Libur Nasional
                </button>
            </div>
        </div>

        <div class="overflow-x-auto border border-gray-200 rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Tanggal</th>
                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Keterangan</th>
                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-right text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">1 Januari 2024</td>
                        <td class="px-6 py-4">Tahun Baru Masehi</td>
                        <td class="px-6 py-4 text-right whitespace-nowrap">
                            <button onclick="openEditNationalModal()" class="p-1 text-green-600 hover:text-green-900">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button onclick="confirmDelete('national')" class="p-1 ml-2 text-red-600 hover:text-red-900">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">10 April 2024</td>
                        <td class="px-6 py-4">Hari Raya Nyepi</td>
                        <td class="px-6 py-4 text-right whitespace-nowrap">
                            <button onclick="openEditNationalModal()" class="p-1 text-green-600 hover:text-green-900">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button onclick="confirmDelete('national')" class="p-1 ml-2 text-red-600 hover:text-red-900">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modals -->


<script>
    // Modal functions
    function openCompanyModal() {
        // Implementation for opening company holiday modal
        console.log("Open company holiday modal");
    }

    function openEditCompanyModal() {
        // Implementation for editing company holiday
        console.log("Open edit company holiday modal");
    }

    function openNationalModal() {
        // Implementation for opening national holiday modal
        console.log("Open national holiday modal");
    }

    function openEditNationalModal() {
        // Implementation for editing national holiday
        console.log("Open edit national holiday modal");
    }

    function confirmDelete(type) {
        const title = type === 'company' 
            ? 'Hapus Libur Perusahaan?' 
            : 'Hapus Libur Nasional?';
        
        Swal.fire({
            title: title,
            text: "Data akan dihapus permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Dihapus!',
                    'Data libur telah dihapus.',
                    'success'
                );
            }
        });
    }
</script>
@endsection