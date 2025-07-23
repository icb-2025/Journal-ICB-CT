@extends('layouts.user')

@section('title')

@section('content')
<div class="space-y-6">
    <!-- Welcome Banner with improved design -->
    <div class="bg-gradient-to-r from-indigo-500 to-purple-600 shadow-lg rounded-xl p-6 text-white">
        <div class="flex flex-col md:flex-row items-center justify-between">
            <div class="mb-4 md:mb-0">
                <h2 class="text-2xl md:text-3xl font-bold">
                    Welcome back, {{ Auth::user()->name ?? 'User' }}!
                </h2>
                <p class="mt-2 opacity-90">Here's what's happening with your account today.</p>
                <button class="mt-4 px-4 py-2 bg-white text-indigo-600 rounded-lg font-medium hover:bg-opacity-90 transition-all">
                    View Reports
                </button>
            </div>
            <div class="bg-white bg-opacity-20 p-4 rounded-full backdrop-blur-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9z" clip-rule="evenodd" />
                </svg>
            </div>
        </div>
    </div>
</div>
@endsection