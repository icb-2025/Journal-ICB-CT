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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        /* Base Styles */
        .smooth-transition {
            transition: all 0.3s ease-out;
        }
        
        /* Desktop Sidebar */
        #sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 16rem;
            overflow-y: auto;
            z-index: 40;
            transform: translateX(0);
        }
        
        .main-content {
            margin-left: 16rem;
        }
        
        /* Mobile Overlay */
        #mobile-sidebar-overlay {
            position: fixed;
            inset: 0;
            background-color: rgba(0,0,0,0.5);
            z-index: 39;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease-out;
        }
        
        /* Mobile Sidebar */
        @media (max-width: 767px) {
            #sidebar {
                width: 80%;
                max-width: 300px;
                transform: translateX(-100%);
                box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            }
            
            #sidebar.-translate-x-full {
                transform: translateX(-100%);
            }
            
            #sidebar:not(.-translate-x-full) {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            #mobile-sidebar-overlay.active {
                opacity: 1;
                pointer-events: auto;
            }
            
            /* Touch targets */
            .mobile-tap-target {
                min-height: 56px;
                min-width: 56px;
                padding: 1rem;
            }
            
            /* Scroll improvement */
            #sidebar nav {
                -webkit-overflow-scrolling: touch;
                overscroll-behavior: contain;
            }
        }
        
        /* Layout Structure */
        html, body {
            height: 100%;
            overflow-x: hidden;
        }
        
        #sidebar .flex-col {
            display: flex;
            flex-direction: column;
            height: 100%;
        }
        
        #sidebar nav {
            flex: 1;
            overflow-y: auto;
        }
    </style>
</head>
<body class="bg-gray-50 font-sans antialiased">
    <div class="min-h-screen flex">
        <!-- Mobile Sidebar Overlay -->
        <div id="mobile-sidebar-overlay" class="smooth-transition"></div>

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
        <div class="flex-1 flex flex-col overflow-hidden main-content">
            <!-- Top Navigation -->
            <header class="bg-white shadow-sm sticky top-0 z-30">
                <div class="flex items-center justify-between px-4 py-3 sm:px-6">
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
                            <span class="sr-only">Notifications</span>
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
    </div>

    <script>
        // Enhanced Sidebar Toggle
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('mobile-sidebar-overlay');
            const openBtn = document.getElementById('open-sidebar');
            const closeBtn = document.getElementById('close-sidebar');
            
            let isSidebarOpen = false;
            let isAnimating = false;

            // Open sidebar
            function openSidebar() {
                if (isSidebarOpen || isAnimating) return;
                
                isAnimating = true;
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.add('active');
                document.body.style.overflow = 'hidden';
                
                setTimeout(() => {
                    isSidebarOpen = true;
                    isAnimating = false;
                }, 300);
            }

            // Close sidebar
            function closeSidebar() {
                if (!isSidebarOpen || isAnimating) return;
                
                isAnimating = true;
                sidebar.classList.add('-translate-x-full');
                overlay.classList.remove('active');
                document.body.style.overflow = '';
                
                setTimeout(() => {
                    isSidebarOpen = false;
                    isAnimating = false;
                }, 300);
            }

            // Event listeners
            if (openBtn) {
                openBtn.addEventListener('click', openSidebar);
                openBtn.addEventListener('touchstart', openSidebar, {passive: true});
            }

            if (closeBtn) {
                closeBtn.addEventListener('click', closeSidebar);
                closeBtn.addEventListener('touchstart', closeSidebar, {passive: true});
            }

            overlay.addEventListener('click', closeSidebar);
            overlay.addEventListener('touchstart', closeSidebar, {passive: true});

            // Close when clicking outside on mobile
            document.addEventListener('click', function(e) {
                if (window.innerWidth < 768 && isSidebarOpen && 
                    !sidebar.contains(e.target) && 
                    e.target !== openBtn) {
                    closeSidebar();
                }
            });

            // Handle window resize
            function handleResize() {
                if (window.innerWidth >= 768) {
                    sidebar.classList.remove('-translate-x-full');
                    overlay.classList.remove('active');
                    document.body.style.overflow = '';
                    isSidebarOpen = true;
                } else {
                    if (!isSidebarOpen) {
                        sidebar.classList.add('-translate-x-full');
                    }
                    overlay.classList.remove('active');
                    isSidebarOpen = false;
                }
                isAnimating = false;
            }

            window.addEventListener('resize', handleResize);
            handleResize();
        });

        // Pagination AJAX
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            let url = $(this).attr('href');
            
            $('#history-container').html(`
                <div class="flex justify-center items-center p-8">
                    <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-500"></div>
                </div>
            `);
            
            $.ajax({
                url: url,
                type: 'get',
                success: function(data) {
                    $('#history-container').html(data);
                },
                error: function() {
                    $('#history-container').html(`
                        <div class="p-4 text-red-500">
                            Failed to load data. Please try again.
                        </div>
                    `);
                }
            });
        });
    </script>
</body>
</html>