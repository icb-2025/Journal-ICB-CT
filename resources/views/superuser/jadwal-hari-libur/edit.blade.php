@extends('layouts.super')

@section('content')
<div class="p-6 bg-white rounded-lg shadow">
    <h3 class="mb-4 text-lg font-semibold">Edit Jadwal Libur Perusahaan</h3>

    <form action="{{ route('superuser.jadwal-hari-libur.update', $jadwal->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium">Perusahaan</label>
            <select name="perusahaan_id" class="w-full border rounded">
                @foreach($perusahaans as $p)
                    <option value="{{ $p->id }}" {{ $jadwal->perusahaan_id == $p->id ? 'selected' : '' }}>
                        {{ $p->nama_industri }}
                    </option>
                @endforeach
            </select>
        </div>
        @php
    [$mulai, $selesai] = explode('-', $jadwal->hari_libur);
@endphp

<div>
    <label>Mulai Libur</label>
    <select name="mulai_libur" class="w-full border rounded">
        @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'] as $hari)
            <option value="{{ $hari }}" {{ $mulai == $hari ? 'selected' : '' }}>{{ $hari }}</option>
        @endforeach
    </select>
</div>

<div>
    <label>Selesai Libur</label>
    <select name="selesai_libur" class="w-full border rounded">
        @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'] as $hari)
            <option value="{{ $hari }}" {{ $selesai == $hari ? 'selected' : '' }}>{{ $hari }}</option>
        @endforeach
    </select>
</div>
    
        <button type="submit" class="px-4 py-2 text-white bg-indigo-600 rounded hover:bg-indigo-700">Update</button>
        <a href="{{ route('superuser.jadwal-hari-libur.index') }}" 
                        class="ml-2 px-4 py-2 border border-blue-300 rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
                            <i class="fas fa-times mr-1"></i> Batal
        </a>
    </form>
</div>
@endsection
