<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Laravel'))</title>


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* Improved Mobile Sidebar */
        #sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 280px;
            background: white;
            z-index: 50;
            transform: translateX(-100%);
            transition: transform 0.3s ease;
            overflow-y: auto;
        }

        #sidebar.active {
            transform: translateX(0);
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }

        #mobile-sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.5);
            z-index: 40;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }

        #mobile-sidebar-overlay.active {
            opacity: 1;
            pointer-events: auto;
        }

        @media (min-width: 768px) {
            #sidebar {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 280px;
            }
            #mobile-sidebar-overlay {
                display: none !important;
            }
        }

        /* Improved Touch Targets */
        .mobile-tap-target {
            min-width: 48px;
            min-height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Sidebar Content Layout */
        #sidebar .flex-col {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        #sidebar nav {
            flex: 1;
            overflow-y: auto;
            -webkit-overflow-scrolling: touch;
        }

        /* Prevent body scroll when sidebar is open */
        body.sidebar-open {
            overflow: hidden;
            position: fixed;
            width: 100%;
            height: 100%;
        }
    </style>
</head>
<body class="bg-gray-50 font-sans antialiased">
    <!-- Mobile Sidebar Overlay -->
    <div id="mobile-sidebar-overlay" class="fixed inset-0 z-40"></div>

    <!-- Sidebar -->
    <aside id="sidebar" class="fixed z-50 shadow-lg">
        <div class="flex flex-col h-full">
            <!-- Header -->
            <div class="flex items-center justify-between p-4 border-b">
                <a href="/" class="flex items-center space-x-2">
                    <x-application-logo class="h-8 w-auto fill-current text-indigo-600" />
                    <span class="text-xl font-bold">Journal-ICB-CT</span>
                </a>
                <button id="close-sidebar" class="md:hidden mobile-tap-target">
                    <i class="fas fa-times text-gray-500 text-lg"></i>
                </button>
            </div>
        <!-- Sidebar -->
        <aside id="sidebar" class="bg-white text-gray-800 shadow-lg smooth-transition -translate-x-full md:translate-x-0">
            <div class="flex flex-col h-full">
                <!-- Logo & Toggle -->
                <div class="flex items-center justify-between p-4 border-b">
                    <a href="/" class="flex items-center space-x-2">
                        <x-application-logo class="h-8 w-auto fill-current text-indigo-600" />
                        <span class="text-xl font-bold whitespace-nowrap">Journal-ICBCT</span>
                    </a>
                    <button id="close-sidebar" class="md:hidden mobile-tap-target">
                        <i class="fas fa-times text-gray-500 text-lg"></i>
                    </button>
                </div>

            <!-- Navigation -->
            <nav class="flex-1 overflow-y-auto py-4">
                <ul class="space-y-1 px-2">
                    <li>
                        <a href="{{ route('index') }}" class="flex items-center p-4 hover:bg-gray-100 rounded-lg">
                            <i class="fas fa-home w-5 text-center mr-3"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('users') }}" class="flex items-center p-4 hover:bg-gray-100 rounded-lg">
                            <i class="fas fa-users w-5 text-center mr-3"></i>
                            <span>Users</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- User Section -->
            @auth
            <div class="mt-auto p-4 border-t bg-gray-50">
                <div class="flex items-center space-x-3">
                    <div class="relative">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=6366f1&color=fff" 
                            alt="User" class="h-10 w-10 rounded-full border-2 border-indigo-200">
                        <span class="absolute bottom-0 right-0 block h-2.5 w-2.5 rounded-full bg-green-400 ring-2 ring-white"></span>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500">Manage your account</p>
                    </div>
                </div>
                <div class="mt-3 space-y-1">
                    <a href="{{ route('profile.edit') }}" class="flex items-center w-full px-3 py-3 hover:bg-gray-200 rounded-lg">
                        <i class="fas fa-user-circle mr-3 w-5 text-center"></i>
                        <span>Profile Settings</span>
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center w-full px-3 py-3 bg-red-500 text-white rounded-lg">
                            <i class="fas fa-sign-out-alt mr-3 w-5 text-center"></i>
                            <span>Sign Out</span>
                        </button>
                    </form>
                </div>
            </div>
            @endauth
        </div>
    </aside>
                <!-- User Section -->
                @auth
                <div class="mt-auto p-4 border-t bg-gray-50">
                    <div class="flex items-center space-x-3">
                        <div class="relative">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=6366f1&color=fff" 
                                alt="User" class="h-10 w-10 rounded-full border-2 border-indigo-200">
                            <span class="absolute bottom-0 right-0 block h-2.5 w-2.5 rounded-full bg-green-400 ring-2 ring-white"></span>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                        </div>
                    </div>
                    <div class="mt-3 space-y-1">
                        <a href="{{ route('profile.edit') }}" class="flex items-center w-full px-3 py-3 hover:bg-gray-200 rounded-lg">
                            <i class="fas fa-user-circle mr-3 w-5 text-center"></i>
                            <span>Profile Settings</span>
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex items-center w-full px-3 py-3 bg-red-500 text-white rounded-lg">
                                <i class="fas fa-sign-out-alt mr-3 w-5 text-center"></i>
                                <span>Sign Out</span>
                            </button>
                        </form>
                    </div>
                </div>
                @endauth
            </div>
        </aside>

    <!-- Main Content -->
    <div class="min-h-screen flex flex-col main-content">
        <!-- Top Navigation -->
        <header class="bg-white shadow-sm sticky top-0 z-30">
            <div class="flex items-center justify-between px-4 py-3">
                <div class="flex items-center">
                    <button id="open-sidebar" class="md:hidden mobile-tap-target" aria-label="Open menu">
                        <i class="fas fa-bars text-gray-600 text-lg"></i>
                    </button>
                    <h1 class="text-lg sm:text-xl font-semibold text-gray-900 ml-2">@yield('title')</h1>
                </div>
                @auth
                <div class="flex items-center space-x-3">
                    <button class="p-2 rounded-full hover:bg-gray-100">
                        <i class="fas fa-bell text-gray-600 text-lg"></i>
                    </button>
                </div>
                @endauth
            </div>
        </header>

        <!-- Page Content -->
        <main class="flex-1 overflow-y-auto p-4 sm:p-6 bg-gray-50">
            <div class="max-w-7xl mx-auto">
                @yield('content')
            </div>
        </main>
    </div>

    <!-- Tambahkan ini sebelum <script> Swal -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Enhanced Sidebar Toggle
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('mobile-sidebar-overlay');
            const openBtn = document.getElementById('open-sidebar');
            const closeBtn = document.getElementById('close-sidebar');
            const body = document.body;

            function toggleSidebar(open) {
                if (open) {
                    sidebar.classList.add('active');
                    overlay.classList.add('active');
                    body.classList.add('sidebar-open');
                } else {
                    sidebar.classList.remove('active');
                    overlay.classList.remove('active');
                    body.classList.remove('sidebar-open');
                }
            }

            // Open sidebar
            openBtn.addEventListener('click', function() {
                toggleSidebar(true);
            });

            // Close sidebar
            closeBtn.addEventListener('click', function() {
                toggleSidebar(false);
            });

            overlay.addEventListener('click', function() {
                toggleSidebar(false);
            });

            // Close when clicking outside on mobile
            document.addEventListener('click', function(e) {
                if (window.innerWidth < 768 && 
                    sidebar.classList.contains('active') && 
                    !sidebar.contains(e.target) && 
                    e.target !== openBtn) {
                    toggleSidebar(false);
                }
            });

            // Handle window resize
            function handleResize() {
                if (window.innerWidth >= 768) {
                    sidebar.classList.remove('active');
                    overlay.classList.remove('active');
                    body.classList.remove('sidebar-open');
                }
            }

            window.addEventListener('resize', handleResize);
        });
    </script>
</body>
</html>