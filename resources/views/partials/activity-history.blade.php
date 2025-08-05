<div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-blue-50">
            <tr>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">No</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider hidden sm:table-cell">Kode</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Tanggal</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Status</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Waktu</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Kegiatan</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Kategori</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach($aktivitasSiswa as $index => $item)
                <tr class="hover:bg-gray-50 transition duration-150">
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">{{ ($aktivitasSiswa->currentPage() - 1) * $aktivitasSiswa->perPage() + $index + 1 }}</td>
                    
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 hidden sm:table-cell">
                        @if ($perusahaanUser)
                            <span class="font-semibold">{{ $kodeBelakang }}</span>
                        @else
                            <span class="text-red-500">-</span>
                        @endif
                    </td>
                    
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}
                    </td>

                    <td class="px-4 py-4 text-sm text-gray-500 max-w-xs truncate sm:max-w-none sm:whitespace-normal">
                        {{ $item->status }}
                    </td>
                    
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">
                        <span class="block">{{ $item->mulai ?? '-' }}</span>
                        <span class="block">- {{ $item->selesai ?? '-'}}</span>
                    </td>
                    
                    <td class="px-4 py-4 text-sm text-gray-500 max-w-xs truncate sm:max-w-none sm:whitespace-normal">
                        {{ $item->deskripsi }}
                    </td>
                    
                    <td class="px-4 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                            {{ $item->kategoriTugas->nama_kategori ?? '-' }}
                        </span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@if($aktivitasSiswa->hasPages())
<div class="px-4 py-3 bg-white border-t border-gray-200 sm:px-6">
    <div class="flex items-center justify-between">
        <div class="text-sm text-gray-700">
            Showing <span class="font-medium">{{ $aktivitasSiswa->firstItem() }}</span> to <span class="font-medium">{{ $aktivitasSiswa->lastItem() }}</span> of <span class="font-medium">{{ $aktivitasSiswa->total() }}</span> results
        </div>
        <div class="flex space-x-2">
            @if ($aktivitasSiswa->onFirstPage())
                <span class="px-3 py-1 rounded-md bg-gray-100 text-gray-400 cursor-not-allowed">Previous</span>
            @else
                <a href="{{ $aktivitasSiswa->previousPageUrl() }}" class="px-3 py-1 rounded-md bg-blue-50 text-blue-600 hover:bg-blue-100">Previous</a>
            @endif

            @if ($aktivitasSiswa->hasMorePages())
                <a href="{{ $aktivitasSiswa->nextPageUrl() }}" class="px-3 py-1 rounded-md bg-blue-50 text-blue-600 hover:bg-blue-100">Next</a>
            @else
                <span class="px-3 py-1 rounded-md bg-gray-100 text-gray-400 cursor-not-allowed">Next</span>
            @endif
        </div>
    </div>
</div>
@endif