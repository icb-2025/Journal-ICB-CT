@extends('layouts.super')

@section('title', 'Data Perusahaan')

@section('content')
<div class="container px-4 py-6 mx-auto">
    <div class="p-6 bg-white rounded-lg shadow-md">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Data Perusahaan</h2>
            <div class="flex space-x-3">
                <a href="{{ route('superuser.data-perusahaan.create') }}" class="flex items-center px-4 py-2 text-white bg-indigo-600 rounded-md hover:bg-indigo-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Tambah Perusahaan
                </a>
            </div>
        </div>

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
                            <a href="{{ route('superuser.data-perusahaan.edit', $perusahaan->id) }}" class="text-indigo-600 hover:text-indigo-900" title="Edit">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M13.586 3.586a2 2 0 112.828 2.828L14.828 8l-2.828-2.828L13.586 3.586zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                </svg>
                            </a>
                            <form action="{{ route('superuser.data-perusahaan.destroy', $perusahaan->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus perusahaan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" title="Hapus">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
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
    </div>
</div>

<!-- Modal -->
<div id="viewModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        
        <!-- Modal content -->
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Detail Perusahaan
                        </h3>
                        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Kode Perusahaan:</p>
                                <p class="mt-1 text-sm text-gray-900" id="modal-kode"></p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Nama Industri:</p>
                                <p class="mt-1 text-sm text-gray-900" id="modal-nama"></p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Bidang Usaha:</p>
                                <p class="mt-1 text-sm text-gray-900" id="modal-bidang"></p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Alamat:</p>
                                <p class="mt-1 text-sm text-gray-900" id="modal-alamat"></p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">No Telepon:</p>
                                <p class="mt-1 text-sm text-gray-900" id="modal-telepon"></p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Nama Direktur:</p>
                                <p class="mt-1 text-sm text-gray-900" id="modal-direktur"></p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Nama Pembimbing:</p>
                                <p class="mt-1 text-sm text-gray-900" id="modal-pembimbing"></p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Input By:</p>
                                <p class="mt-1 text-sm text-gray-900" id="modal-inputby"></p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Input Date:</p>
                                <p class="mt-1 text-sm text-gray-900" id="modal-inputdate"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" onclick="hideModal()" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function showModal(kode, nama, bidang, alamat, telepon, direktur, pembimbing, inputby, inputdate) {
        document.getElementById('modal-kode').textContent = kode;
        document.getElementById('modal-nama').textContent = nama;
        document.getElementById('modal-bidang').textContent = bidang;
        document.getElementById('modal-alamat').textContent = alamat;
        document.getElementById('modal-telepon').textContent = telepon;
        document.getElementById('modal-direktur').textContent = direktur;
        document.getElementById('modal-pembimbing').textContent = pembimbing;
        document.getElementById('modal-inputby').textContent = inputby;
        document.getElementById('modal-inputdate').textContent = inputdate;
        
        document.getElementById('viewModal').classList.remove('hidden');
    }

    function hideModal() {
        document.getElementById('viewModal').classList.add('hidden');
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('viewModal');
        if (event.target === modal) {
            hideModal();
        }
    }

    // Close modal with ESC key
    document.onkeydown = function(evt) {
        evt = evt || window.event;
        if (evt.keyCode === 27) {
            hideModal();
        }
    };
</script>
@endsection