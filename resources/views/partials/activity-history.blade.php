<div class="overflow-x-auto rounded-lg border border-gray-200">
    <table class="min-w-full table-auto border-collapse">
        <thead class="bg-blue-50 text-gray-700 text-xs uppercase tracking-wider border-b border-gray-300">
            <tr>
                <th class="px-4 py-3 text-left border-r border-gray-200">No</th>
                <th class="px-4 py-3 text-left border-r border-gray-200 hidden sm:table-cell">Kode</th>
                <th class="px-4 py-3 text-left border-r border-gray-200">Tanggal</th>
                <th class="px-4 py-3 text-left border-r border-gray-200">Status</th>
                <th class="px-4 py-3 text-left border-r border-gray-200">Waktu</th>
                <th class="px-4 py-3 text-left border-r border-gray-200">Kegiatan</th>
                <th class="px-4 py-3 text-left">Kategori</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 text-sm text-gray-700 bg-white">
            @foreach($aktivitasSiswa as $index => $item)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 border-r border-gray-100">
                        {{ ($aktivitasSiswa->currentPage() - 1) * $aktivitasSiswa->perPage() + $index + 1 }}
                    </td>
                    
                    <td class="px-4 py-3 border-r border-gray-100 hidden sm:table-cell">
                        @if ($perusahaanUser)
                            <span class="font-medium text-gray-800">{{ $kodeBelakang }}</span>
                        @else
                            <span class="text-red-500">-</span>
                        @endif
                    </td>
                    
                    <td class="px-4 py-3 border-r border-gray-100">
                        {{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}
                    </td>

                    <td class="px-4 py-3 border-r border-gray-100 capitalize">
                        {{ $item->status }}
                    </td>
                    
                    <td class="px-4 py-3 border-r border-gray-100">
                        <div>{{ $item->mulai ?? '-' }}</div>
                        <div>- {{ $item->selesai ?? '-' }}</div>
                    </td>
                    
                    <td class="px-4 py-3 border-r border-gray-100 max-w-xs sm:max-w-md whitespace-normal">
                        {{ $item->deskripsi }}
                    </td>
                    
                    <td class="px-4 py-3">
                        <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
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
        <div class="flex flex-col sm:flex-row items-center justify-between space-y-2 sm:space-y-0">
            <div class="text-sm text-gray-600">
                Menampilkan <span class="font-semibold">{{ $aktivitasSiswa->firstItem() }}</span> - <span class="font-semibold">{{ $aktivitasSiswa->lastItem() }}</span> dari <span class="font-semibold">{{ $aktivitasSiswa->total() }}</span> data
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
