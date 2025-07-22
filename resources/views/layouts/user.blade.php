<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }} - @yield('title', 'Dashboard')</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Optional: Tailwind Config -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1e3a8a', // blue-800
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-blue-800 text-white flex flex-col">
            <div class="p-4 border-b border-blue-700">
                <h1 class="text-2xl font-bold">User Panel</h1>
            </div>
            <nav class="flex-1 mt-4 space-y-1">
                <a href="#" class="flex items-center px-4 py-2 hover:bg-blue-700 transition">
                    <i class="fas fa-home mr-3 w-5 text-white"></i>
                    <span>Dashboard</span>
                </a>
                <a href="#" class="flex items-center px-4 py-2 hover:bg-blue-700 transition">
                    <i class="fas fa-tasks mr-3 w-5 text-white"></i>
                    <span>Kegiatan</span>
                </a>
                <a href="#" class="flex items-center px-4 py-2 hover:bg-blue-700 transition">
                    <i class="fas fa-cog mr-3 w-5 text-white"></i>
                    <span>Settings</span>
                </a>
            </nav>
            <div class="p-4 border-t border-blue-700">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center px-4 py-2 hover:bg-blue-700 transition">
                        <i class="fas fa-sign-out-alt mr-3 w-5 text-white"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Topbar -->
            <header class="bg-white shadow flex items-center justify-between px-6 py-4">
                <h2 class="text-xl font-semibold">@yield('title', 'Dashboard')</h2>
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <i class="fas fa-bell text-gray-500 text-lg"></i>
                        <span class="absolute -top-1 -right-1 h-2 w-2 rounded-full bg-red-500"></span>
                    </div>
                    <div class="flex items-center">
                        <img src="https://via.placeholder.com/40" class="h-8 w-8 rounded-full" alt="User">
                        <span class="ml-2 font-medium text-sm">User</span>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Alpine.js (optional) -->
    <script src="//unpkg.com/alpinejs" defer></script>
</body>
</html>
