<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Register</title>

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
    <div class="min-h-screen gradient-bg flex flex-col sm:justify-center items-center p-4">
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
                                    required 
                                    autofocus 
                                    value="{{ old('name') }}"
                                    autocomplete="name"
                                    class="appearance-none block w-full px-4 py-3 border border-gray-300 rounded-lg input-focus focus:outline-none focus:ring-1 focus:ring-indigo-500 placeholder-gray-400 transition duration-150 ease-in-out"
                                    placeholder="John Doe">
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
                                    required 
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

                        <!-- Kode Perusahaan -->
<!-- <div>
    <label for="kode_perusahaan" class="block text-sm font-medium text-gray-700">Filter Perusahaan:</label>
    <select name="kode_perusahaan" id="kode_perusahaan" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
        <option value="">-- Semua Perusahaan --</option>
        @foreach($perusahaans as $perusahaan)
            <option value="{{ $perusahaan->kode_perusahaan }}"
                {{ old('kode_perusahaan', $selectedPerusahaan ?? '') == $perusahaan->kode_perusahaan ? 'selected' : '' }}>
                {{ $perusahaan->nama_industri }}
            </option>
        @endforeach
    </select>
</div>




Nama Jurusan -->
<!-- <div>
    <label for="nama_jurusan" class="block text-sm font-medium text-gray-700 mb-1">Jurusan</label>
    <select name="nama_jurusan" id="nama_jurusan" required
        class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-indigo-500">
        <option value="">-- Pilih Jurusan --</option>
        @foreach ($jurusans as $jurusan)
            <option value="{{ $jurusan->nama_jurusan }}" {{ old('nama_jurusan') == $jurusan->nama_jurusan ? 'selected' : '' }}>
                {{ $jurusan->nama_jurusan }}
            </option>
        @endforeach
    </select>
    <x-input-error :messages="$errors->get('nama_jurusan')" class="mt-1 text-sm text-red-600" />
</div> --> 


                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                            <div class="relative">
                                <input 
                                    id="password" 
                                    name="password" 
                                    type="password" 
                                    required 
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
                                    required 
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

                <div class="mt-8">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-white text-gray-500">
                                Or sign up with
                            </span>
                        </div>
                    </div>

                    <div class="mt-6 grid grid-cols-3 gap-3">
                        <div>
                            <a href="#" class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 transition duration-150 ease-in-out">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M10 0C4.477 0 0 4.477 0 10c0 4.42 2.865 8.166 6.839 9.489.5.092.682-.217.682-.482 0-.237-.008-.866-.013-1.7-2.782.603-3.369-1.342-3.369-1.342-.454-1.155-1.11-1.462-1.11-1.462-.908-.62.069-.608.069-.608 1.003.07 1.531 1.03 1.531 1.03.892 1.529 2.341 1.087 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.11-4.555-4.943 0-1.091.39-1.984 1.029-2.683-.103-.253-.446-1.27.098-2.647 0 0 .84-.269 2.75 1.025A9.564 9.564 0 0110 4.844c.85.004 1.705.114 2.504.336 1.909-1.294 2.747-1.025 2.747-1.025.546 1.377.203 2.394.1 2.647.64.699 1.028 1.592 1.028 2.683 0 3.842-2.339 4.687-4.566 4.933.359.309.678.919.678 1.852 0 1.336-.012 2.415-.012 2.743 0 .267.18.578.688.48C17.14 18.163 20 14.418 20 10c0-5.523-4.477-10-10-10z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>

                        <div>
                            <a href="#" class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 transition duration-150 ease-in-out">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                    <path d="M6.29 18.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0020 3.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.073 4.073 0 01.8 7.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 010 16.407a11.616 11.616 0 006.29 1.84" />
                                </svg>
                            </a>
                        </div>

                        <div>
                            <a href="#" class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 transition duration-150 ease-in-out">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M10 0C4.477 0 0 4.477 0 10c0 4.42 2.865 8.166 6.839 9.489.5.092.682-.217.682-.482 0-.237-.008-.866-.013-1.7-2.782.603-3.369-1.342-3.369-1.342-.454-1.155-1.11-1.462-1.11-1.462-.908-.62.069-.608.069-.608 1.003.07 1.531 1.03 1.531 1.03.892 1.529 2.341 1.087 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.11-4.555-4.943 0-1.091.39-1.984 1.029-2.683-.103-.253-.446-1.27.098-2.647 0 0 .84-.269 2.75 1.025A9.564 9.564 0 0110 4.844c.85.004 1.705.114 2.504.336 1.909-1.294 2.747-1.025 2.747-1.025.546 1.377.203 2.394.1 2.647.64.699 1.028 1.592 1.028 2.683 0 3.842-2.339 4.687-4.566 4.933.359.309.678.919.678 1.852 0 1.336-.012 2.415-.012 2.743 0 .267.18.578.688.48C17.14 18.163 20 14.418 20 10c0-5.523-4.477-10-10-10z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="px-8 py-4 bg-gray-50 border-t border-gray-200 text-center">
                <p class="text-xs text-gray-500">
                    By registering, you agree to our <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">Terms of Service</a> and <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">Privacy Policy</a>.
                </p>
            </div>
        </div>
    </div>
</body>
</html>