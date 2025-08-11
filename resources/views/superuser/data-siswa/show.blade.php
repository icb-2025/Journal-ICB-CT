@extends('layouts.super')

@section('title', 'Detail Siswa')

@section('page-id', 'detail-siswa')

@section('content')
<div class="container px-4 py-6 mx-auto">
    <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-lg p-6">
        <h5 class="text-lg font-semibold mb-6">Detail Siswa</h5>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-6 gap-x-8">
            <div class="flex pb-2 border-b border-gray-200">
                <span class="font-semibold w-32">Nama Lengkap:</span>
                <span>{{ $siswa->nama_lengkap }}</span>
            </div>
            <div class="flex pb-2 border-b border-gray-200">
                <span class="font-semibold w-32">NIS:</span>
                <span>{{ $siswa->nis }}</span>
            </div>

            <div class="flex pb-2 border-b border-gray-200">
                <span class="font-semibold w-32">Tempat Lahir:</span>
                <span>{{ $siswa->tempat_lahir }}</span>
            </div>
            <div class="flex pb-2 border-b border-gray-200">
                <span class="font-semibold w-32">Tanggal Lahir:</span>
                <span>{{ $siswa->tanggal_lahir }}</span>
            </div>

            <div class="flex pb-2 border-b border-gray-200">
                <span class="font-semibold w-32">Golongan Darah:</span>
                <span>{{ $siswa->gol_darah }}</span>
            </div>
            <div class="flex pb-2 border-b border-gray-200">
                <span class="font-semibold w-32">Sekolah:</span>
                <span>{{ $siswa->sekolah }}</span>
            </div>

            <div class="flex pb-2 border-b border-gray-200">
                <span class="font-semibold w-32">Alamat Sekolah:</span>
                <span>{{ $siswa->alamat_sekolah }}</span>
            </div>
            <div class="flex pb-2 border-b border-gray-200">
                <span class="font-semibold w-32">Telepon Sekolah:</span>
                <span>{{ $siswa->telp_sekolah }}</span>
            </div>

            <div class="flex pb-2 border-b border-gray-200">
                <span class="font-semibold w-32">Nama Wali:</span>
                <span>{{ $siswa->nama_wali }}</span>
            </div>
            <div class="flex pb-2 border-b border-gray-200">
                <span class="font-semibold w-32">Alamat Wali:</span>
                <span>{{ $siswa->alamat_wali }}</span>
            </div>

            <div class="flex pb-2 border-b border-gray-200">
                <span class="font-semibold w-32">Telepon Wali:</span>
                <span>{{ $siswa->telp_wali }}</span>
            </div>
        </div>

        <div class="mt-6 flex justify-end">
            <a href="{{ route('superuser.data-siswa.index') }}" 
                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 focus:outline-none">
                Tutup
            </a>
        </div>
    </div>
</div>
@endsection
