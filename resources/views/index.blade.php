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
                                    <option value="">Pilih Kategori</option>
                                    <option value="A">A. Pembelajaran dan Eksplorasi</option>
                                    <option value="B">B. Perencanaan dan Desain</option>
                                    <option value="C">C. Pengembangan / Implementasi</option>
                                    <option value="D">D. Pengujian dan Debugging</option>
                                    <option value="E">E. Kolaborasi dan Manajemen Proyek</option>
                                    <option value="F">F. Deployment dan Maintenance</option>
                                    <option value="G">G. Dokumentasi</option>
                                    <option value="H">H. Edukasi, Presentasi, dan Publikasi</option>
                                    <option value="REFACTOR">🔄 Refactor dan Optimasi</option>
                                    <option value="SECURITY">🔒 Keamanan dan Validasi</option>
                                    <option value="UIUX">🎨 UI/UX</option>
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
    "belajar": "A",
    "mempelajari": "A",
    "mempelajarinya": "A",
    "pelajari": "A",
    "explore": "A",
    "menjelajahi": "A",
    "eksplorasi": "A",
    "memahami": "A",
    "mengetahui": "A",
    "memperdalam": "A",
    "menganalisis": "A",
    "mengobservasi": "A",

    // Kategori B: Perencanaan & Desain
    "rencana": "B",
    "perencanaan": "B",
    "perancang": "B",
    "desain": "B",
    "merancang": "B",
    "mendesain": "B",
    "menggambar": "B",
    "mockup": "B",
    "wireframe": "B",
    "flowchart": "B",
    "struktur": "B",

    // Kategori C: Implementasi / Pengembangan
    "buat": "C",
    "membuat": "C",
    "membikin": "C",
    "mengembangkan": "C",
    "mengimplementasikan": "C",
    "implementasi": "C",
    "development": "C",
    "pengembangan": "C",
    "code": "C",
    "coding": "C",
    "menulis": "C",
    "menuliskan": "C",
    "program": "C",
    "pemrograman": "C",
    "script": "C",
    "koding": "C",

    // Kategori D: Pengujian & Perbaikan
    "debug": "D",
    "error": "D",
    "perbaikan": "D",
    "bug": "D",
    "tes": "D",
    "testing": "D",
    "pengujian": "D",
    "uji": "D",
    "pengetesan": "D",
    "review": "D",
    "evaluasi": "D",

    // Kategori E: Kolaborasi / Tim
    "team": "E",
    "kelompok": "E",
    "kolaborasi": "E",
    "diskusi": "E",
    "brainstorming": "E",
    "bareng": "E",
    "bersama": "E",
    "sharing": "E",
    "kerja sama": "E",

    // Kategori F: Deployment / Maintenance
    "deploy": "F",
    "deployment": "F",
    "rilis": "F",
    "publish": "F",
    "launch": "F",
    "maintenance": "F",
    "pemeliharaan": "F",
    "update": "F",
    "upgrade": "F",
    "revisi": "F",

    // Kategori G: Dokumentasi
    "dokumen": "G",
    "dokumentasi": "G",
    "catatan": "G",
    "penulisan": "G",
    "menuliskan": "G",
    "menulis": "G",
    "laporan": "G",
    "report": "G",
    "ringkasan": "G",

    // Kategori H: Presentasi / Publikasi
    "presentasi": "H",
    "slide": "H",
    "tampilan": "H",
    "publikasi": "H",
    "pemaparan": "H",
    "menjelaskan": "H",
    "showcase": "H",
    "demo": "H",

    // Tambahan Kategori: Refactor
    "refactor": "REFACTOR",
    "refactoring": "REFACTOR",
    "perapihan": "REFACTOR",

    // Tambahan Kategori: Security
    "validasi": "SECURITY",
    "keamanan": "SECURITY",
    "secure": "SECURITY",
    "proteksi": "SECURITY",
    "safety": "SECURITY",

    // Tambahan Kategori: UI/UX
    "ui": "UIUX",
    "ux": "UIUX",
    "antarmuka": "UIUX",
    "tampilan": "UIUX",
    "pengalaman": "UIUX",
    "desainui": "UIUX",
    "desainux": "UIUX"
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
