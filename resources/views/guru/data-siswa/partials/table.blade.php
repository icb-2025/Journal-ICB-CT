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
            <td class="px-6 py-4 whitespace-nowrap">{{ $siswa->inputBy->name?? '-' }}</td>
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex space-x-2">
                    <!-- View Button -->
                    <button onclick="showStudentDetail(
                        '{{ $siswa->nis }}',
                        '{{ $siswa->nama_lengkap }}',
                        '{{ $siswa->gol_darah }}',
                        '{{ $siswa->sekolah }}',
                        '{{ $siswa->alamat_sekolah}}',
                        '{{ $siswa->telepon_sekolah }}',
                        '{{ $siswa->nama_wali }}',
                        '{{ $siswa->alamat_wali}}',
                        '{{ $siswa->telepon_wali }}'
                    )" class="text-blue-600 hover:text-blue-900" title="Lihat">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="13" class="px-6 py-4 text-center text-gray-500">Tidak ada data siswa.</td>
        </tr>
        @endforelse
    </tbody>
</table>