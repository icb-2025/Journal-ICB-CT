@extends('layouts.super')

@section('title', 'Dashboard Super Admin')

@section('content')
<div class="container mx-auto">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2 lg:grid-cols-4">
        <!-- Total Users -->
        <div class="p-6 bg-white rounded-lg shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Pengguna</p>
                    <p class="text-2xl font-semibold text-gray-900">1,234</p>
                </div>
                <div class="p-3 rounded-full bg-indigo-100 text-indigo-600">
                    <i class="fas fa-users text-xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <span class="inline-flex items-center px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">
                    <i class="fas fa-arrow-up mr-1"></i> 12.5%
                </span>
                <span class="ml-2 text-sm text-gray-500">dari bulan lalu</span>
            </div>
        </div>

        <!-- Active Users -->
        <div class="p-6 bg-white rounded-lg shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Pengguna Aktif</p>
                    <p class="text-2xl font-semibold text-gray-900">876</p>
                </div>
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <i class="fas fa-user-check text-xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <span class="inline-flex items-center px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">
                    <i class="fas fa-arrow-up mr-1"></i> 8.3%
                </span>
                <span class="ml-2 text-sm text-gray-500">dari bulan lalu</span>
            </div>
        </div>

        <!-- Recent Activities -->
        <div class="p-6 bg-white rounded-lg shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Aktivitas Hari Ini</p>
                    <p class="text-2xl font-semibold text-gray-900">256</p>
                </div>
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <i class="fas fa-history text-xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <span class="inline-flex items-center px-2 py-1 text-xs font-semibold text-red-800 bg-red-100 rounded-full">
                    <i class="fas fa-arrow-down mr-1"></i> 2.4%
                </span>
                <span class="ml-2 text-sm text-gray-500">dari kemarin</span>
            </div>
        </div>

        <!-- Pending Requests -->
        <div class="p-6 bg-white rounded-lg shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Permintaan Tertunda</p>
                    <p class="text-2xl font-semibold text-gray-900">12</p>
                </div>
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                    <i class="fas fa-clock text-xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <span class="inline-flex items-center px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">
                    <i class="fas fa-arrow-up mr-1"></i> 5.6%
                </span>
                <span class="ml-2 text-sm text-gray-500">dari minggu lalu</span>
            </div>
        </div>
    </div>

    <!-- Recent Activities Table -->
    <div class="p-6 bg-white rounded-lg shadow mb-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900">Aktivitas Terakhir</h3>
            <a href="#" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">Lihat Semua</a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Pengguna</th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Aktivitas</th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Waktu</th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 w-10 h-10">
                                    <div class="flex items-center justify-center w-full h-full font-semibold text-white bg-indigo-500 rounded-full">
                                        J
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">John Doe</div>
                                    <div class="text-sm text-gray-500">Admin</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">Membuat user baru</div>
                            <div class="text-sm text-gray-500">User ID: 123</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">5 menit lalu</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">Berhasil</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 w-10 h-10">
                                    <div class="flex items-center justify-center w-full h-full font-semibold text-white bg-green-500 rounded-full">
                                        S
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">Sarah Smith</div>
                                    <div class="text-sm text-gray-500">Guru</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">Memperbarui data siswa</div>
                            <div class="text-sm text-gray-500">Siswa ID: 456</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">1 jam lalu</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">Berhasil</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 w-10 h-10">
                                    <div class="flex items-center justify-center w-full h-full font-semibold text-white bg-yellow-500 rounded-full">
                                        M
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">Michael Brown</div>
                                    <div class="text-sm text-gray-500">Siswa</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">Mengupload dokumen</div>
                            <div class="text-sm text-gray-500">Dokumen.pdf</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">3 jam lalu</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex px-2 text-xs font-semibold leading-5 text-yellow-800 bg-yellow-100 rounded-full">Pending</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
        <!-- Generate Report -->
        <div class="p-6 bg-white rounded-lg shadow">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Generate Laporan</h3>
                <i class="fas fa-file-export text-xl text-green-600"></i>
            </div>
            <p class="mb-4 text-sm text-gray-600">Buat laporan aktivitas sistem dalam format PDF atau Excel.</p>
            <div class="space-x-3">
                <a href="#" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    <i class="fas fa-file-pdf mr-2"></i> PDF
                </a>
                <a href="#" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    <i class="fas fa-file-excel mr-2"></i> Excel
                </a>
            </div>
        </div>
    </div>
</div>
@endsection