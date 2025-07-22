@extends('layouts.guru')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <h2 class="text-2xl font-semibold text-gray-800">Data User</h2>
        <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md flex items-center gap-2 transition-colors">
            <i class="fas fa-plus"></i>
            <span>Tambah User</span>
        </button>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-4">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200" id="userTable">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Username</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User Login</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Password</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Level</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode Perusahaan</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Input By</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">1</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">admin1</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">admin@school.com</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">••••••••</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Super User</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">SCH001</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">System</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2023-05-15 08:30</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex gap-2">
                                <button class="text-yellow-600 hover:text-yellow-900" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="text-red-600 hover:text-red-900" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">guru_ahmad</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">ahmad@school.com</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">••••••••</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Guru</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">SCH001</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">admin1</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2023-06-20 10:15</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex gap-2">
                                <button class="text-yellow-600 hover:text-yellow-900" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="text-red-600 hover:text-red-900" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">3</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">siswa_budi</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">budi@school.com</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">••••••••</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Siswa</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">SCH001</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">guru_ahmad</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2023-07-05 14:20</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex gap-2">
                                <button class="text-yellow-600 hover:text-yellow-900" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="text-red-600 hover:text-red-900" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Add/Edit User -->
<div class="fixed inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true" id="userModal">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Tambah User Baru</h3>
                        <div class="mt-4">
                            <form class="space-y-4">
                                <div>
                                    <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                                    <input type="text" id="username" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                                </div>
                                <div>
                                    <label for="userLogin" class="block text-sm font-medium text-gray-700">User Login (Email)</label>
                                    <input type="email" id="userLogin" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                                </div>
                                <div>
                                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                                    <input type="password" id="password" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                                </div>
                                <div>
                                    <label for="level" class="block text-sm font-medium text-gray-700">Level</label>
                                    <select id="level" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                                        <option value="">Pilih Level</option>
                                        <option value="superuser">Super User</option>
                                        <option value="guru">Guru</option>
                                        <option value="siswa">Siswa</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="kodePerusahaan" class="block text-sm font-medium text-gray-700">Kode Perusahaan</label>
                                    <input type="text" id="kodePerusahaan" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-100 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" readonly>
                                    <p class="mt-1 text-xs text-gray-500">Kode akan digenerate otomatis</p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Simpan
                </button>
                <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize DataTable
        $('#userTable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"
            }
        });

        // Modal toggle logic would go here
    });
</script>
@endsection