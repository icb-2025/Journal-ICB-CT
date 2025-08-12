<table class="table table-bordered min-w-full divide-y divide-gray-200">
    <thead class="bg-gray-50">
        <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Siswa</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Perusahaan</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jam Mulai</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jam Selesai</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kegiatan</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori Tugas</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Jurusan</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y">
    @if($aktivitas->count() > 0)
        @foreach($aktivitas as $item)
        <tr class="hover:bg-gray-50">
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $loop->iteration }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                {{ $item->siswa->name ?? '-' }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                {{ $item->perusahaan->nama_industri ?? '-' }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                {{ $item->tanggal }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                {{ $item->mulai }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                {{ $item->selesai }}
            </td>
            <td class="px-6 py-4 text-sm text-gray-500">
                {{ $item->deskripsi }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                {{ $item->kategoriTugas->nama_kategori ?? '-' }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
               {{ $item->siswa->nama_jurusan ?? '-' }}
            </td>
           @php
    $status = strtolower(trim($item->status));
    $badgeColor = 'bg-gray-300 text-gray-800'; // default

    if ($status == 'masuk') {
        $badgeColor = 'bg-green-300 text-green-800';
    } elseif ($status == 'sakit') {
        $badgeColor = 'bg-red-300 text-red-800';
    } elseif ($status == 'izin') {
        $badgeColor = 'bg-yellow-300 text-yellow-800';
    }
@endphp
<td class="px-6 py-4 whitespace-nowrap text-sm">
    <span class="inline-block px-3 py-1 rounded-full font-semibold {{ $badgeColor }}">
        {{ $item->status }}
    </span>
</td>


        </tr>
        @endforeach
    @else
        <tr>
            <td colspan="8" class="px-6 py-4 text-center text-sm text-gray-500">
                @if(request()->has('search') && !empty(request('search')))
                    <i class="fas fa-search-minus mr-1"></i> 
                    Tidak ditemukan data untuk "{{ request('search') }}"
                @else
                        <i class="fas fa-database mr-1"></i> 
                        Tidak ada data aktivitas
                @endif
            </td>
        </tr>
    @endif
</tbody>