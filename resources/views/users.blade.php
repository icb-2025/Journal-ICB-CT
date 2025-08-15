@extends('layouts.user')

@section('title','Data Siswa')

@section('content')
<div class="flex items-center justify-center min-h-[calc(100vh-200px)]">
    <div class="w-full max-w-5xl p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4">Data Siswa</h2>

        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-4 py-2">Nama Lengkap</th>
                    <th class="border border-gray-300 px-4 py-2">NIS</th>
                    <th class="border border-gray-300 px-4 py-2">Tempat Lahir</th>
                    <th class="border border-gray-300 px-4 py-2">Tanggal Lahir</th>
                    <th class="border border-gray-300 px-4 py-2">Golongan Darah</th>
                    <th class="border border-gray-300 px-4 py-2">Sekolah</th>
                    <th class="border border-gray-300 px-4 py-2">Alamat Sekolah</th>
                    <th class="border border-gray-300 px-4 py-2">Telepon Sekolah</th>
                    <th class="border border-gray-300 px-4 py-2">Nama Wali</th>
                    <th class="border border-gray-300 px-4 py-2">Alamat Wali</th>
                    <th class="border border-gray-300 px-4 py-2">Telepon Wali</th>
                    <th class="border border-gray-300 px-4 py-2">Kode Perusahaan</th>
                    <th class="border border-gray-300 px-4 py-2">Jurusan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($siswas as $index => $siswa)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $siswa->nama_lengkap }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $siswa->nis }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $siswa->tempat_lahir }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $siswa->tanggal_lahir }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $siswa->gol_darah }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $siswa->sekolah }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $siswa->alamat_sekolah }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $siswa->telepon_sekolah }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $siswa->nama_wali }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $siswa->alamat_wali }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $siswa->telepon_wali }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $siswa->perusahaan->nama_industri }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $siswa->jurusan->nama_jurusan ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center border border-gray-300 px-4 py-2">Tidak ada data siswa</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $siswas->links() }}
        </div>
    </div>
</div>
@endsection
