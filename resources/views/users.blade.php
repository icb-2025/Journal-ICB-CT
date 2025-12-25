@extends('layouts.user')

@section('title', 'Data Siswa')

@section('content')
<div class="flex items-center justify-center min-h-[calc(100vh-200px)] py-8 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-6xl">
        <!-- Animated Header Section -->
        <div class="text-center mb-12 animate-fade-in-up">
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-800 mb-3">Data Siswa Magang</h2>
            <div class="w-20 h-1 bg-blue-500 mx-auto mb-4 rounded-full"></div>
            <p class="text-gray-600 max-w-2xl mx-auto">Informasi lengkap siswa peserta program magang industri</p>
        </div>

        <!-- Student Cards Grid -->
        <div class="grid grid-cols-1 gap-8">
            @forelse($siswas as $siswa)
                <!-- Student Card with Animation -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-500 transform hover:-translate-y-1 animate-fade-in" data-aos="fade-up">
                    <!-- Card Header with Gradient Background -->
                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-6 relative">
                        <div class="absolute top-0 left-0 w-full h-full opacity-10 bg-white"></div>
                        <div class="relative z-10 flex flex-col md:flex-row md:items-center md:justify-between">
                            <div class="mb-4 md:mb-0">
                                <h3 class="text-2xl font-bold text-white">{{ $siswa->nama_lengkap }}</h3>
                                <p class="text-blue-100 mt-1">NIS: {{ $siswa->nis }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="p-6">
                        <!-- Personal Information Section -->
                        <div class="mb-8">
                            <div class="flex items-center mb-4">
                                <div class="bg-blue-100 p-2 rounded-full mr-3">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <h4 class="text-lg font-semibold text-gray-800">Data Pribadi</h4>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pl-12">
                                <div class="bg-gray-50 rounded-lg p-4 transition-colors duration-300 hover:bg-gray-100">
                                    <p class="text-gray-600 mb-1"><span class="font-medium text-gray-800">Tempat/Tgl Lahir:</span></p>
                                    <p class="text-gray-700">{{ $siswa->tempat_lahir }}, {{ $siswa->tanggal_lahir }}</p>
                                </div>
                                <div class="bg-gray-50 rounded-lg p-4 transition-colors duration-300 hover:bg-gray-100">
                                    <p class="text-gray-600 mb-1"><span class="font-medium text-gray-800">Golongan Darah:</span></p>
                                    <p class="text-gray-700">{{ $siswa->gol_darah ?: '-' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- School Information Section -->
                        <div class="mb-8">
                            <div class="flex items-center mb-4">
                                <div class="bg-blue-100 p-2 rounded-full mr-3">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                </div>
                                <h4 class="text-lg font-semibold text-gray-800">Informasi Sekolah</h4>
                            </div>
                            <div class="bg-blue-50 rounded-lg p-5 pl-12 transition-all duration-300 hover:shadow-inner">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div class="space-y-2">
                                        <p class="font-medium text-gray-800">Nama Sekolah:</p>
                                        <p class="text-gray-700">{{ $siswa->sekolah }}</p>
                                    </div>
                                    <div class="space-y-2">
                                        <p class="font-medium text-gray-800">Alamat:</p>
                                        <p class="text-gray-700">{{ $siswa->alamat_sekolah }}</p>
                                    </div>
                                    <div class="space-y-2">
                                        <p class="font-medium text-gray-800">Telepon:</p>
                                        <p class="text-gray-700">{{ $siswa->telepon_sekolah }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Guardian Information Section -->
                        <div class="mb-8">
                            <div class="flex items-center mb-4">
                                <div class="bg-blue-100 p-2 rounded-full mr-3">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                    </svg>
                                </div>
                                <h4 class="text-lg font-semibold text-gray-800">Data Wali</h4>
                            </div>
                            <div class="bg-blue-50 rounded-lg p-5 pl-12 transition-all duration-300 hover:shadow-inner">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div class="space-y-2">
                                        <p class="font-medium text-gray-800">Nama Wali:</p>
                                        <p class="text-gray-700">{{ $siswa->nama_wali }}</p>
                                    </div>
                                    <div class="space-y-2">
                                        <p class="font-medium text-gray-800">Alamat:</p>
                                        <p class="text-gray-700">{{ $siswa->alamat_wali }}</p>
                                    </div>
                                    <div class="space-y-2">
                                        <p class="font-medium text-gray-800">Telepon:</p>
                                        <p class="text-gray-700">{{ $siswa->telepon_wali }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Internship Information Section -->
                        <div>
                            <div class="flex items-center mb-4">
                                <div class="bg-blue-100 p-2 rounded-full mr-3">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                </div>
                                <h4 class="text-lg font-semibold text-gray-800">Penempatan Magang</h4>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pl-12">
                                <div class="bg-gradient-to-r from-green-50 to-green-100 rounded-lg p-5 border border-green-100 transition-all duration-300 hover:shadow-md hover:border-green-200">
                                    <div class="flex items-start">
                                        <div class="bg-green-100 p-2 rounded-full mr-3 flex-shrink-0">
                                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-medium text-green-800 mb-1">Perusahaan:</p>
                                            <p class="text-gray-700">{{ $siswa->perusahaan->nama_industri }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-gradient-to-r from-purple-50 to-purple-100 rounded-lg p-5 border border-purple-100 transition-all duration-300 hover:shadow-md hover:border-purple-200">
                                    <div class="flex items-start">
                                        <div class="bg-purple-100 p-2 rounded-full mr-3 flex-shrink-0">
                                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-medium text-purple-800 mb-1">Jurusan:</p>
                                            <p class="text-gray-700">{{ $siswa->jurusan->nama_jurusan ?? 'Belum ditentukan' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <!-- Empty State with Animation -->
                <div class="text-center p-12 bg-white rounded-xl shadow-md animate-bounce-in" data-aos="zoom-in">
                    <div class="mx-auto h-24 w-24 text-gray-400 mb-6">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-medium text-gray-900 mb-2">Tidak ada data siswa</h3>
                    <p class="text-gray-500 max-w-md mx-auto">Belum ada siswa yang terdaftar dalam sistem magang industri</p>
                    <div class="mt-6">
                        <a href="#" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300">
                            <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Tambah Siswa
                        </a>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination with Animation -->
        <div class="mt-12 animate-fade-in" data-aos="fade-up">
            {{ $siswas->links() }}
        </div>
    </div>
</div>

<!-- Add AOS animation library -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    // Initialize AOS animation
    AOS.init({
        duration: 800,
        easing: 'ease-in-out',
        once: true
    });
</script>

<!-- Custom Animation CSS -->
<style>
    .animate-fade-in-up {
        animation: fadeInUp 0.8s ease-out;
    }
    
    .animate-fade-in {
        animation: fadeIn 0.8s ease-out;
    }
    
    .animate-bounce-in {
        animation: bounceIn 0.8s ease-out;
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }
    
    @keyframes bounceIn {
        0% {
            opacity: 0;
            transform: scale(0.8);
        }
        50% {
            opacity: 1;
            transform: scale(1.05);
        }
        100% {
            transform: scale(1);
        }
    }
    
    /* Custom hover effects */
    .hover-underline-animation {
        display: inline-block;
        position: relative;
    }
    
    .hover-underline-animation::after {
        content: '';
        position: absolute;
        width: 100%;
        transform: scaleX(0);
        height: 2px;
        bottom: 0;
        left: 0;
        background-color: currentColor;
        transform-origin: bottom right;
        transition: transform 0.25s ease-out;
    }
    
    .hover-underline-animation:hover::after {
        transform: scaleX(1);
        transform-origin: bottom left;
    }
</style>
@endsection