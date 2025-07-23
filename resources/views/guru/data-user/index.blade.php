
@php use Illuminate\Support\Str; @endphp

@extends('layouts.guru')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <h2 class="text-2xl font-semibold text-gray-800">Data User</h2>
        <a href="{{ route('guru.data-user.create') }}" class="flex items-center px-4 py-2 text-white bg-indigo-600 rounded-md hover:bg-indigo-700">
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
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
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
        <td class="px-6 py-4 text-sm text-gray-500">{{ $user->input_date ? \Carbon\Carbon::parse($user->input_date)->format('Y-m-d H:i') : '-' }}</td>
        <td class="px-6 py-4 text-sm font-medium flex gap-2">
    <a href="{{ route('guru.data-user.edit', $user->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
    <form action="{{ route('guru.data-user.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus user ini?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="text-red-600 hover:text-red-800 ml-2">Delete</button>
    </form>
</td>

    </tr>
    @endforeach
</tbody>

                </table>
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