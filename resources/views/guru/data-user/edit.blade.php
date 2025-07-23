@extends('layouts.guru')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Edit User</h2>

<form action="{{ route('guru.data-user.update', ['data_user' => $user->id]) }}" method="POST">



        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Password (Opsional)</label>
            <input type="password" name="password" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2">
            <p class="text-xs text-gray-500">Biarkan kosong jika tidak ingin mengganti password.</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Role</label>
            <select name="role" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2" required>
                <option value="">Pilih Role</option>
                <option value="superuser" @if($user->role === 'superuser') selected @endif>Super User</option>
                <option value="guru" @if($user->role === 'guru') selected @endif>Guru</option>
                <option value="siswa" @if($user->role === 'siswa') selected @endif>Siswa</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Kode Perusahaan</label>
            <input type="text" name="kode_perusahaan" value="{{ old('kode_perusahaan', $user->kode_perusahaan) }}" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2">
        </div>

        <div class="flex justify-end">
            <a href="{{ route('guru.data-user.index') }}" class="mr-3 text-sm text-gray-600 hover:underline">Kembali</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">Update</button>
        </div>
    </form>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const roleSelect = document.querySelector('select[name="role"]');
        const kodeInput = document.querySelector('input[name="kode_perusahaan"]');

        function toggleKodeInput() {
            if (['superuser', 'guru'].includes(roleSelect.value)) {
                kodeInput.value = '-';
                kodeInput.readOnly = true;
            } else {
                kodeInput.readOnly = false;
            }
        }

        roleSelect.addEventListener('change', toggleKodeInput);
        toggleKodeInput(); // inisialisasi saat load
    });
</script>

</div>
@endsection
