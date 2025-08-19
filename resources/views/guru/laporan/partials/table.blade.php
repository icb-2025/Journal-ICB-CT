<table class="min-w-full divide-y divide-gray-200">
    <thead class="bg-gray-50">
        <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Siswa</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jurusan</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Perusahaan</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jam Mulai</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jam Selesai</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kegiatan</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori Tugas</th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
    @if($aktivitas->count() > 0)
        @foreach($aktivitas as $item)
        <tr class="hover:bg-gray-50 transition-colors duration-150">
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ ($aktivitas->currentPage() - 1) * $aktivitas->perPage() + $loop->iteration }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                {{ $item->siswa->name ?? '-' }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                {{ $item->siswa->jurusans->nama_jurusan ?? '-' }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                {{ $item->perusahaan->nama_industri ?? '-' }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                {{ $item->mulai }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                {{ $item->selesai }}
            </td>
            <td class="px-6 py-4 text-sm text-gray-500">
                {{ Str::limit($item->deskripsi, 50) }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                    {{ $item->kategoriTugas->nama_kategori ?? '-' }}
                </span>
            </td>
        </tr>
        @endforeach
    @else
        <tr>
            <td colspan="9" class="px-6 py-4 text-center text-sm text-gray-500">
                @if(request()->has('search') && !empty(request('search')))
                    <i class="fas fa-search-minus mr-1"></i> 
                    Tidak ditemukan data untuk "{{ request('search') }}"
                @elseif(request()->has('department_id') || request()->has('start_date'))
                    <i class="fas fa-filter mr-1"></i> 
                    Tidak ada data yang sesuai dengan filter yang dipilih
                @else
                    <i class="fas fa-database mr-1"></i> 
                    Tidak ada data aktivitas
                @endif
            </td>
        </tr>
    @endif
    </tbody>
</table>

@if($aktivitas->hasPages())
<div class="mt-4">
    {{ $aktivitas->appends(request()->query())->links() }}
</div>
@endif