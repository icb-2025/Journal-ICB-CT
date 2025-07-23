<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard Admin</title>
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
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="font-sans bg-gray-50" x-data="{ isSidebarOpen: false }" x-cloak>
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
                <!-- Logo and Brand -->
                <div class="flex items-center p-4 border-b border-indigo-700">
                    <div class="p-2 mr-3 bg-white rounded-full">
                        <img src="/path-to-your-logo.png" alt="Logo" class="w-8 h-8">
                    </div>
                    <h1 class="text-lg font-semibold">Admin Panel</h1>
                </div>

                <nav class="flex-1 mt-4">
                    <!-- Dashboard -->
                    <div class="mb-2">
                        <a href="#" class="flex items-center w-full px-4 py-3 text-left transition duration-150 hover:bg-indigo-700 bg-indigo-700">
                            <i class="fas fa-tachometer-alt w-5 mr-2 text-center"></i>
                            <span>Dashboard</span>
                        </a>
                    </div>

                    <!-- Data Master -->
                    <div x-data="{ open: true }" class="mb-2">
                        <button @click="open = !open" class="flex items-center justify-between w-full px-4 py-3 text-left transition duration-150 hover:bg-indigo-700 focus:outline-none">
                            <span class="flex items-center">
                                <i class="fas fa-database w-5 mr-2 text-center"></i>
                                DATA MASTER
                            </span>
                            <i class="fas fa-chevron-down text-xs transition-transform transform" :class="{ 'rotate-180': open }"></i>
                        </button>

                        <div x-show="open" x-transition class="bg-indigo-900">
                            <a href="{{ route('guru.data-perusahaan.index') }}" class="flex items-center block px-8 py-2 transition duration-150 hover:bg-indigo-700">
                                <i class="fas fa-building w-4 mr-2 text-center"></i>
                                Data Perusahaan
                            </a>
                            <a href="{{ route('guru.data-user.index') }}" class="flex items-center block px-8 py-2 transition duration-150 hover:bg-indigo-700">
                                <i class="fas fa-users w-4 mr-2 text-center"></i>
                                Data User
                            </a>
                            <a href="{{ route('guru.data-siswa.index') }}" class="flex items-center block px-8 py-2 transition duration-150 hover:bg-indigo-700">
                                <i class="fas fa-user-graduate w-4 mr-2 text-center"></i>
                                Data Siswa
                            </a>
                        </div>
                    </div>

                    <!-- Other Menu Items -->
                    <div x-data="{ open: false }" class="mb-2">
                        <button @click="open = !open" class="flex items-center justify-between w-full px-4 py-3 text-left transition duration-150 hover:bg-indigo-700 focus:outline-none">
                            <span class="flex items-center">
                                <i class="fas fa-file-alt w-5 mr-2 text-center"></i>
                                LAPORAN
                            </span>
                            <i class="fas fa-chevron-down text-xs transition-transform transform" :class="{ 'rotate-180': open }"></i>
                        </button>

                        <div x-show="open" x-transition class="bg-indigo-900">
                            <a href="#" class="flex items-center block px-8 py-2 transition duration-150 hover:bg-indigo-700">
                                <i class="fas fa-chart-line w-4 mr-2 text-center"></i>
                                Laporan Aktivitas
                            </a>
                            <a href="#" class="flex items-center block px-8 py-2 transition duration-150 hover:bg-indigo-700">
                                <i class="fas fa-user-check w-4 mr-2 text-center"></i>
                                Laporan Pengguna
                            </a>
                        </div>
                    </div>
                </nav>

                <!-- Profile Section -->
                <div class="mt-auto p-4 border-t border-indigo-700 bg-indigo-900">
                    <div class="flex items-center space-x-3 mb-3">
                        <div class="relative">
                            <div class="flex items-center justify-center w-10 h-10 text-xl font-semibold text-white profile-avatar rounded-full">
                                <img src="/path-to-user-avatar.jpg" alt="User" class="rounded-full w-full h-full object-cover">
                            </div>
                            <span class="absolute bottom-0 right-0 block w-3 h-3 bg-green-500 rounded-full ring-2 ring-indigo-900"></span>
                        </div>
                        <div>
                            <p class="text-sm font-semibold">Admin Name</p>
                            <p class="text-xs text-indigo-200">admin@example.com</p>
                        </div>
                    </div>
                    <div class="space-y-1">
                        <a href="#" class="flex items-center px-3 py-2 text-sm rounded-lg hover:bg-indigo-700 transition-colors">
                            <i class="fas fa-user-cog w-5 mr-2 text-center"></i>
                            <span>Profil Saya</span>
                        </a>
                        <a href="#" class="flex items-center px-3 py-2 text-sm rounded-lg hover:bg-indigo-700 transition-colors">
                            <i class="fas fa-sign-out-alt w-5 mr-2 text-center"></i>
                            <span>Keluar</span>
                        </a>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Desktop Sidebar -->
        <aside class="hidden w-64 text-white bg-indigo-800 shadow-lg lg:flex lg:flex-shrink-0">
            <div class="flex flex-col w-full h-full">
                <!-- Logo and Brand -->
                <div class="flex items-center p-4 border-b border-indigo-700">
                    <div class="p-2 mr-3 bg-white rounded-full">
                        <img src="/path-to-your-logo.png" alt="Logo" class="w-8 h-8">
                    </div>
                    <h1 class="text-lg font-semibold">Admin Panel</h1>
                </div>

                <nav class="flex-1 mt-4 overflow-y-auto hide-scrollbar">
                    <!-- Dashboard -->
                    <div class="mb-2">
                        <a href="#" class="flex items-center w-full px-4 py-3 text-left transition duration-150 hover:bg-indigo-700 bg-indigo-700">
                            <i class="fas fa-tachometer-alt w-5 mr-2 text-center"></i>
                            <span>Dashboard</span>
                        </a>
                    </div>

                    <!-- Data Master -->
                    <div x-data="{ open: true }" class="mb-2">
                        <button @click="open = !open" class="flex items-center justify-between w-full px-4 py-3 text-left transition duration-150 hover:bg-indigo-700 focus:outline-none">
                            <span class="flex items-center">
                                <i class="fas fa-database w-5 mr-2 text-center"></i>
                                DATA MASTER
                            </span>
                            <i class="fas fa-chevron-down text-xs transition-transform transform" :class="{ 'rotate-180': open }"></i>
                        </button>

                        <div x-show="open" x-transition class="bg-indigo-900">
                            <a href="#" class="flex items-center block px-8 py-2 transition duration-150 hover:bg-indigo-700">
                                <i class="fas fa-building w-4 mr-2 text-center"></i>
                                Data Perusahaan
                            </a>
                            <a href="#" class="flex items-center block px-8 py-2 transition duration-150 hover:bg-indigo-700">
                                <i class="fas fa-users w-4 mr-2 text-center"></i>
                                Data User
                            </a>
                            <a href="#" class="flex items-center block px-8 py-2 transition duration-150 hover:bg-indigo-700">
                                <i class="fas fa-chalkboard-teacher w-4 mr-2 text-center"></i>
                                Data Guru
                            </a>
                            <a href="#" class="flex items-center block px-8 py-2 transition duration-150 hover:bg-indigo-700">
                                <i class="fas fa-user-graduate w-4 mr-2 text-center"></i>
                                Data Siswa
                            </a>
                        </div>
                    </div>

                    <!-- Other Menu Items -->
                    <div x-data="{ open: false }" class="mb-2">
                        <button @click="open = !open" class="flex items-center justify-between w-full px-4 py-3 text-left transition duration-150 hover:bg-indigo-700 focus:outline-none">
                            <span class="flex items-center">
                                <i class="fas fa-file-alt w-5 mr-2 text-center"></i>
                                LAPORAN
                            </span>
                            <i class="fas fa-chevron-down text-xs transition-transform transform" :class="{ 'rotate-180': open }"></i>
                        </button>

                        <div x-show="open" x-transition class="bg-indigo-900">
                            <a href="#" class="flex items-center block px-8 py-2 transition duration-150 hover:bg-indigo-700">
                                <i class="fas fa-chart-line w-4 mr-2 text-center"></i>
                                Laporan Aktivitas
                            </a>
                            <a href="#" class="flex items-center block px-8 py-2 transition duration-150 hover:bg-indigo-700">
                                <i class="fas fa-user-check w-4 mr-2 text-center"></i>
                                Laporan Pengguna
                            </a>
                        </div>
                    </div>
                </nav>

                <!-- Profile Section -->
                <div class="mt-auto p-4 border-t border-indigo-700 bg-indigo-900">
                    <div class="flex items-center space-x-3 mb-3">
                        <div class="relative">
                            <div class="flex items-center justify-center w-10 h-10 text-xl font-semibold text-white profile-avatar rounded-full">
                                <img src="/path-to-user-avatar.jpg" alt="User" class="rounded-full w-full h-full object-cover">
                            </div>
                            <span class="absolute bottom-0 right-0 block w-3 h-3 bg-green-500 rounded-full ring-2 ring-indigo-900"></span>
                        </div>
                        <div>
                            <p class="text-sm font-semibold">Admin Name</p>
                            <p class="text-xs text-indigo-200">admin@example.com</p>
                        </div>
                    </div>
                    <div class="space-y-1">
                        <a href="#" class="flex items-center px-3 py-2 text-sm rounded-lg hover:bg-indigo-700 transition-colors">
                            <i class="fas fa-user-cog w-5 mr-2 text-center"></i>
                            <span>Profil Saya</span>
                        </a>
                        <a href="#" class="flex items-center px-3 py-2 text-sm rounded-lg hover:bg-indigo-700 transition-colors">
                            <i class="fas fa-sign-out-alt w-5 mr-2 text-center"></i>
                            <span>Keluar</span>
                        </a>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex flex-col flex-1 overflow-hidden">
            <!-- Header -->
            <header class="bg-white shadow-sm">
                <div class="flex items-center justify-between p-4">
                    <!-- Mobile menu button -->
                    <button @click="isSidebarOpen = !isSidebarOpen" class="p-2 -ml-2 rounded-md text-gray-500 lg:hidden focus:outline-none">
                        <i class="fas fa-bars text-lg"></i>
                    </button>
                    
                    <!-- Logo and Title -->
                    <div class="flex items-center">
                        <img src="/path-to-your-logo.png" alt="Logo" class="h-8 mr-3 hidden lg:block">
                        <h2 class="text-xl font-semibold text-gray-800">Dashboard</h2>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <!-- Notification -->
                        <button class="p-2 rounded-full hover:bg-gray-100 relative">
                            <i class="fas fa-bell text-gray-500"></i>
                            <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
                        </button>
                        
                        <!-- Profile Dropdown -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
                                <div class="relative">
                                    <div class="flex items-center justify-center w-9 h-9 text-lg font-semibold text-white profile-avatar rounded-full">
                                        <img src="/path-to-user-avatar.jpg" alt="User" class="rounded-full w-full h-full object-cover">
                                    </div>
                                    <span class="absolute bottom-0 right-0 block w-2.5 h-2.5 bg-green-500 rounded-full ring-2 ring-white"></span>
                                </div>
                                <div class="hidden text-left md:block">
                                    <p class="text-sm font-medium text-gray-700">Admin Name</p>
                                    <p class="text-xs text-gray-500">Admin</p>
                                </div>
                                <i class="fas fa-chevron-down text-xs text-gray-500" :class="{ 'transform rotate-180': open }"></i>
                            </button>
                            
                            <div x-show="open" @click.away="open = false" 
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="transform opacity-100 scale-100"
                                 x-transition:leave-end="transform opacity-0 scale-95"
                                 class="absolute right-0 z-50 w-48 py-1 origin-top-right bg-white rounded-md shadow-lg">
                                <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-user-cog w-5 mr-2 text-center"></i>
                                    <span>Profil Saya</span>
                                </a>
                                <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-cog w-5 mr-2 text-center"></i>
                                    <span>Pengaturan</span>
                                </a>
                                <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-sign-out-alt w-5 mr-2 text-center"></i>
                                    <span>Keluar</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 p-4 overflow-y-auto bg-gray-50">
                <!-- Your content here -->
            </main>
        </div>
    </div>
</body>
</html>