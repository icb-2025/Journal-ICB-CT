@extends('layouts.super')

@section('title', 'Data Perusahaan')

@section('content')
<div class="container px-4 py-6 mx-auto">
    <div class="p-6 bg-white rounded-lg shadow-md">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Data Perusahaan</h2>

            @include('superuser.data-perusahaan.partials.success-alert')

            <div class="flex space-x-3">
                <!-- Tambah Perusahaan Button -->
                <a href="{{ route('superuser.data-perusahaan.create') }}" class="flex items-center px-4 py-2 text-white bg-indigo-600 rounded-md hover:bg-indigo-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Tambah Perusahaan
                </a>
                
                <!-- Excel Export Button -->
                <a href="{{ route('superuser.data-perusahaan.export.excel') }}" class="flex items-center px-4 py-2 text-white bg-green-600 rounded-md hover:bg-green-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Export Excel
                </a>
                
                <!-- PDF Export Button -->
                <a href="{{ route('superuser.data-perusahaan.export.pdf') }}" class="flex items-center px-4 py-2 text-white bg-red-600 rounded-md hover:bg-red-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Export PDF
                </a>
            </div>
        </div>

        @include('superuser.data-perusahaan.partials.table')
    </div>
</div>

@include('superuser.data-perusahaan.partials.modal-view')
@include('superuser.data-perusahaan.partials.delete-script')
@endsection