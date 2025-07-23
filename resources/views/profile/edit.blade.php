<x-app-layout>
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
    <div class="py-12 bg-gradient-to-br from-gray-50 to-white min-h-screen">
        <div class="mx-auto space-y-10 max-w-7xl sm:px-6 lg:px-8">

            {{-- Card 1: Update Profile --}}
            <div class="p-6 transition transform bg-white shadow-md rounded-xl hover:shadow-xl hover:-translate-y-1 animate-fade-in-up delay-100">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            {{-- Card 2: Update Password --}}
            <div class="p-6 transition transform bg-white shadow-md rounded-xl hover:shadow-xl hover:-translate-y-1 animate-fade-in-up delay-200">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            {{-- Card 3: Delete Account --}}
            <div class="p-6 transition transform bg-white shadow-md rounded-xl hover:shadow-xl hover:-translate-y-1 animate-fade-in-up delay-300">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
