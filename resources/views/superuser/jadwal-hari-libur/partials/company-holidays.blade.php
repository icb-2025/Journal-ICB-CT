<div class="flex flex-col justify-between mb-6 space-y-4 md:flex-row md:items-center md:space-y-0">
    <h3 class="text-xl font-semibold text-gray-800">Jadwal Libur Perusahaan</h3>
    <a href="{{ route('superuser.jadwal-hari-libur.create') }}" 
    class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-700">
        <i class="mr-2 fas fa-plus"></i>Tambah Libur Perusahaan
    </a>
</div>

@if(session('success'))
    <div id="success-message" class="fixed top-4 right-4 z-50 flex items-center p-4 mb-4 text-green-800 bg-green-100 border-l-4 border-green-500 rounded-lg shadow-lg animate-fade-in">
        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-200 rounded-lg">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
            </svg>
        </div>
        <div class="ml-3 text-sm font-medium">
            {{ session('success') }}
        </div>
        <button type="button" onclick="dismissMessage()" class="ml-auto -mx-1.5 -my-1.5 bg-green-100 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex h-8 w-8">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
        </button>
    </div>

    <script>
        // Auto dismiss after 5 seconds
        setTimeout(function() {
            dismissMessage();
        }, 5000);

        function dismissMessage() {
            const message = document.getElementById('success-message');
            if (message) {
                message.classList.add('animate-fade-out');
                setTimeout(() => message.remove(), 300); // Wait for animation to finish
            }
        }
    </script>

    <style>
        .animate-fade-in {
            animation: fadeIn 0.3s ease-in-out;
        }
        
        .animate-fade-out {
            animation: fadeOut 0.3s ease-in-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes fadeOut {
            from { opacity: 1; transform: translateY(0); }
            to { opacity: 0; transform: translateY(-20px); }
        }
    </style>
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