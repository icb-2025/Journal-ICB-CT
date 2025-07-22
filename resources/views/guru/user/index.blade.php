@extends('layouts.user')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-xl font-semibold mb-6">Input Kegiatan Harian</h2>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="w-16 px-3 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                    <th class="w-48 px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tempat/Tanggal</th>
                    <th class="w-28 px-3 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Mulai</th>
                    <th class="w-28 px-3 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Selesai</th>
                    <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kegiatan</th>
                    <th class="w-32 px-3 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr>
                    <td class="px-3 py-3 text-center">
                        <input type="text" class="input-field w-12 px-2 py-1.5 text-center border rounded-md">
                    </td>
                    <td class="px-3 py-3">
                        <input type="text" class="input-field w-full px-2 py-1.5 border rounded-md">
                    </td>
                    <td class="px-3 py-3 text-center">
                        <input type="time" class="input-field w-24 px-2 py-1.5 border rounded-md">
                    </td>
                    <td class="px-3 py-3 text-center">
                        <input type="time" class="input-field w-24 px-2 py-1.5 border rounded-md">
                    </td>
                    <td class="px-3 py-3">
                        <textarea rows="1" class="input-field w-full px-2 py-1.5 border rounded-md"></textarea>
                    </td>
                    <td class="px-3 py-3 text-center">
                        <div id="action-buttons" class="hidden flex justify-center space-x-2">
                            <button type="button" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">Input</button>
                            <button type="button" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Hapus</button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script>
    const inputs = document.querySelectorAll('.input-field');
    const actionButtons = document.getElementById('action-buttons');

    function checkAllFilled() {
        return Array.from(inputs).every(input => input.value.trim() !== '');
    }

    inputs.forEach(input => {
        input.addEventListener('input', () => {
            if (checkAllFilled()) {
                actionButtons.classList.remove('hidden');
            } else {
                actionButtons.classList.add('hidden');
            }
        });
    });
</script>
@endsection
