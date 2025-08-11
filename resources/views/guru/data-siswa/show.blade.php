<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Siswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white shadow-lg rounded-lg max-w-2xl w-full p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-3">📄 Detail Siswa</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-4 gap-x-6">
            <div>
                <span class="font-semibold text-gray-600">Nama Lengkap:</span>
                <p class="text-gray-800">{{ $siswa->nama_lengkap }}</p>
            </div>
            <div>
                <span class="font-semibold text-gray-600">NIS:</span>
                <p class="text-gray-800">{{ $siswa->nis }}</p>
            </div>
            <div>
                <span class="font-semibold text-gray-600">Tempat Lahir:</span>
                <p class="text-gray-800">{{ $siswa->tempat_lahir }}</p>
            </div>
            <div>
                <span class="font-semibold text-gray-600">Tanggal Lahir:</span>
                <p class="text-gray-800">{{ $siswa->tanggal_lahir }}</p>
            </div>
            <div>
                <span class="font-semibold text-gray-600">Golongan Darah:</span>
                <p class="text-gray-800">{{ $siswa->gol_darah }}</p>
            </div>
            <div>
                <span class="font-semibold text-gray-600">Sekolah:</span>
                <p class="text-gray-800">{{ $siswa->sekolah }}</p>
            </div>
            <div>
                <span class="font-semibold text-gray-600">Alamat Sekolah:</span>
                <p class="text-gray-800">{{ $siswa->alamat_sekolah }}</p>
            </div>
            <div>
                <span class="font-semibold text-gray-600">Telepon Sekolah:</span>
                <p class="text-gray-800">{{ $siswa->telepon_sekolah }}</p>
            </div>
            <div>
                <span class="font-semibold text-gray-600">Nama Wali:</span>
                <p class="text-gray-800">{{ $siswa->nama_wali }}</p>
            </div>
            <div>
                <span class="font-semibold text-gray-600">Alamat Wali:</span>
                <p class="text-gray-800">{{ $siswa->alamat_wali }}</p>
            </div>
            <div>
                <span class="font-semibold text-gray-600">Telepon Wali:</span>
                <p class="text-gray-800">{{ $siswa->telepon_wali }}</p>
            </div>
        </div>

        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" onclick="hideModal()" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-blue-600 hover:text-blue-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Tutup
                </button>
            </div>
    </div>
<script>
    function hideModal() {
        document.getElementById('viewModal').classList.add('hidden');
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('viewModal');
        if (event.target === modal) {
            hideModal();
        }
    }

    // Close modal with ESC key
    document.onkeydown = function(evt) {
        evt = evt || window.event;
        if (evt.keyCode === 27) {
            hideModal();
        }
    };
</script>
</body>
</html>
