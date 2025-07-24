@extends('layouts.guru')

@section('title', 'Data Kategori')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Data Kategori Tugas</h1>
    
    <!-- Search and Filter Section -->
    <div class="mb-6 bg-white p-4 rounded-lg shadow">
        <div class="flex flex-col md:flex-row gap-4">
            <input type="text" placeholder="Cari tugas..." class="flex-grow px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <select class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Semua Kategori</option>
                <option value="pembelajaran">Pembelajaran</option>
                <option value="perencanaan">Perencanaan</option>
                <!-- Add other categories as options -->
            </select>
            <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Cari</button>
        </div>
    </div>

    <!-- Categories Grid -->
    <div class="grid grid-cols-1 gap-6">
        <!-- Category A -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden border-l-4 border-blue-500">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-gray-800">A. Pembelajaran dan Eksplorasi</h2>
                    <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">Active</span>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div class="flex items-start p-3 bg-gray-50 rounded-lg">
                        <div class="mr-3 mt-1">
                            <div class="w-6 h-6 bg-blue-100 text-blue-800 rounded-full flex items-center justify-center text-xs font-medium">1</div>
                        </div>
                        <div>
                            <p class="font-medium">Mempelajari teknologi baru</p>
                            <p class="text-sm text-gray-500">React, Laravel, API, Git</p>
                        </div>
                    </div>
                    <div class="flex items-start p-3 bg-gray-50 rounded-lg">
                        <div class="mr-3 mt-1">
                            <div class="w-6 h-6 bg-blue-100 text-blue-800 rounded-full flex items-center justify-center text-xs font-medium">2</div>
                        </div>
                        <div>
                            <p class="font-medium">Membaca dokumentasi</p>
                        </div>
                    </div>
                    <!-- Add more items -->
                    <div class="flex items-start p-3 bg-gray-50 rounded-lg">
                        <div class="mr-3 mt-1">
                            <div class="w-6 h-6 bg-blue-100 text-blue-800 rounded-full flex items-center justify-center text-xs font-medium">7</div>
                        </div>
                        <div>
                            <p class="font-medium">Mempelajari keamanan sistem</p>
                            <p class="text-sm text-gray-500">Cybersecurity</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Category B -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden border-l-4 border-green-500">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-gray-800">✅ B. Perencanaan dan Desain</h2>
                    <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">Completed</span>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div class="flex items-start p-3 bg-gray-50 rounded-lg">
                        <div class="mr-3 mt-1">
                            <div class="w-6 h-6 bg-green-100 text-green-800 rounded-full flex items-center justify-center text-xs font-medium">1</div>
                        </div>
                        <div>
                            <p class="font-medium">Membuat wireframe atau mockup UI</p>
                        </div>
                    </div>
                    <!-- Add more items -->
                    <div class="flex items-start p-3 bg-gray-50 rounded-lg">
                        <div class="mr-3 mt-1">
                            <div class="w-6 h-6 bg-green-100 text-green-800 rounded-full flex items-center justify-center text-xs font-medium">6</div>
                        </div>
                        <div>
                            <p class="font-medium">Merancang sistem otentikasi</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Category C -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden border-l-4 border-green-500">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-gray-800">✅ C. Pengembangan / Implementasi</h2>
                    <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">Completed</span>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div class="flex items-start p-3 bg-gray-50 rounded-lg">
                        <div class="mr-3 mt-1">
                            <div class="w-6 h-6 bg-green-100 text-green-800 rounded-full flex items-center justify-center text-xs font-medium">1</div>
                        </div>
                        <div>
                            <p class="font-medium">Membuat UI / tampilan pengguna</p>
                        </div>
                    </div>
                    <!-- Add more items -->
                    <div class="flex items-start p-3 bg-gray-50 rounded-lg">
                        <div class="mr-3 mt-1">
                            <div class="w-6 h-6 bg-green-100 text-green-800 rounded-full flex items-center justify-center text-xs font-medium">10</div>
                        </div>
                        <div>
                            <p class="font-medium">Integrasi dengan layanan pihak ketiga</p>
                            <p class="text-sm text-gray-500">API, Firebase, Midtrans</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Categories (Collapsed for brevity) -->
        <div x-data="{ expanded: false }" class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-gray-800">🧩 Kategori Tambahan</h2>
                    <button @click="expanded = !expanded" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                        <span x-text="expanded ? 'Sembunyikan' : 'Tampilkan'"></span>
                    </button>
                </div>
                <div x-show="expanded" x-transition class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <!-- Refactor -->
                    <div class="flex items-start p-3 bg-gray-50 rounded-lg">
                        <div class="mr-3 mt-1">
                            <div class="w-6 h-6 bg-purple-100 text-purple-800 rounded-full flex items-center justify-center text-xs font-medium">🔄</div>
                        </div>
                        <div>
                            <p class="font-medium">Aktivitas Refactor dan Optimasi</p>
                            <p class="text-sm text-gray-500">Merapikan struktur kode, optimasi</p>
                        </div>
                    </div>
                    <!-- Security -->
                    <div class="flex items-start p-3 bg-gray-50 rounded-lg">
                        <div class="mr-3 mt-1">
                            <div class="w-6 h-6 bg-red-100 text-red-800 rounded-full flex items-center justify-center text-xs font-medium">🔒</div>
                        </div>
                        <div>
                            <p class="font-medium">Keamanan dan Validasi</p>
                            <p class="text-sm text-gray-500">XSS, CSRF, SQL Injection</p>
                        </div>
                    </div>
                    <!-- UI/UX -->
                    <div class="flex items-start p-3 bg-gray-50 rounded-lg">
                        <div class="mr-3 mt-1">
                            <div class="w-6 h-6 bg-yellow-100 text-yellow-800 rounded-full flex items-center justify-center text-xs font-medium">🎨</div>
                        </div>
                        <div>
                            <p class="font-medium">UI/UX</p>
                            <p class="text-sm text-gray-500">Figma, responsive layout</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Uncategorized Section -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden border-l-4 border-gray-300">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-gray-800">Tugas Tanpa Kategori</h2>
                    <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded">Uncategorized</span>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div class="flex items-start p-3 bg-gray-50 rounded-lg">
                        <div class="mr-3 mt-1">
                            <div class="w-6 h-6 bg-gray-200 text-gray-800 rounded-full flex items-center justify-center text-xs font-medium">-</div>
                        </div>
                        <div>
                            <p class="font-medium">Tugas belum terkategori</p>
                            <p class="text-sm text-gray-500">Tambahkan kategori untuk tugas ini</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- AlpineJS for interactivity -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection