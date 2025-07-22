@extends('layouts.guru')

@section('title', 'Data Siswa')

@section('content')
<div class="container px-4 py-6 mx-auto">
    <div class="p-6 bg-white rounded-lg shadow-md">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Data Siswa</h2>
            <div class="flex space-x-3">
                <a href="{{ route('guru.data-siswa.create') }}" class="flex items-center px-4 py-2 text-white bg-indigo-600 rounded-md hover:bg-indigo-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Tambah Siswa
                </a>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">No</th>
                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">NIS</th>
                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Nama Lengkap</th>
                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Tempat, Tanggal Lahir</th>
                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Jenis Kelamin</th>
                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($siswas as $siswa)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $siswa->nis }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $siswa->nama_lengkap }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $siswa->tempat_lahir }}, {{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->format('d M Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $siswa->jenis_kelamin }}</td>
                        <td class="flex px-6 py-4 space-x-2 whitespace-nowrap">
                            <a href="{{ route('guru.data-siswa.show', $siswa->id) }}" class="text-blue-600 hover:text-blue-900" title="Lihat">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                </svg>
                            </a>
                            <a href="{{ route('guru.data-siswa.edit', $siswa->id) }}" class="text-indigo-600 hover:text-indigo-900" title="Edit">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M13.586 3.586a2 2 0 112.828 2.828L14.828 8l-2.828-2.828L13.586 3.586zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                </svg>
                            </a>
                            <form action="{{ route('guru.data-siswa.destroy', $siswa->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus siswa ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" title="Hapus">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">Tidak ada data siswa.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $siswas->links() }}
        </div>
    </div>
</div>
@endsection
