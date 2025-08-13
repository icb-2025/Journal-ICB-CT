    @extends('layouts.super')

    @section('content')
    <div class="space-y-6">
        <div class="p-6 bg-white rounded-lg shadow">
            <div class="flex flex-col justify-between mb-6 space-y-4 md:flex-row md:items-center md:space-y-0">
                <h3 class="text-xl font-semibold text-gray-800">Jadwal Libur Perusahaan</h3>
                <a href="{{ route('superuser.jadwal-hari-libur.create') }}" 
                class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-700">
                    <i class="mr-2 fas fa-plus"></i>Tambah Libur Perusahaan
                </a>
            </div>

            @if(session('success'))
                <div class="p-3 mb-4 text-green-700 bg-green-100 border border-green-300 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-x-auto border border-gray-200 rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Perusahaan</th>
                            <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Hari Libur</th>
                            <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-xs font-medium text-right text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($jadwal as $item)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="font-medium">{{ $item->perusahaan->nama_perusahaan }}</div>
                                    <div class="text-sm text-gray-500">{{ $item->perusahaan->nama_industri }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $item->hari_libur }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 text-xs font-semibold leading-5 
                                        {{ $item->status == 'Libur' ? 'text-red-800 bg-red-100' : 'text-green-800 bg-green-100' }} rounded-full">
                                        {{ $item->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right whitespace-nowrap">
                                    <a href="{{ route('superuser.jadwal-hari-libur.edit', $item->id) }}" class="p-1 text-indigo-600 hover:text-indigo-900">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('superuser.jadwal-hari-libur.destroy', $item->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1 ml-2 text-red-600 hover:text-red-900" onclick="return confirm('Yakin ingin menghapus?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">Tidak ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                
            </div>
        </div>
    </div>
    <!-- National Holidays Section -->
        <div class="p-6 bg-white rounded-lg shadow">
            <div class="flex flex-col justify-between mb-6 space-y-4 md:flex-row md:items-center md:space-y-0">
                <h3 class="text-xl font-semibold text-gray-800">Jadwal Libur Nasional</h3>
            </div>

            <div class="overflow-x-auto border border-gray-200 rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Tanggal</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Keterangan</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-right text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                <tbody id="national-holidays-body" class="bg-white divide-y divide-gray-200">
        <tr>
            <td colspan="3" class="px-6 py-4 text-center text-gray-500">Memuat data...</td>
        </tr>
    </tbody>

                </table>
            </div>
        </div>
    </div>

    <!-- Modals -->


    <script>
    document.addEventListener('DOMContentLoaded', function () {
        fetch("{{ url('/api/national-holidays') }}")
            .then(response => response.json())
            .then(data => {
                let tbody = document.getElementById('national-holidays-body');
                tbody.innerHTML = ''; // Kosongkan dulu

                data.forEach(item => {
                    let rawDate = item.holiday_date || item.date;
                    let [year, month, day] = rawDate.split('-');

                    let formattedDate = new Date(year, month - 1, day).toLocaleDateString('id-ID', {
                        day: 'numeric',
                        month: 'long',
                        year: 'numeric'
                    });

                    let row = `
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">${formattedDate}</td>
                            <td class="px-6 py-4">${item.holiday_name}</td>
                            <td class="px-6 py-4 text-right whitespace-nowrap">
                                <button onclick="openEditNationalModal()" class="p-1 text-green-600 hover:text-green-900">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button onclick="confirmDelete('national')" class="p-1 ml-2 text-red-600 hover:text-red-900">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    `;
                    tbody.innerHTML += row;
                });
            })
            .catch(error => {
                console.error('Error fetching national holidays:', error);
                document.getElementById('national-holidays-body').innerHTML = `
                    <tr>
                        <td colspan="3" class="px-6 py-4 text-center text-red-500">Gagal memuat data</td>
                    </tr>
                `;
            });
    });
    </script>

    @endsection
