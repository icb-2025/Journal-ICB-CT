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
                <a href="{{ route('guru.data-user.index') }}" class="px-4 py-2 border rounded-lg text-gray-700 hover:bg-gray-100">
                    Kembali
                </a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Update User
                </button>
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