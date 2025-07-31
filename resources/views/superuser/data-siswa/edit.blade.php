@extends('layouts.super')

@section('title', 'Tambah Siswa')

@section('content')
<div class="container px-4 py-6 mx-auto">
    <div class="p-6 bg-white rounded-lg shadow-md">
        <h2 class="mb-4 text-xl font-semibold">Tambah Data Siswa</h2>

        <form action="{{ route('data-siswa.update', $siswa) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                    <label class="block">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" value="{{ $siswa->nama_lengkap }}" class="w-full p-2 border rounded" required>
                </div>
                <div>
                    <label class="block">NIS</label>
                    <input type="text" name="nis" value="{{ $siswa->nis }}" class="w-full p-2 border rounded" required>
                </div>
                <div>
                    <label class="block">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" value="{{ $siswa->tempat_lahir }}" class="w-full p-2 border rounded" required>
                </div>
                <div>
                    <label class="block">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" value="{{ $siswa->tanggal_lahir }}" class="w-full p-2 border rounded" required>
                </div>
                <div>
                    <label class="block">Golongan Darah</label>
                    <input type="text" name="gol_darah" value="{{ $siswa->gol_darah }}" class="w-full p-2 border rounded">
                </div>
                <div>
                    <label class="block">Sekolah</label>
                    <input type="text" name="sekolah" value="{{ $siswa->sekolah }}" class="w-full p-2 border rounded" required>
                </div>
                <div class="md:col-span-2">
                    <label class="block">Alamat Sekolah</label>
                    <textarea name="alamat_sekolah" class="w-full p-2 border rounded" required>{{ $siswa->alamat_sekolah }}</textarea>
                </div>
                <div>
                    <label class="block">No. Telepon / Faximile</label>
                    <input type="text" name="telepon_sekolah" value="{{ $siswa->telepon_sekolah }}" class="w-full p-2 border rounded">
                </div>
                <div>
                    <label class="block">Nama Orang Tua / Wali</label>
                    <input type="text" name="nama_wali" value="{{ $siswa->nama_wali }}" class="w-full p-2 border rounded" required>
                </div>
                <div class="md:col-span-2">
                    <label class="block">Alamat Orang Tua / Wali</label>
                    <textarea name="alamat_wali" class="w-full p-2 border rounded" required>{{ $siswa->alamat_wali }}</textarea>
                </div>
                <div>
                    <label class="block">No. Telepon Orang Tua / Wali</label>
                    <input type="text" value="{{ $siswa->telepon_wali }}" name="telepon_wali" class="w-full p-2 border rounded">
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="px-6 py-2 text-white bg-indigo-600 rounded hover:bg-indigo-700">
                    Simpan
                </button>
                <a href="{{ route('superuser.data-siswa.index') }}" class="ml-2 text-gray-600 hover:underline">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
