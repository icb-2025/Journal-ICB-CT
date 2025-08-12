<table class="min-w-full divide-y divide-gray-200">
    <thead class="bg-gray-50">
        <tr>
            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">No</th>
            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Nama Lengkap</th>
            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">NIS</th>
            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">TTL</th>
            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Golongan Darah</th>
            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Sekolah</th>
            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Alamat Sekolah</th>
            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Telepon Sekolah</th>
            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Nama Wali</th>
            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Alamat Wali</th>
            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Telp Wali</th>
            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Jurusan</th>
            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Input by</th>
            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Aksi</th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        @forelse($siswas as $siswa)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $siswa->nama_lengkap }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $siswa->nis }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    {{ $siswa->tempat_lahir }}, {{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->format('d M Y') }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $siswa->gol_darah }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $siswa->sekolah }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $siswa->alamat_sekolah }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $siswa->telepon_sekolah }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $siswa->nama_wali }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $siswa->alamat_wali }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $siswa->telepon_wali }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $siswa->jurusan->nama_jurusan ?? '-' }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $siswa->inputBy->name ?? 'System' }}</td>
                <td class="align-middle">
                    <div class="flex items-center justify-center gap-1">
                        <!-- View -->
                        <button
                            onclick='showModal(
                                {!! json_encode($siswa->nama_lengkap) !!},
                                {!! json_encode($siswa->nis) !!},
                                {!! json_encode($siswa->tempat_lahir . ", " . \Carbon\Carbon::parse($siswa->tanggal_lahir)->format("d M Y")) !!},
                                {!! json_encode($siswa->gol_darah) !!},
                                {!! json_encode($siswa->sekolah) !!},
                                {!! json_encode($siswa->alamat_sekolah) !!},
                                {!! json_encode($siswa->telepon_sekolah) !!},
                                {!! json_encode($siswa->nama_wali) !!},
                                {!! json_encode($siswa->alamat_wali) !!},
                                {!! json_encode($siswa->telepon_wali) !!},
                                {!! json_encode($siswa->jurusan->nama_jurusan ?? '-') !!},
                                {!! json_encode($siswa->inputBy->name ?? "System") !!}
                            )'
                            class="flex items-center justify-center w-8 h-8 p-1 text-blue-600 hover:text-blue-900 rounded-full hover:bg-blue-50 transition-colors"
                            title="Lihat Detail">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                            </svg>
                        </button>

                        <!-- Edit -->
                        <a href="{{ route('superuser.data-siswa.edit', $siswa->id) }}"
                            class="flex items-center justify-center w-8 h-8 p-1 text-indigo-600 hover:text-indigo-900 rounded-full hover:bg-indigo-50 transition-colors"
                            title="Edit">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </a>

                        <!-- Delete -->
                        <form action="{{ route('superuser.data-siswa.destroy', $siswa->id) }}" method="POST" class="m-0 p-0 flex">
                            @csrf
                            @method('DELETE')
                            <button 
                                type="button" 
                                class="btn-delete flex items-center justify-center w-8 h-8 p-1 text-red-600 hover:text-red-800 rounded-full hover:bg-red-50 transition-colors" 
                                title="Hapus">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </td>

            </tr>
        @empty
            <tr>
                <td colspan="14" class="text-center py-6 text-gray-500">Tidak ada data siswa.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="mt-4">
    {{ $siswas->links() }}
</div>