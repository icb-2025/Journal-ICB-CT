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
        <option value="{{ $p->id }}">{{ $p->nama_industri }}</option>
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

        <button type="submit" class="px-4 py-2 text-white bg-indigo-600 rounded hover:bg-indigo-700">Simpan</button>
    </form>
</div>
@endsection
