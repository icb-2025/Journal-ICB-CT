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
                        '{{ $siswa->kelas }}',
                        '{{ $siswa->nama_wali }}',
                        '{{ $siswa->telepon_wali }}',
                        '{{ $siswa->status }}',
                        '{{ $siswa->jurusan->nama_jurusan ?? '-' }}',
                        '{{ $siswa->inputBy->name ?? 'System' }}'
                    )" 
                    class="text-blue-600 hover:text-blue-900" title="Lihat">
                    👁
                </button>

                <!-- Edit Button -->
                <a href="{{ route('superuser.data-siswa.edit', $siswa->id) }}" class="text-indigo-600 hover:text-indigo-900">✏</a>

                <!-- Delete Button -->
                <form action="{{ route('superuser.data-siswa.destroy', $siswa->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Yakin hapus?')" class="text-red-600 hover:text-red-900">🗑</button>
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
        <button onclick="closeModal()" class="mt-4 px-4 py-2 bg-red-500 text-white rounded">Tutup</button>
    </div>
</div>

<script>
function showModal(nis, nama, jk, golDarah, ttl, alamatWali, sekolah, kelas, namaWali, telpWali, status, jurusan, inputBy) {
    const modal = document.getElementById('detailModal');
    const content = `
        <p><strong>NIS:</strong> ${nis}</p>
        <p><strong>Nama:</strong> ${nama}</p>
        <p><strong>Jenis Kelamin:</strong> ${jk}</p>
        <p><strong>Gol. Darah:</strong> ${golDarah}</p>
        <p><strong>TTL:</strong> ${ttl}</p>
        <p><strong>Alamat Wali:</strong> ${alamatWali}</p>
        <p><strong>Sekolah:</strong> ${sekolah}</p>
        <p><strong>Kelas:</strong> ${kelas}</p>
        <p><strong>Nama Wali:</strong> ${namaWali}</p>
        <p><strong>Telp Wali:</strong> ${telpWali}</p>
        <p><strong>Status:</strong> ${status}</p>
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
</script>
