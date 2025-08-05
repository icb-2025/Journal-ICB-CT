<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard SuperUser</title>
    @vite('resources/css/app.css')
    <!-- Alpine JS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .sidebar-transition {
            transition: transform 0.3s ease-in-out;
        }
        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .profile-avatar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        @keyframes slideInFromLeft {
            0% {
                transform: translateX(-100%);
                opacity: 0;
            }
            100% {
                transform: translateX(0);
                opacity: 1;
            }
        }
        .animate-slide-in {
            animation: slideInFromLeft 0.5s ease-out forwards;
        }
        
        /* Enhanced school title style with animation */
        .school-title {
            font-size: 1.1rem;
            font-weight: bold;
            color: #ffffff;
            text-align: center;
            margin: 0.5rem 0.5rem 1rem;
            padding: 0.5rem 0;
            background: linear-gradient(90deg, #4f46e5 0%, #7c3aed 50%, #4f46e5 100%);
            position: relative;
            overflow: hidden;
            border-radius: 0.375rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        
        .school-title::before {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            animation: shimmer 3.5s infinite;
        }
        
        @keyframes shimmer {
            0% {
                left: -100%;
            }
            100% {
                left: 100%;
            }
        }
        
        /* Scrolling text animation */
        .scrolling-text-container {
            width: 100%;
            overflow: hidden;
            white-space: nowrap;
            position: relative;
        }
        
        .scrolling-text {
            display: inline-block;
            padding-left: 100%;
            animation: scrollText 18s linear infinite;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
        }
        
        @keyframes scrollText {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(-100%);
            }
        }
    </style>
</head>
<body data-page="@yield('page-id')" class="font-sans bg-gray-50" x-data="{ isSidebarOpen: false }">
    <div class="flex h-screen overflow-hidden">
        <!-- Mobile sidebar backdrop -->
        <div x-show="isSidebarOpen" @click="isSidebarOpen = false" 
             class="fixed inset-0 z-20 bg-black opacity-50 lg:hidden" 
             x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
        </div>

        <!-- Mobile Sidebar -->
        <aside class="fixed inset-y-0 z-30 flex-shrink-0 w-64 text-white bg-indigo-800 shadow-lg sidebar-transition lg:hidden"
               x-show="isSidebarOpen"
               @keydown.escape="isSidebarOpen = false"
               x-transition:enter="transform transition ease-in-out duration-300"
               x-transition:enter-start="-translate-x-full"
               x-transition:enter-end="translate-x-0"
               x-transition:leave="transform transition ease-in-out duration-300"
               x-transition:leave-start="translate-x-0"
               x-transition:leave-end="-translate-x-full">
            <div class="flex flex-col h-full overflow-y-auto hide-scrollbar">
                <div class="flex items-center p-4 border-b border-indigo-700">
                    <div class="p-2 mr-3 bg-indigo-600 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <h1 class="text-lg font-semibold">Panel SuperUser</h1>
                </div>

                <nav class="flex-1 mt-4">
                    <div class="school-title">
                        <div class="scrolling-text-container">
                            <div class="scrolling-text">SMK ICB CINTA TEKNIKA</div>
                        </div>
                    </div>
                    <div x-data="{ open: true }" class="mb-2">
                        <button @click="open = !open" class="flex items-center justify-between w-full px-4 py-3 text-left transition duration-150 hover:bg-indigo-700 focus:outline-none">
                            <span class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                                DATA MASTER
                            </span>
                            <svg class="w-4 h-4 transition-transform transform" :class="{ 'rotate-90': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>

                        <div x-show="open" x-transition class="bg-indigo-900">
                            <a href="{{ route('superuser.data-perusahaan.index') }}" class="flex items-center block px-8 py-2 transition duration-150 hover:bg-indigo-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                                Data Perusahaan
                            </a>
                            <a href="{{ route('superuser.data-user.index') }}" class="flex items-center block px-8 py-2 transition duration-150 hover:bg-indigo-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                                Data User
                            </a>
                            <a href="{{ route('superuser.data-siswa.index') }}" class="flex items-center block px-8 py-2 transition duration-150 hover:bg-indigo-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                Data Siswa
                            </a>
                            <a href="{{ route('superuser.data-kategori.index') }}" class="flex items-center block px-8 py-2 transition duration-150 hover:bg-indigo-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                Data Kategori
                            </a>
                            <a href="{{ route('superuser.data-jurusan.index') }}" class="flex items-center block px-8 py-2 transition duration-150 hover:bg-indigo-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                Data Jurusan
                            </a>
                            <a href="{{ route('superuser.laporan.index') }}" class="flex items-center block px-8 py-2 transition duration-150 hover:bg-indigo-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Laporan
                            </a>
                        </div>
                    </div>
                    <div x-data="{ open: true }" class="mb-2">
  <button @click="open = !open" class="flex items-center justify-between w-full px-4 py-3 text-left transition duration-150 hover:bg-indigo-700 focus:outline-none">
    <span class="flex items-center">
        <!-- Ikon Plus (+) -->
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        Tambah Data
    </span>
    <!-- Panah kanan untuk toggle -->
    <svg class="w-4 h-4 transition-transform transform" :class="{ 'rotate-90': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
    </svg>
</button>

    <div x-show="open" x-transition class="bg-indigo-900">
        <a href="{{ route('superuser.dashboard') }}" class="flex items-center block px-8 py-2 transition duration-150 hover:bg-indigo-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9.75L12 3l9 6.75V21a1.5 1.5 0 01-1.5 1.5H4.5A1.5 1.5 0 013 21V9.75z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 22V12h6v10" />
            </svg>
            Jenis Kegiatan
        </a>
    </div>
                </nav>

                <!-- Enhanced Profile Section -->
                <div class="mt-auto p-4 border-t border-indigo-700 bg-indigo-900">
                    <div class="flex items-center space-x-3 mb-3">
                        <div class="relative">
                            <div class="flex items-center justify-center w-10 h-10 text-xl font-semibold text-white profile-avatar rounded-full">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <span class="absolute bottom-0 right-0 block w-3 h-3 bg-green-500 rounded-full ring-2 ring-indigo-900"></span>
                        </div>
                        <div>
                            <p class="text-sm font-semibold">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-indigo-200">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                    <div class="space-y-1">
                        <a href="{{ route('profile.edit') }}" class="flex items-center px-3 py-2 text-sm rounded-lg hover:bg-indigo-700 transition-colors">
                            <i class="fas fa-user-circle w-5 mr-2 text-center"></i>
                            <span>Profil Saya</span>
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex items-center w-full px-3 py-2 text-sm rounded-lg hover:bg-indigo-700 transition-colors">
                                <i class="fas fa-sign-out-alt w-5 mr-2 text-center"></i>
                                <span>Keluar</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Desktop Sidebar - No toggle button needed -->
        <aside class="hidden w-64 text-white bg-indigo-800 shadow-lg lg:flex lg:flex-shrink-0">
            <div class="flex flex-col w-full h-full">
                <div class="flex items-center p-4 border-b border-indigo-700">
                    <div class="p-2 mr-3 bg-indigo-600 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <h1 class="text-lg font-semibold">Panel SuperUser</h1>
                </div>

                <nav class="flex-1 mt-4">
                    <div class="school-title">
                        <div class="scrolling-text-container">
                            <div class="scrolling-text">SMK ICB CINTA TEKNIKA</div>
                        </div>
                    </div>
                    <div x-data="{ open: true }" class="mb-2">
                        <button @click="open = !open" class="flex items-center justify-between w-full px-4 py-3 text-left transition duration-150 hover:bg-indigo-700 focus:outline-none">
                            <span class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                                DATA MASTER
                            </span>
                            <svg class="w-4 h-4 transition-transform transform" :class="{ 'rotate-90': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>

                        <div x-show="open" x-transition class="bg-indigo-900">
                            <a href="{{ route('superuser.dashboard') }}" class="flex items-center block px-8 py-2 transition duration-150 hover:bg-indigo-700">
                                 <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24"                               stroke="currentColor">
                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9.75L12 3l9 6.75V21a1.5                                1.5 0 01-1.5 1.5H4.5A1.5 1.5 0 013 21V9.75z" />
                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 22V12h6v10" />
                                 </svg>
                                 Dashboard
                            </a>

                            <a href="{{ route('superuser.data-perusahaan.index') }}" class="flex items-center block px-8 py-2 transition duration-150 hover:bg-indigo-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                                Data Perusahaan
                            </a>
                            <a href="{{ route('superuser.data-user.index') }}" class="flex items-center block px-8 py-2 transition duration-150 hover:bg-indigo-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                                Data User
                            </a>
                            <a href="{{route('superuser.data-siswa.index')}}" class="flex items-center block px-8 py-2 transition duration-150 hover:bg-indigo-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                Data Siswa
                            </a>
                            <a href="{{ route('superuser.data-kategori.index') }}" class="flex items-center block px-8 py-2 transition duration-150 hover:bg-indigo-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                Data Kategori
                            </a>
                            <a href="{{ route('superuser.data-jurusan.index') }}" class="flex items-center block px-8 py-2 transition duration-150 hover:bg-indigo-700">
   <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2">
  <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
</svg>
    Data Jurusan
</a>

                            <a href="{{ route('superuser.laporan.index') }}" class="flex items-center block px-8 py-2 transition duration-150 hover:bg-indigo-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Laporan
                            </a>
                        </div>
                    </div>
                    <div x-data="{ open: true }" class="mb-2">
  <button @click="open = !open" class="flex items-center justify-between w-full px-4 py-3 text-left transition duration-150 hover:bg-indigo-700 focus:outline-none">
    <span class="flex items-center">
        <!-- Ikon Plus (+) -->
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        Tambah Data
    </span>
    <!-- Panah kanan untuk toggle -->
    <svg class="w-4 h-4 transition-transform transform" :class="{ 'rotate-90': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
    </svg>
</button>

    <div x-show="open" x-transition class="bg-indigo-900">
        <a href="{{ route('superuser.dashboard') }}" class="flex items-center block px-8 py-2 transition duration-150 hover:bg-indigo-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9.75L12 3l9 6.75V21a1.5 1.5 0 01-1.5 1.5H4.5A1.5 1.5 0 013 21V9.75z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 22V12h6v10" />
            </svg>
            Jenis Kegiatan
        </a>
    </div>
</div>

                </nav>


                <!-- Enhanced Profile Section -->
                <div class="mt-auto p-4 border-t border-indigo-700 bg-indigo-900">
                    <div class="flex items-center space-x-3 mb-3">
                        <div class="relative">
                            <div class="flex items-center justify-center w-10 h-10 text-xl font-semibold text-white profile-avatar rounded-full">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <span class="absolute bottom-0 right-0 block w-3 h-3 bg-green-500 rounded-full ring-2 ring-indigo-900"></span>
                        </div>
                        <div>
                            <p class="text-sm font-semibold">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-indigo-200">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                    <div class="space-y-1">
                        <a href="{{ route('profile.edit') }}" class="flex items-center px-3 py-2 text-sm rounded-lg hover:bg-indigo-700 transition-colors">
                            <i class="fas fa-user-circle w-5 mr-2 text-center"></i>
                            <span>Profil Saya</span>
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex items-center w-full px-3 py-2 text-sm rounded-lg hover:bg-indigo-700 transition-colors">
                                <i class="fas fa-sign-out-alt w-5 mr-2 text-center"></i>
                                <span>Keluar</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex flex-col flex-1 overflow-hidden">
            <!-- Header -->
            <header class="bg-white shadow-sm">
                <div class="flex items-center justify-between p-4">
                    <!-- Mobile menu button (only visible on mobile) -->
                    <button @click="isSidebarOpen = !isSidebarOpen" class="p-2 -ml-2 rounded-md text-gray-500 lg:hidden focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    
                    <h2 class="text-xl font-semibold text-gray-800">@yield('title', 'Dashboard')</h2>
                    <div class="flex items-center space-x-4">
                        <button class="p-2 rounded-full hover:bg-gray-100 relative">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
                        </button>
                        
                        <!-- Enhanced Profile Dropdown -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
                                <div class="relative">
                                    <div class="flex items-center justify-center w-9 h-9 text-lg font-semibold text-white profile-avatar rounded-full">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    </div>
                                    <span class="absolute bottom-0 right-0 block w-2.5 h-2.5 bg-green-500 rounded-full ring-2 ring-white"></span>
                                </div>
                                <div class="hidden text-left md:block">
                                    <p class="text-sm font-medium text-gray-700">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-gray-500">SuperUser</p>
                                </div>
                                <svg class="w-4 h-4 text-gray-500" :class="{ 'transform rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            
                            <div x-show="open" @click.away="open = false" 
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="transform opacity-100 scale-100"
                                 x-transition:leave-end="transform opacity-0 scale-95"
                                 class="absolute right-0 z-50 w-48 py-1 mt-2 origin-top-right bg-white rounded-md shadow-lg">
                                <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-user-circle w-5 mr-2 text-center"></i>
                                    <span>Profil Saya</span>
                                </a>
                                <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-cog w-5 mr-2 text-center"></i>
                                    <span>Pengaturan</span>
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="flex items-center w-full px-4 py-2 text-sm text-left text-gray-700 hover:bg-gray-100">
                                        <i class="fas fa-sign-out-alt w-5 mr-2 text-center"></i>
                                        <span>Keluar</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 p-4 overflow-y-auto bg-gray-50">
                @yield('content')
            </main>
        </div>
    </div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
$(document).ready(function () {
    // Global debounce function
    function debounce(func, wait) {
        let timeout;
        return function () {
            const context = this, args = arguments;
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(context, args), wait);
        };
    }

    // Reusable loader
    const showLoading = (containerSelector, style = 'table') => {
        const loadingHTML = style === 'card' ? `
            <div class="text-center py-8 animate-pulse">
                <div class="mx-auto w-12 h-12 rounded-full bg-indigo-100 flex items-center justify-center">
                    <i class="fas fa-spinner fa-spin fa-lg text-indigo-600"></i>
                </div>
                <p class="mt-3 text-gray-600">Memuat data...</p>
            </div>
        ` : `
            <tr>
                <td colspan="8" class="px-6 py-4 text-center">
                    <div class="flex justify-center items-center space-x-2 text-gray-500">
                        <i class="fas fa-spinner fa-spin"></i>
                        <span>Memuat data...</span>
                    </div>
                </td>
            </tr>
        `;
        $(containerSelector).html(loadingHTML);
    };

    // Reusable error handler
    const showError = (containerSelector, message, style = 'table') => {
        const errorHTML = style === 'card' ? `
            <div class="text-center py-8">
                <div class="mx-auto w-12 h-12 rounded-full bg-red-100 flex items-center justify-center">
                    <i class="fas fa-exclamation-circle fa-lg text-red-600"></i>
                </div>
                <p class="mt-3 text-red-600">${message}</p>
            </div>
        ` : `
            <tr>
                <td colspan="8" class="px-6 py-4 text-center text-red-500">
                    <i class="fas fa-exclamation-circle"></i> ${message}
                </td>
            </tr>
        `;
        $(containerSelector).html(errorHTML);
    };

    // === CONFIGURATIONS PER PAGE ===
    const pages = {
        'data-siswa': {
            url: "{{ route('superuser.data-siswa.index') }}",
            inputs: ['#search', '#gol_darah', '#sekolah'],
            target: '#table-container',
            type: 'card'
        },
        'laporan': {
            url: "{{ route('superuser.laporan.index') }}",
            inputs: ['#search', '#jurusan', '#perusahaan'],
            target: '#table-container tbody',
            type: 'table'
        }
    };

    // DETECT current page using body ID/class or any container
    const currentPage = $('body').data('page'); // e.g., <body data-page="laporan">
    const page = pages[currentPage];

    if (page) {
        const fetchData = debounce(function () {
            // Build data from inputs
            let requestData = {};
            page.inputs.forEach(selector => {
                const input = $(selector);
                if (input.length) requestData[input.attr('id')] = input.val();
            });

            // Show loader
            showLoading(page.target, page.type);

            $.ajax({
                url: page.url,
                type: "GET",
                data: requestData,
                success: function (response) {
                    if (response.success) {
                        if (page.type === 'table') {
                            $('#table-container').html(response.html);
                        } else {
                            $(page.target).html(response.html).hide().fadeIn(300);
                        }
                    } else {
                        showError(page.target, 'Data tidak ditemukan', page.type);
                    }
                },
                error: function (xhr) {
                    console.error(xhr.responseText);
                    showError(page.target, 'Terjadi kesalahan', page.type);
                }
            });
        }, 500);

        // Bind events
        page.inputs.forEach(selector => {
            const input = $(selector);
            if (input.length) {
                if (input.is('input')) {
                    input.on('keyup', fetchData);
                } else {
                    input.on('change', fetchData);
                }
            }
        });
    }
});
</script>

</body>
</html>