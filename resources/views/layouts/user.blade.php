<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* Enhanced mobile experience */
        @media (max-width: 767px) {
            .mobile-tap-target {
                min-height: 48px;
                min-width: 48px;
            }
            .mobile-text-lg {
                font-size: 1.125rem;
            }
            .mobile-p-3 {
                padding: 0.75rem;
            }
            /* Fixed logout button for mobile */
            .mobile-logout-btn {
                position: fixed;
                bottom: 20px;
                right: 20px;
                z-index: 50;
                background: #ef4444;
                color: white;
                width: 50px;
                height: 50px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }
        }
        
        .smooth-transition {
            transition: all 0.3s ease-in-out;
        }
    </style>
</head>
<body class="bg-gray-50 font-sans antialiased">
    <div class="min-h-screen flex flex-col md:flex-row">
        <!-- Mobile Sidebar Overlay -->
        <div id="mobile-sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 md:hidden hidden opacity-0 smooth-transition"></div>

        <!-- Sidebar -->
        <aside id="sidebar" class="fixed md:relative z-50 w-64 h-screen bg-white text-gray-800 transform -translate-x-full md:translate-x-0 shadow-lg smooth-transition">
            <div class="flex flex-col h-full">
                <!-- Logo & Toggle -->
                <div class="flex items-center justify-between p-4 border-b">
                    <a href="/" class="flex items-center space-x-2">
                        <x-application-logo class="h-8 w-auto fill-current text-indigo-600" />
                        <span class="text-xl font-bold whitespace-nowrap">Journal-ICB-CT</span>
                    </a>
                    <button id="close-sidebar" class="md:hidden p-2 rounded-lg hover:bg-gray-100 mobile-tap-target">
                        <i class="fas fa-times text-gray-500 text-lg"></i>
                    </button>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 overflow-y-auto py-4">
                    <ul class="space-y-1 px-2">
                        <li>
                            <a href="{{ route('index') }}" 
                               class="flex items-center p-3 rounded-lg hover:bg-gray-100 smooth-transition mobile-tap-target mobile-p-3 {{ request()->routeIs('dashboard') ? 'bg-indigo-50 text-indigo-600 border-l-4 border-indigo-600' : '' }}">
                                <i class="fas fa-home w-5 text-center mr-3 mobile-text-lg"></i>
                                <span class="mobile-text-lg">Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('users') }}" 
                               class="flex items-center p-3 rounded-lg hover:bg-gray-100 smooth-transition mobile-tap-target mobile-p-3">
                                <i class="fas fa-users w-5 text-center mr-3 mobile-text-lg"></i>
                                <span class="mobile-text-lg">Users</span>
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
                                alt="User" 
                                class="h-10 w-10 rounded-full border-2 border-indigo-200">
                            <span class="absolute bottom-0 right-0 block h-2.5 w-2.5 rounded-full bg-green-400 ring-2 ring-white"></span>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500">Manage your account</p>
                        </div>
                    </div>
                    <div class="mt-3 space-y-1">
                        <a href="{{ route('profile.edit') }}" 
                        class="flex items-center w-full px-3 py-2 text-sm text-gray-700 hover:bg-gray-200 rounded-lg smooth-transition mobile-tap-target">
                            <i class="fas fa-user-circle mr-3 w-5 text-center mobile-text-lg"></i>
                            <span class="mobile-text-lg">Profile Settings</span>
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex items-center w-full px-3 py-2 text-sm text-gray-700 hover:bg-gray-200 rounded-lg smooth-transition mobile-tap-target">
                                <i class="fas fa-sign-out-alt mr-3 w-5 text-center mobile-text-lg"></i>
                                <span class="mobile-text-lg">Sign Out</span>
                            </button>
                        </form>
                    </div>
                </div>
                @endauth
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Navigation -->
            <header class="bg-white shadow-sm sticky top-0 z-30">
                <div class="flex items-center justify-between px-4 py-3 sm:px-6">
                    <div class="flex items-center">
                        <button id="open-sidebar" class="md:hidden p-2 rounded-lg hover:bg-gray-100 mr-2 mobile-tap-target">
                            <i class="fas fa-bars text-gray-600 text-lg"></i>
                        </button>
                        <h1 class="text-lg sm:text-xl font-semibold text-gray-900">@yield('title')</h1>
                    </div>
                    
                    @auth
                    <div class="flex items-center space-x-3">
                        <button class="p-2 rounded-full hover:bg-gray-100 relative mobile-tap-target">
                            <i class="fas fa-bell text-gray-600 text-lg"></i>
                            <span class="absolute top-0 right-0 h-2 w-2 rounded-full bg-red-500"></span>
                        </button>
                        
                        <!-- Mobile Logout Button (visible only on mobile) -->
                        <div class="md:hidden">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="mobile-logout-btn" title="Sign Out">
                                    <i class="fas fa-sign-out-alt text-white text-xl"></i>
                                </button>
                            </form>
                        </div>
                        
                        <div class="relative hidden md:block">
                            <button id="user-menu-button" class="flex items-center space-x-2 focus:outline-none mobile-tap-target">
                                <span class="hidden sm:inline text-sm font-medium text-gray-700">{{ Auth::user()->name }}</span>
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=6366f1&color=fff" 
                                     alt="User" 
                                     class="h-8 w-8 rounded-full border-2 border-indigo-200">
                            </button>
                        </div>
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
    </div>

    <script>
        // Mobile sidebar toggle
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('mobile-sidebar-overlay');
        const openBtn = document.getElementById('open-sidebar');
        const closeBtn = document.getElementById('close-sidebar');

        // Open sidebar with animation
        if (openBtn) {
            openBtn.addEventListener('click', function() {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
                setTimeout(() => {
                    overlay.classList.add('opacity-100');
                    overlay.classList.remove('opacity-0');
                }, 10);
                document.body.style.overflow = 'hidden';
            });
        }

        // Close sidebar with animation
        function closeSidebar() {
            overlay.classList.add('opacity-0');
            overlay.classList.remove('opacity-100');
            setTimeout(() => {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
                document.body.style.overflow = '';
            }, 300);
        }

        if (closeBtn) {
            closeBtn.addEventListener('click', closeSidebar);
        }

        if (overlay) {
            overlay.addEventListener('click', closeSidebar);
        }

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            if (window.innerWidth < 768 && !sidebar.contains(event.target) && event.target !== openBtn) {
                closeSidebar();
            }
        });

        // Handle window resize
        function handleResize() {
            if (window.innerWidth >= 768) {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.add('hidden');
                overlay.classList.remove('opacity-100');
                document.body.style.overflow = '';
            }
        }

        window.addEventListener('resize', handleResize);

        // Initialize on load
        document.addEventListener('DOMContentLoaded', function() {
            handleResize();
        });
    </script>
</body>
</html>