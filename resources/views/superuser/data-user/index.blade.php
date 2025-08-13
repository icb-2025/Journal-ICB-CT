@php use Illuminate\Support\Str; @endphp

@extends('layouts.super')

@section('title', 'Data User')

@section('page-id', 'data-user')



@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <h2 class="text-2xl font-semibold text-gray-800">Data User</h2>

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

        <a href="{{ route('superuser.data-user.create') }}" class="flex items-center px-4 py-2 text-white bg-indigo-600 rounded-md hover:bg-indigo-700 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Tambah User
        </a>
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
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">Tanggal Input</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">Nama Jurusan</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($users as $user)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $user->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $user->email }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">••••••••</td>
                            <td class="px-6 py-4">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    {{ $user->role == 'guru' ? 'bg-blue-100 text-blue-800' : ($user->role == 'siswa' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') }}">
                                    {{ ucfirst($user->role) ?: '-' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ $user->kode_perusahaan ? Str::afterLast($user->kode_perusahaan, '-') : '-' }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $user->inputBy->name ?? 'System' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">{{ $user->input_date ? \Carbon\Carbon::parse($user->input_date)->format('Y-m-d') : '-' }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $user->nama_jurusan }}</td>
                            <td class="px-6 py-4 text-sm font-medium">
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('superuser.data-user.edit', $user->id) }}" class="text-indigo-600 hover:text-indigo-900 p-1 rounded-full hover:bg-indigo-50 transition-colors" title="Edit">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
    </svg>
</a>

<form action="{{ route('superuser.data-user.destroy', ['data_user' => $user->id]) }}" method="POST" class="form-delete">
    @csrf
    @method('DELETE')
    <button type="button" class="btn-delete text-red-600 hover:text-red-800 p-1 rounded-full hover:bg-red-50 transition-colors" title="Delete">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
        </svg>
    </button>
</form>

                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4" id="pagination-container">
    {{ $users->links() }}
</div>

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
            },
            "columnDefs": [
                { "orderable": false, "targets": [8] } // Disable sorting for action column
            ],
            "autoWidth": false, // Disable automatic column width calculation
            "columns": [
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                { "width": "180px" }, // Fixed width for date column
                null
            ]
        });
    });
</script>
@endsection