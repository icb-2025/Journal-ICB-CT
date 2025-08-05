<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} - Register</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        }
        .input-focus:focus {
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.25);
            border-color: #6366f1;
        }
        .btn-hover:hover {
            background-color: #4338ca;
            transform: translateY(-1px);
        }
    </style>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen gradient-bg flex flex-col sm:justify-center items-center p-1">
        <div class="w-full max-w-md bg-white rounded-xl shadow-2xl overflow-hidden">
            <div class="p-8 sm:p-10">
                <div class="text-center">
                    <a href="/" class="flex justify-center">
                        <x-application-logo class="w-16 h-16 fill-current text-indigo-600" />
                    </a>
                    <h2 class="mt-4 text-2xl font-bold text-gray-900">
                        Create your account
                    </h2>
                    <p class="mt-2 text-sm text-gray-600">
                        Join our community today
                    </p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="mt-8 space-y-6">
                    @csrf

                    <div class="space-y-4">
                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                            <div class="relative">
                                <input 
                                    id="name" 
                                    name="name" 
                                    type="text" 
                                    required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')" 
                                    autofocus 
                                    value="{{ old('name') }}"
                                    autocomplete="name"
                                    class="appearance-none block w-full px-4 py-3 border border-gray-300 rounded-lg input-focus focus:outline-none focus:ring-1 focus:ring-indigo-500 placeholder-gray-400 transition duration-150 ease-in-out"
                                    placeholder="Your Name">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('name')" class="mt-1 text-sm text-red-600" />
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                            <div class="relative">
                                <input 
                                    id="email" 
                                    name="email" 
                                    type="email" 
                                    required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')"
                                    value="{{ old('email') }}"
                                    autocomplete="email"
                                    class="appearance-none block w-full px-4 py-3 border border-gray-300 rounded-lg input-focus focus:outline-none focus:ring-1 focus:ring-indigo-500 placeholder-gray-400 transition duration-150 ease-in-out"
                                    placeholder="your@email.com">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                    </svg>
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-1 text-sm text-red-600" />
    </div>
    <!-- NISN -->
<div>
    <label for="nisn" class="block text-sm font-medium text-gray-700 mb-1">NISN</label>
    <div class="relative">
        <input 
            id="nisn" 
            name="nisn" 
            type="text" 
            required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')" 
            value="{{ old('nisn') }}"
            autocomplete="nisn"
            class="appearance-none block w-full px-4 py-3 border border-gray-300 rounded-lg input-focus focus:outline-none focus:ring-1 focus:ring-indigo-500 placeholder-gray-400 transition duration-150 ease-in-out"
            placeholder="Masukkan NISN kamu">
        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
            </svg>
        </div>
    </div>
    <x-input-error :messages="$errors->get('nisn')" class="mt-1 text-sm text-red-600" />
</div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                            <div class="relative">
                                <input 
                                    id="password" 
                                    name="password" 
                                    type="password" 
                                    required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')"
                                    autocomplete="new-password"
                                    class="appearance-none block w-full px-4 py-3 border border-gray-300 rounded-lg input-focus focus:outline-none focus:ring-1 focus:ring-indigo-500 placeholder-gray-400 transition duration-150 ease-in-out"
                                    placeholder="••••••••">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-1 text-sm text-red-600" />
                            <p class="mt-1 text-xs text-gray-500">Minimum 8 characters</p>
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                            <div class="relative">
                                <input 
                                    id="password_confirmation" 
                                    name="password_confirmation" 
                                    type="password" 
                                    required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')"
                                    autocomplete="new-password"
                                    class="appearance-none block w-full px-4 py-3 border border-gray-300 rounded-lg input-focus focus:outline-none focus:ring-1 focus:ring-indigo-500 placeholder-gray-400 transition duration-150 ease-in-out"
                                    placeholder="••••••••">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-sm text-red-600" />
                        </div>
                    </div>

                    <div class="flex items-center justify-between mt-6">
                        <div class="text-sm">
                            <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-500 transition duration-150 ease-in-out">
                                Already have an account?
                            </a>
                        </div>

                        <button type="submit" class="group relative flex justify-center py-3 px-6 border border-transparent text-sm font-medium rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out btn-hover shadow-md">
                            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            </span>
                            Register
                        </button>
                    </div>
                </form>
            </div>

            <div class="px-4 py-4 bg-gray-50 border-t border-gray-200 text-center">
                <p class="text-xs text-gray-500">
                    By registering, you agree to our <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">Terms of Service</a> and <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">Privacy Policy</a>.
                </p>
            </div>
        </div>
    </div>
</body>
</html>