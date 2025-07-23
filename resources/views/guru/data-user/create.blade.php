@extends('layouts.guru')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Tambah User</h2>

    <form action="{{ route('guru.data-user.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow space-y-5">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
            <input type="text" name="name" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2" required>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" name="password" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2" required>
        </div>

        <!-- Role -->
<div>
    <label class="block text-sm font-medium text-gray-700">Role</label>
    <select name="role" id="role" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2" required>
        <option value="">Pilih Role</option>
        <option value="superuser">Super User</option>
        <option value="guru">Guru</option>
        <option value="siswa">Siswa</option>
    </select>
</div>

<!-- Kode Perusahaan -->
<div class="mb-4">
    <label for="kode_perusahaan" class="block text-gray-700 text-sm font-bold mb-2">Kode Perusahaan</label>
    <select name="kode_perusahaan" id="kode_perusahaan" class="w-full border rounded px-3 py-2">
        <option value="">Pilih Kode Perusahaan</option>
        @foreach ($perusahaans as $perusahaan)
            <option value="{{ $perusahaan->kode_perusahaan }}">
                {{ $perusahaan->kode_perusahaan }} - {{ $perusahaan->nama_industri }}
            </option>
        @endforeach
    </select>
</div>
        <div class="flex justify-end">
            <a href="{{ route('guru.data-user.index') }}" class="mr-3 text-sm text-gray-600 hover:underline">Kembali</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">Simpan</button>
        </div>
    </form>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const roleSelect = document.getElementById('role');
        const kodePerusahaanSelect = document.getElementById('kode_perusahaan');

        roleSelect.addEventListener('change', function () {
            const selectedRole = this.value;

            if (selectedRole === 'superuser' || selectedRole === 'guru') {
                kodePerusahaanSelect.innerHTML = '<option value="-">-</option>';
                kodePerusahaanSelect.value = '-';
                kodePerusahaanSelect.setAttribute('disabled', true);
            } else {
                // Aktifkan kembali dan tampilkan data asli jika role siswa
                kodePerusahaanSelect.removeAttribute('disabled');
                kodePerusahaanSelect.innerHTML = `<option value="">Pilih Kode Perusahaan</option>
                @foreach ($perusahaans as $perusahaan)
                    <option value="{{ $perusahaan->kode_perusahaan }}">
                        {{ $perusahaan->kode_perusahaan }} - {{ $perusahaan->nama_industri }}
                    </option>
                @endforeach`;
            }
        });
    });
</script>

</div>
@endsection
