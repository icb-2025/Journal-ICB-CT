<table class="min-w-full divide-y divide-gray-200">
    <thead class="bg-gray-50">
        <tr>
            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">No</th>
            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Nama Lengkap</th>
            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">NIS</th>
            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Tempat, Tanggal Lahir</th>
            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Golongan Darah</th>
            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Sekolah</th>
            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Alamat Sekolah</th>
            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Telp Sekolah</th>
            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Nama Wali</th>
            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Alamat Wali</th>
            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Telp Wali</th>
            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Jurusan</th>
            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Input by</th>
            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Aksi</th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        @forelse($siswas as $siswa)
        <tr>
            <td class="px-6 py-4">{{ $loop->iteration }}</td>
            <td class="px-6 py-4">{{ $siswa->nama_lengkap }}</td>
            <td class="px-6 py-4">{{ $siswa->nis }}</td>
            <td class="px-6 py-4">{{ $siswa->tempat_lahir }}, {{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->format('d M Y') }}</td>
            <td class="px-6 py-4">{{ $siswa->gol_darah }}</td>
            <td class="px-6 py-4">{{ $siswa->sekolah }}</td>
            <td class="px-6 py-4">{{ $siswa->alamat_sekolah }}</td>
            <td class="px-6 py-4">{{ $siswa->telepon_sekolah }}</td>
            <td class="px-6 py-4">{{ $siswa->nama_wali }}</td>
            <td class="px-6 py-4">{{ $siswa->alamat_wali }}</td>
            <td class="px-6 py-4">{{ $siswa->telepon_wali }}</td>
            <td class="px-6 py-4">{{ $siswa->jurusan->nama_jurusan ?? '-' }}</td>
            <td class="px-6 py-4">{{ $siswa->inputBy->name ?? '-' }}</td>
            <td class="flex space-x-2 px-6 py-4">
                <!-- View Button -->
                <button onclick="showModal(
                        '{{ $siswa->nis }}',
                        '{{ $siswa->nama_lengkap }}',
                        '{{ $siswa->jenis_kelamin }}',
                        '{{ $siswa->gol_darah }}',
                        '{{ $siswa->tempat_lahir }}, {{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->format('d M Y') }}',
                        '{{ $siswa->alamat_wali }}',
                        '{{ $siswa->sekolah }}',
                        '{{ $siswa->nama_wali }}',
                        '{{ $siswa->telepon_wali }}',
                        '{{ $siswa->jurusan->nama_jurusan ?? '-' }}',
                        '{{ $siswa->inputBy->name ?? 'System' }}'
                    )" 
                    class="text-blue-600 hover:text-blue-900" title="Lihat">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                </svg>
                </button>

             <a href="{{ route('superuser.data-siswa.edit', $siswa->id) }}" class="text-indigo-600 hover:text-indigo-900 p-1 rounded-full hover:bg-indigo-50 transition-colors" title="Edit">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
    </svg>
</a>

<form action="{{ route('superuser.data-siswa.destroy', $siswa->id) }}" method="POST" class="form-delete">
    @csrf
    @method('DELETE')
    <button type="button" class="btn-delete text-red-600 hover:text-red-800 p-1 rounded-full hover:bg-red-50 transition-colors" title="Delete">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
        </svg>
    </button>
</form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="14" class="text-center py-6 text-gray-500">Tidak ada data siswa</td>
        </tr>
        @endforelse
    </tbody>
</table>

<!-- Modal -->
<div id="detailModal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center">
    <div class="bg-white p-6 rounded-lg w-96">
        <h2 class="text-xl font-bold mb-4">Detail Siswa</h2>
        <div id="modalContent" class="space-y-2"></div>
        <button onclick="closeModal()" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded">Tutup</button>
    </div>
</div>

<script>
function showModal(nis, nama, jk, golDarah, ttl, alamatWali, sekolah, namaWali, telpWali, jurusan, inputBy) {
    const modal = document.getElementById('detailModal');
    const content = `
        <p><strong>NIS:</strong> ${nis}</p>
        <p><strong>Nama:</strong> ${nama}</p>
        <p><strong>Jenis Kelamin:</strong> ${jk}</p>
        <p><strong>Gol. Darah:</strong> ${golDarah}</p>
        <p><strong>TTL:</strong> ${ttl}</p>
        <p><strong>Alamat Wali:</strong> ${alamatWali}</p>
        <p><strong>Sekolah:</strong> ${sekolah}</p>
        <p><strong>Nama Wali:</strong> ${namaWali}</p>
        <p><strong>Telp Wali:</strong> ${telpWali}</p>
        <p><strong>Jurusan:</strong> ${jurusan}</p>
        <p><strong>Input by:</strong> ${inputBy}</p>
    `;
    document.getElementById('modalContent').innerHTML = content;
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeModal() {
    const modal = document.getElementById('detailModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

    document.addEventListener("DOMContentLoaded", function () {
    const deleteButtons = document.querySelectorAll(".btn-delete");

    deleteButtons.forEach(button => {
        button.addEventListener("click", function (e) {
            e.preventDefault();

            const form = this.closest("form");

            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data perusahaan akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});
</script>
