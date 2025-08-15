@extends('layouts.super')

@section('content')
<div class="mx-auto p-4 max-w-4xl">
    <!-- Header Card -->
    <div class="bg-blue-600 text-white px-6 py-4 rounded-t-lg">
        <h1 class="text-2xl font-bold">Edit User</h1>
    </div>
    
    <!-- Form Container -->
    <div class="bg-white shadow rounded-b-lg p-6">
        <form method="POST" action="{{ route('superuser.data-user.update', $user->id) }}">
            @csrf
            @method('PUT')

            <!-- Name Input -->
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" 
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Email Input -->
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" 
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Password Input -->
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Password (Opsional)</label>
                <input type="password" name="password" 
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                <p class="text-sm text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengganti password</p>
            </div>

            <!-- Role Selection -->
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Role</label>
                <select name="role" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" required>
                    <option value="">Pilih Role</option>
                    <option value="superuser" {{ old('role', $user->role) == 'superuser' ? 'selected' : '' }}>Super User</option>
                    <option value="guru" {{ old('role', $user->role) == 'guru' ? 'selected' : '' }}>Guru</option>
                    <option value="siswa" {{ old('role', $user->role) == 'siswa' ? 'selected' : '' }}>Siswa</option>
                </select>
            </div>

            <!-- Kode Perusahaan -->
            <div class="mb-6">
                <label class="block text-gray-700 mb-2">Kode Perusahaan</label>
                <input type="text" name="kode_perusahaan" id="kode_perusahaan" 
                       value="{{ old('kode_perusahaan', $user->kode_perusahaan) }}"
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end space-x-3">
                <button type="submit" id="simpanDataBtn"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            Update User
                        </button>
                <a href="{{ route('superuser.data-user.index') }}" 
                        class="ml-2 px-4 py-2 border border-blue-300 rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
                            <i class="fas fa-times mr-1"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const roleSelect = document.querySelector('select[name="role"]');
    const kodeInput = document.getElementById('kode_perusahaan');

    function toggleKodeInput() {
        if (['superuser', 'guru'].includes(roleSelect.value)) {
            kodeInput.value = '-';
            kodeInput.readOnly = true;
            kodeInput.classList.add('bg-gray-100');
        } else {
            kodeInput.readOnly = false;
            kodeInput.classList.remove('bg-gray-100');
            if (kodeInput.value === '-') kodeInput.value = '';
        }
    }

    roleSelect.addEventListener('change', toggleKodeInput);
    toggleKodeInput();
});


</script>
@endsection