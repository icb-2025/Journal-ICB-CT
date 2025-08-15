@extends('layouts.super')

@section('content')
<div class="p-6 bg-white rounded-lg shadow">
    <h3 class="mb-4 text-lg font-semibold">Tambah Jadwal Libur Perusahaan</h3>

    <form action="{{ route('superuser.jadwal-hari-libur.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium">Perusahaan</label>
            <select name="perusahaan_id" class="w-full border rounded">
    @foreach($perusahaan as $p)
        <option value="{{ $p->kode_perusahaan }}">{{ $p->nama_industri }}</option>
    @endforeach
</select>


        </div>
      <div>
    <label class="block text-sm font-medium">Mulai Libur</label>
    <select name="mulai_libur" class="w-full border rounded">
        <option>Senin</option><option>Selasa</option><option>Rabu</option>
        <option>Kamis</option><option>Jumat</option><option>Sabtu</option><option>Minggu</option>
    </select>
</div>

<div>
    <label class="block text-sm font-medium">Selesai Libur</label>
    <select name="selesai_libur" class="w-full border rounded">
        <option>Senin</option><option>Selasa</option><option>Rabu</option>
        <option>Kamis</option><option>Jumat</option><option>Sabtu</option><option>Minggu</option>
    </select>
</div>

        <button type="submit" id="simpanDataBtn"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            Tambah
                        </button>
        <a href="{{ route('superuser.jadwal-hari-libur.index') }}" 
                        class="ml-2 px-4 py-2 border border-blue-300 rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
                            <i class="fas fa-times mr-1"></i> Batal
        </a>
    </form>
</div>
@endsection
