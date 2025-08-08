@extends('layouts.guru')

@section('title', 'Dashboard Guru')

@section('content')
<div class="min-h-screen bg-gray-100">
    

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <!-- Welcome Card -->
        <div class="bg-white overflow-hidden shadow rounded-lg mb-6">
            <div class="px-4 py-5 sm:p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-indigo-500 rounded-md p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <h2 class="text-2xl font-bold text-gray-900">Selamat datang, {{ Auth::user()->name }}!</h2>
                        <p class="mt-1 text-sm text-gray-500">Semoga hari Anda menyenangkan. Berikut ringkasan aktivitas Anda hari ini.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4 mb-6">
            <!-- Jumlah Kelas -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dt class="text-sm font-medium text-gray-500 truncate">Jumlah Kelas</dt>
                            <dd class="flex items-baseline">
                                <span class="text-2xl font-semibold text-gray-900">5</span>
                            </dd>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Jumlah Siswa -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dt class="text-sm font-medium text-gray-500 truncate">Jumlah Siswa</dt>
                            <dd class="flex items-baseline">
                                <span class="text-2xl font-semibold text-gray-900">120</span>
                            </dd>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Jadwal Hari Ini -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-yellow-500 rounded-md p-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dt class="text-sm font-medium text-gray-500 truncate">Jadwal Hari Ini</dt>
                            <dd class="flex items-baseline">
                                <span class="text-2xl font-semibold text-gray-900">3</span>
                                <span class="ml-2 text-sm text-gray-500">sesi</span>
                            </dd>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tugas Perlu Dinilai -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-red-500 rounded-md p-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dt class="text-sm font-medium text-gray-500 truncate">Tugas Perlu Dinilai</dt>
                            <dd class="flex items-baseline">
                                <span class="text-2xl font-semibold text-gray-900">12</span>
                            </dd>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jadwal Hari Ini dan Aksi Cepat -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Jadwal Hari Ini -->
            <div class="lg:col-span-2">
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Jadwal Mengajar Hari Ini</h3>
                    </div>
                    <div class="bg-white overflow-hidden">
                        <ul class="divide-y divide-gray-200">
                            <li class="px-6 py-4 hover:bg-gray-50">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-indigo-600 truncate">Matematika Kelas X-A</p>
                                        <p class="mt-1 text-sm text-gray-500">08:00 - 09:30</p>
                                    </div>
                                    <div class="ml-2 flex-shrink-0 flex">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Sedang Berlangsung</span>
                                    </div>
                                </div>
                            </li>
                            <li class="px-6 py-4 hover:bg-gray-50">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-indigo-600 truncate">Fisika Kelas XII-IPA</p>
                                        <p class="mt-1 text-sm text-gray-500">10:00 - 11:30</p>
                                    </div>
                                    <div class="ml-2 flex-shrink-0 flex">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Akan Datang</span>
                                    </div>
                                </div>
                            </li>
                            <li class="px-6 py-4 hover:bg-gray-50">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-indigo-600 truncate">Matematika Kelas XI-B</p>
                                        <p class="mt-1 text-sm text-gray-500">13:00 - 14:30</p>
                                    </div>
                                    <div class="ml-2 flex-shrink-0 flex">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Belum Dimulai</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="bg-gray-50 px-4 py-4 sm:px-6 text-right">
                        <a href="#" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">Lihat semua jadwal<span aria-hidden="true"> &rarr;</span></a>
                    </div>
                </div>
            </div>

            <!-- Aksi Cepat -->
            <div>
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Aksi Cepat</h3>
                    </div>
                    <div class="px-4 py-5 sm:p-6">
                        <div class="space-y-4">
                            <a href="{{ route('guru.data-siswa.index') }}" class="group block w-full bg-indigo-50 rounded-lg p-4 hover:bg-indigo-100 transition duration-150">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-indigo-500 rounded-md p-2 group-hover:bg-indigo-600 transition duration-150">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h4 class="text-sm font-medium text-gray-900 group-hover:text-indigo-600">Tambah Siswa Baru</h4>
                                        <p class="text-xs text-gray-500">Tambahkan siswa ke dalam kelas Anda</p>
                                    </div>
                                </div>
                            </a>
                            <a href="#" class="group block w-full bg-green-50 rounded-lg p-4 hover:bg-green-100 transition duration-150">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-green-500 rounded-md p-2 group-hover:bg-green-600 transition duration-150">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h4 class="text-sm font-medium text-gray-900 group-hover:text-green-600">Buat Tugas Baru</h4>
                                        <p class="text-xs text-gray-500">Buat dan berikan tugas kepada siswa</p>
                                    </div>
                                </div>
                            </a>
                            <a href="#" class="group block w-full bg-blue-50 rounded-lg p-4 hover:bg-blue-100 transition duration-150">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-blue-500 rounded-md p-2 group-hover:bg-blue-600 transition duration-150">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h4 class="text-sm font-medium text-gray-900 group-hover:text-blue-600">Lihat Kalender</h4>
                                        <p class="text-xs text-gray-500">Lihat jadwal mengajar Anda</p>
                                    </div>
                                </div>
                            </a>
                            <a href="#" class="group block w-full bg-purple-50 rounded-lg p-4 hover:bg-purple-100 transition duration-150">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-purple-500 rounded-md p-2 group-hover:bg-purple-600 transition duration-150">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h4 class="text-sm font-medium text-gray-900 group-hover:text-purple-600">Input Nilai</h4>
                                        <p class="text-xs text-gray-500">Input nilai tugas atau ujian</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection