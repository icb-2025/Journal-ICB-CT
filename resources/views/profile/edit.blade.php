@extends('layouts.user')

@section('content')
    {{-- Header --}}
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-800 tracking-tight animate-fade-in-down">
                👤 {{ __('Profile') }}
            </h2>
            <span class="px-3 py-1 text-sm text-white bg-indigo-600 rounded-full shadow animate-bounce">
                Active
            </span>
        </div>
    </x-slot>

    {{-- Content --}}
    <div class="bg-gradient-to-br from-gray-50 to-white min-h-[calc(0vh)]"> {{-- 64px menyesuaikan tinggi header --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-5 pb-2"> {{-- padding atas & bawah minimal --}}
            <div class="bg-white shadow-md rounded-xl p-6 space-y-10 animate-fade-in-up">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    {{-- Profile Info --}}
                    <div class="bg-gray-50 p-4 rounded-lg shadow-inner">
                        @include('profile.partials.update-profile-information-form')
                        @include('profile.partials.delete-user-form')
                    </div>

                    {{-- Update Password --}}
                    <div class="bg-gray-50 p-4 rounded-lg shadow-inner">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
