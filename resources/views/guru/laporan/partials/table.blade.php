partial

<table class="min-w-full divide-y divide-gray-200">
    <thead class="bg-gray-50">
        <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NO</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NAMA SISWA</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">JURUSAN</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">PERUSAHAAN</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">TANGGAL</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">JAM MULAI</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">JAM SELESAI</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">KEGIATAN</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">KATEGORI TUGAS</th>
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
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                {{ $item->siswa->jurusan->nama_jurusan ?? '-' }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                {{ $item->perusahaan->nama_industri ?? '-' }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                {{ $item->mulai }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                {{ $item->selesai }}
            </td>
            <td class="px-6 py-4 text-sm text-gray-900">
                {{ $item->deskripsi }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                {{ $item->kategoriTugas->nama_kategori ?? '-' }}
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