@extends('layouts.super')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Tambah User</h2>

    <form action="{{ route('superuser.data-user.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow space-y-5">
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

<select name="jurusan_id">
    <option value="">Pilih Jurusan</option>
    @foreach($jurusans as $jurusan)
        <option value="{{ $jurusan->id }}">{{ $jurusan->nama_jurusan }}</option>
    @endforeach
</select>

        <div class="flex justify-end">
            <button type="submit" id="simpanDataBtn"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            Tambah
                        </button>
            <a href="{{ route('superuser.data-user.index') }}" 
                        class="ml-2 px-4 py-2 border border-blue-300 rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
                            <i class="fas fa-times mr-1"></i> Batal
                    </a>
        </div>
    </form>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const roleSelect = document.getElementById('role');
        const kodePerusahaanSelect = document.getElementById('kode_perusahaan');
        const jurusanSelect = document.querySelector('select[name="jurusan_id"]');

        function toggleFieldsByRole() {
            const role = roleSelect.value;

            if (role === 'superuser') {
                kodePerusahaanSelect.value = '';
                kodePerusahaanSelect.disabled = true;
                jurusanSelect.value = '';
                jurusanSelect.disabled = true;
            } else if (role === 'guru') {
                kodePerusahaanSelect.disabled = false;
                jurusanSelect.disabled = false;
            } else {
                kodePerusahaanSelect.disabled = true;
                jurusanSelect.disabled = true;
            }
        }

        roleSelect.addEventListener('change', toggleFieldsByRole);
        toggleFieldsByRole();
    });
</script>


</div>
@endsection
