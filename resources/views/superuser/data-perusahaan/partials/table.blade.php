<div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">No</th>
                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Kode Perusahaan</th>
                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Nama Industri</th>
                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Bidang Usaha</th>
                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Alamat</th>
                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">No Telepon</th>
                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Nama Direktur</th>
                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Nama Pembimbing</th>
                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Input By</th>
                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Input Date</th>
                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($perusahaans as $perusahaan)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $perusahaan->kode_unik }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $perusahaan->nama_industri }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $perusahaan->bidang_usaha }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $perusahaan->alamat }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $perusahaan->no_telepon }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $perusahaan->nama_direktur }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $perusahaan->nama_pembimbing }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $perusahaan->user->name ?? 'System' }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $perusahaan->created_at->format('d M Y H:i') }}</td>
                <td class="flex px-6 py-4 space-x-2 whitespace-nowrap">
                    <button onclick="showModal(
                        '{{ $perusahaan->kode_unik }}',
                        '{{ $perusahaan->nama_industri }}',
                        '{{ $perusahaan->bidang_usaha }}',
                        '{{ $perusahaan->alamat }}',
                        '{{ $perusahaan->no_telepon }}',
                        '{{ $perusahaan->nama_direktur }}',
                        '{{ $perusahaan->nama_pembimbing }}',
                        '{{ $perusahaan->user->name ?? 'System' }}',
                        '{{ $perusahaan->created_at->format('d M Y H:i') }}'
                    )" class="text-blue-600 hover:text-blue-900" title="Lihat">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                        </svg>
                    </button>
    <a href="{{ route('superuser.data-perusahaan.edit', $perusahaan->kode_perusahaan) }}" class="text-indigo-600 hover:text-indigo-900 p-1 rounded-full hover:bg-indigo-50 transition-colors" title="Edit">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
        </svg>
    </a>
    <form action="{{ route('superuser.data-perusahaan.destroy', $perusahaan->kode_perusahaan) }}" method="POST" class="form-delete">
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
                <td colspan="11" class="px-6 py-4 text-center text-gray-500">Tidak ada data perusahaan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $perusahaans->links() }}
</div>