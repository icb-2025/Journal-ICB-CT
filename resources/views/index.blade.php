@extends('layouts.user')

@section('title', 'Input Data Kategori')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Form Input Data Kategori</h1>

        <form method="POST" action="{{ route('siswa.input-kategori.store') }}">
            @csrf

            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode Perusahaan</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Input</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mulai Pukul</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Selesai Pukul</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kegiatan</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data Kategori</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr>
                            <td class="px-4 py-4 text-sm font-medium text-gray-900">1</td>

                            <!-- Kode Perusahaan -->

@php
    $kodeBelakang = $perusahaanUser ? \Illuminate\Support\Str::afterLast($perusahaanUser->kode_perusahaan, '-') : '';
@endphp


<td class="px-4 py-4">
    @if ($perusahaanUser)
        <input type="hidden" name="company_code[]" value="{{ $perusahaanUser->id }}">
        <div class="p-2.5 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg">
    {{ $kodeBelakang }} - {{ $perusahaanUser->nama_industri }}
</div>
    @else
        <div class="p-2.5 text-red-600 text-sm">
            Perusahaan tidak ditemukan atau belum dikaitkan dengan user ini.
        </div>
    @endif
</td>






                            <!-- Tanggal -->
                            <td class="px-4 py-4">
                                <input type="date" name="input_date[]" value="{{ date('Y-m-d') }}" required
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </td>

                            <!-- Jam Mulai -->
                            <td class="px-4 py-4">
                                <input type="time" name="start_time[]" required
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </td>

                            <!-- Jam Selesai -->
                            <td class="px-4 py-4">
                                <input type="time" name="end_time[]" required
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </td>

                            <!-- Deskripsi Kegiatan -->
                            <td class="px-4 py-4">
                                <textarea name="description[]" rows="3" required
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="Masukkan Kegiatan"></textarea>
                            </td>

                            <!-- Kategori Tugas -->
                            <td class="px-4 py-4">
                                <select name="category[]" required
    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
    <option value="">Kategori</option>
    @foreach($kategoriTugas as $kategori)
        <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
    @endforeach
</select>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Tombol Submit -->
            <div class="mt-6 flex justify-end">
                <button type="submit"
                    class="text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                    Simpan Data
                </button>
            </div>
        </form>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const kategoriMapping = {
    // Kategori A: Pembelajaran
    "belajar": "3",
    "mempelajari": "3",
    "mempelajarinya": "3",
    "pelajari": "3",
    "explore": "3",
    "menjelajahi": "3",
    "eksplorasi": "3",
    "memahami": "3",
    "mengetahui": "3",
    "memperdalam": "3",
    "menganalisis": "3",
    "mengobservasi": "3",

    // Kategori B: Perencanaan & Desain
    "rencana": "4",
    "perencanaan": "4",
    "perancang": "4",
    "desain": "4",
    "merancang": "4",
    "mendesain": "4",
    "menggambar": "4",
    "mockup": "4",
    "wireframe": "4",
    "flowchart": "4",
    "struktur": "4",

    // Kategori C: Implementasi / Pengembangan
    "buat": "5",
    "membuat": "5",
    "membikin": "5",
    "mengembangkan": "5",
    "mengimplementasikan": "5",
    "implementasi": "5",
    "development": "5",
    "pengembangan": "5",
    "code": "5",
    "coding": "5",
    "menulis": "5",
    "menuliskan": "5",
    "program": "5",
    "pemrograman": "5",
    "script": "5",
    "koding": "5",

    // Kategori D: Pengujian & Perbaikan
    "debug": "6",
    "error": "6",
    "perbaikan": "6",
    "bug": "6",
    "tes": "6",
    "testing": "6",
    "pengujian": "6",
    "uji": "6",
    "pengetesan": "6",
    "review": "6",
    "evaluasi": "6",

    // Kategori E: Kolaborasi / Tim
    "team": "7",
    "kelompok": "7",
    "kolaborasi": "7",
    "diskusi": "7",
    "brainstorming": "7",
    "bareng": "7",
    "bersama": "7",
    "sharing": "7",
    "kerja sama": "7",

    // Kategori F: Deployment / Maintenance
    "deploy": "8",
    "deployment": "8",
    "rilis": "8",
    "publish": "8",
    "launch": "8",
    "maintenance": "8",
    "pemeliharaan": "8",
    "update": "8",
    "upgrade": "8",
    "revisi": "8",

    // Kategori G: Dokumentasi
    "dokumen": "9",
    "dokumentasi": "9",
    "catatan": "9",
    "penulisan": "9",
    "menuliskan": "9",
    "menulis": "9",
    "laporan": "9",
    "report": "9",
    "ringkasan": "9",

    // Kategori H: Presentasi / Publikasi
    "presentasi": "10",
    "slide": "10",
    "tampilan": "10",
    "publikasi": "10",
    "pemaparan": "10",
    "menjelaskan": "10",
    "showcase": "10",
    "demo": "10",

    // Tambahan Kategori: Refactor
    "refactor": "11",
    "refactoring": "11",
    "perapihan": "11",

    // Tambahan Kategori: Security
    "validasi": "2",
    "keamanan": "2",
    "secure": "2",
    "proteksi": "2",
    "safety": "2",

    // Tambahan Kategori: UI/UX
    "ui": "13",
    "ux": "13",
    "antarmuka": "13",
    "tampilan": "13",
    "pengalaman": "13",
    "desainui": "13",
    "desainux": "13"
};


        const rows = document.querySelectorAll('tbody tr');

        rows.forEach(row => {
            const descriptionInput = row.querySelector('textarea[name="description[]"]');
            const categorySelect = row.querySelector('select[name="category[]"]');

            if (descriptionInput && categorySelect) {
                descriptionInput.addEventListener('input', function () {
                    const text = this.value.toLowerCase();
                    let detected = null;

                    for (const [keyword, kategori] of Object.entries(kategoriMapping)) {
                        if (text.includes(keyword)) {
                            detected = kategori;
                            break;
                        }
                    }

                    // Reset semua option visibility
                    for (const option of categorySelect.options) {
                        option.hidden = false;
                    }

                    // Sembunyikan semua kecuali yang cocok
                    for (const option of categorySelect.options) {
                        if (detected !== null && option.value !== "" && option.value !== detected) {
                            option.hidden = true;
                        }
                    }

                    // Auto pilih jika cocok
                    if (detected) categorySelect.value = detected;
                });
            }
        });
    });
</script>


@endsection
