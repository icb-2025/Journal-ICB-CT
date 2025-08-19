@extends('layouts.user')

@section('title', 'Input Kegiatan')

@section('content')
@php
    $isLibur = $isLibur ?? false;
    $statusDefault = $statusDefault ?? 'masuk';
@endphp



@if($isLibur)
    <div class="container mx-auto px-4 py-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-md overflow-hidden mb-6">
            <div class="bg-gradient-to-r from-purple-500 to-purple-600 p-6">
                <h1 class="text-xl sm:text-2xl font-bold text-white">
                    {{ $statusHariIni }}
                </h1>
                <p class="text-purple-100 mt-1 text-sm sm:text-base">
                    @switch($statusHariIni)
                        @case('Libur (Perusahaan)')
                            Hari ini perusahaan menetapkan jadwal libur, Anda tidak perlu mengisi kegiatan harian.
                            @break
                        @case('Libur (Nasional)')
                            Hari ini adalah hari libur nasional, semua kegiatan dihentikan sementara.
                            @break
                        @default
                            Hari ini libur, tidak ada input aktivitas.
                    @endswitch
                </p>
            </div>
            <div class="p-6 text-center">
                <p class="text-gray-700">Silakan kembali pada hari kerja berikutnya.</p>
            </div>
        </div>
    </div>
@else
    @include('partials.index', [
        'perusahaanUser'   => $perusahaanUser ?? null,
        'kategoriTugas'    => $kategoriTugas ?? collect(),
        'sudahInputHariIni'=> $sudahInputHariIni ?? false,
        'aktivitasSiswa'   => $aktivitasSiswa ?? collect(),
        'statusHariIni'    => $statusHariIni ?? 'Masuk',
        'isLibur'          => $isLibur,
        'statusDefault'    => $statusDefault
    ])
@endif

@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection

