<table class="min-w-full divide-y divide-gray-200">
    <thead class="bg-gray-50">
        <tr>
            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">No</th>
            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Nama Lengkap</th>
            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">NIS</th>
            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Tempat, Tanggal Lahir</th>
            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Golongan Darah</th>
            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Sekolah</th>
            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Alamat Sekolah</th>
            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Nomor Telepon / Faximile</th>
            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Nama Orang Tua / Wali</th>
            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Alamat Orang Tua / Wali</th>
            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">No Telepon Orang Tua / Wali</th>
            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Jurusan</th>
            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Input by</th>
            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Aksi</th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        @forelse($siswas as $siswa)
        <tr>
            <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $siswa->nama_lengkap }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $siswa->nis }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $siswa->tempat_lahir }}, {{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->format('d M Y') }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $siswa->gol_darah }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $siswa->sekolah }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $siswa->alamat_sekolah }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $siswa->telepon_sekolah }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $siswa->nama_wali }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $siswa->alamat_wali }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $siswa->telepon_wali }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $siswa->jurusan->nama_jurusan ?? '-' }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $siswa->inputBy->name?? '-' }}</td>
            <td class="flex px-6 py-4 space-x-2 whitespace-nowrap">
                <td class="flex px-6 py-4 space-x-2 whitespace-nowrap">
                <!-- View Button -->
                <button onclick="showModal(
                    '{{ $siswa->nis }}',
                    '{{ $siswa->nama_lengkap }}',
                    '{{ $siswa->jenis_kelamin }}',
                    '{{ $siswa->gol_darah }}',
                    '{{ $siswa->tempat_lahir }}, {{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->format('d M Y') }}',
                    '{{ $siswa->alamat_wali }}',
                    '{{ $siswa->sekolah }}',
                    '{{ $siswa->kelas }}',
                    '{{ $siswa->nama_wali }}',
                    '{{ $siswa->telepon_wali }}',
                    '{{ $siswa->status }}',
                     {{ $siswa->jurusan->nama_jurusan ?? '-' }}
                    '{{ $siswa->inputBy->name ?? 'System' }}'
                )" class="text-blue-600 hover:text-blue-900" title="Lihat">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                    </svg>
                </button>
                
                <!-- Edit and Delete buttons remain the same -->
                <!-- <a href="{{ route('superuser.data-siswa.edit', $siswa->id) }}" class="text-indigo-600 hover:text-indigo-900" title="Edit">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M13.586 3.586a2 2 0 112.828 2.828L14.828 8l-2.828-2.828L13.586 3.586zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                    </svg>
                </a>
                <form action="{{ route('superuser.data-siswa.destroy', $siswa->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus siswa ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:text-red-900" title="Hapus">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </form> -->

                <a href="{{ route('superuser.data-siswa.edit', $siswa->id) }}" class="text-indigo-600 hover:text-indigo-900 p-1 rounded-full hover:bg-indigo-50 transition-colors" title="Edit">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
    </svg>
</a>

<form action="{{ route('superuser.data-siswa.destroy', $siswa->id) }}" method="POST" class="form-delete">
    @csrf
    @method('DELETE')
    <button type="button" class="btn-delete text-red-600 hover:text-red-800 p-1 rounded-full hover:bg-red-50 transition-colors" title="Delete">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
        </svg>
    </button>
</form>
            </td>
        </tr>
        @empty
        <tr>
         <td colspan="13" class="text-center py-6 text-gray-500">
  <i class="fas fa-users mr-2"></i> Tidak ada data siswa
</td>

        </tr>
        @endforelse
    </tbody>
</table>