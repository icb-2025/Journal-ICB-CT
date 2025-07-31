@extends('layouts.user')

@section('title', 'Input Data Kategori')

@section('content')
<div class="container mx-auto py-2">
    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-5">
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-6">
            <h1 class="text-2xl font-bold text-white">Input Kegiatan</h1>
            <p class="text-blue-100 mt-1">Isi aktivitas harian Anda dengan detail</p>
        </div>

        <div class="p-6">

       @php
    use App\Models\AktivitasSiswa;

    $sudahInputHariIni = AktivitasSiswa::where('siswa_id', Auth::id())
        ->where('tanggal', now()->toDateString())
        ->exists();
@endphp

            <form method="POST" action="{{ route('siswa.input-kategori.store') }}">
                @csrf

                <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-sm">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode Perusahaan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Input</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mulai Pukul</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Selesai Pukul</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kegiatan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 align-top">1</td>

                                <!-- Kode Perusahaan -->
                                @php
                                    $kodeBelakang = $perusahaanUser ? \Illuminate\Support\Str::afterLast($perusahaanUser->kode_perusahaan, '-') : '';
                                @endphp

                                @php
                                    use Illuminate\Support\Facades\Auth;

                                    $user = Auth::user();
                                    $role = $user->role; // asumsi field 'role' ada
                                    $isSiswa = $role === 'siswa';
                                    $akunAktif = $user->status === 'aktif'; // atau sesuaikan dengan field yg Anda pakai
                                @endphp

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 align-top">
                                    @if ($perusahaanUser)
                                        <input type="hidden" name="company_code[]" value="{{ $perusahaanUser->id }}">
                                        <div class="p-2 bg-gray-100 border border-gray-200 rounded-md text-gray-700">
                                            <span class="font-semibold">{{ $kodeBelakang }}</span> - {{ $perusahaanUser->nama_industri }}
                                        </div>
                                    @else
                                        <div class="p-2 text-red-600 text-sm bg-red-50 rounded-md border border-red-100">
                                            @if (!$isSiswa)
                                                Anda Bukan Siswa
                                            @elseif (!$akunAktif)
                                                Akun Anda Telah expired silahkan hubungi guru
                                            @else
                                                Perusahaan tidak ditemukan atau belum dikaitkan dengan user ini.
                                            @endif
                                        </div>
                                    @endif
                                </td>

                                <!-- Tanggal -->
                                <td class="px-6 py-4 whitespace-nowrap align-top">
                                    <input type="date" name="input_date[]" value="{{ date('Y-m-d') }}" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-sm">
                                </td>

                                <!-- Jam Mulai -->
                                <td class="px-6 py-4 whitespace-nowrap align-top">
                                    <input type="time" name="start_time[]" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-sm">
                                </td>

                                <!-- Jam Selesai -->
                                <td class="px-6 py-4 whitespace-nowrap align-top">
                                    <input type="time" name="end_time[]" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-sm">
                                </td>

                                <!-- Deskripsi Kegiatan -->
                              <td class="px-6 py-4 align-top">
    <textarea name="description[]" rows="3" maxlength="300" required
        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm resize-none max-h-[6.5rem] focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-sm"
        placeholder="Deskripsikan kegiatan Anda..."></textarea>
    <p class="text-xs text-gray-500 mt-1">Ketik kegiatan untuk deteksi otomatis kategori</p>
</td>


                                <!-- Kategori Tugas -->
                                <td class="px-6 py-4 align-top">
                                    <select name="category[]" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-sm">
                                        <option value="">Pilih Kategori</option>
                                        @foreach($kategoriTugas as $kategori)
                                            <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-xs text-gray-500 mt-1">Akan terdeteksi otomatis</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Tombol Submit -->
              <div class="mt-6 flex justify-end space-x-3">
    @if ($sudahInputHariIni)
        <button type="button" disabled
            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-gray-400 cursor-not-allowed opacity-60">
            Sudah Mengisi Hari Ini
        </button>
    @else
        <button type="submit"
            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
            </svg>
            Simpan Data
        </button>
    @endif
</div>

            </form>
        </div>
    </div>

    @if($aktivitasSiswa->count())
   <div class="mt-8 bg-white rounded-lg shadow-md overflow-hidden">
    <div class="max-h-32 overflow-y-auto border-t border-gray-200">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-blue-100 sticky top-0 z-10 text-sm">
                <tr>
                    <th class="px-6 py-3 text-left font-medium text-gray-700 uppercase tracking-wider">No</th>
                    <th class="px-6 py-3 text-left font-medium text-gray-700 uppercase tracking-wider">Kode Perusahaan</th>
                    <th class="px-6 py-3 text-left font-medium text-gray-700 uppercase tracking-wider">Tanggal</th>
                    <th class="px-6 py-3 text-left font-medium text-gray-700 uppercase tracking-wider">Mulai</th>
                    <th class="px-6 py-3 text-left font-medium text-gray-700 uppercase tracking-wider">Selesai</th>
                    <th class="px-6 py-3 text-left font-medium text-gray-700 uppercase tracking-wider">Kegiatan</th>
                    <th class="px-6 py-3 text-left font-medium text-gray-700 uppercase tracking-wider">Kategori</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 text-sm">
                @foreach($aktivitasSiswa as $index => $item)
                    <tr class="hover:bg-gray-50 transition duration-150">
                        <td class="px-6 py-4 whitespace-nowrap text-gray-900">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 align-top text-gray-700">
                            @if ($perusahaanUser)
                                <input type="hidden" name="company_code[]" value="{{ $perusahaanUser->id }}">
                                <div class="p-2 bg-gray-100 border border-gray-200 rounded-md">
                                    <span class="font-semibold">{{ $kodeBelakang }}</span> - {{ $perusahaanUser->nama_industri }}
                                </div>
                            @else
                                <div class="p-2 text-red-600 text-sm bg-red-50 rounded-md border border-red-100">
                                    @if (!$isSiswa)
                                        Anda Bukan Siswa
                                    @elseif (!$akunAktif)
                                        Akun Anda Telah expired, silahkan hubungi guru
                                    @else
                                        Perusahaan tidak ditemukan atau belum dikaitkan dengan user ini.
                                    @endif
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">
                            {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">{{ $item->mulai }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">{{ $item->selesai }}</td>
                        <td class="px-6 py-4 text-gray-500">{{ $item->deskripsi }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                {{ $item->kategoriTugas->nama_kategori ?? '-' }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


    @endif
</div>

<!-- <script>
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

                // Cek kecocokan dengan keyword terpanjang dulu
                const sortedKeywords = Object.keys(kategoriMapping).sort((a, b) => b.length - a.length);
                for (const keyword of sortedKeywords) {
                    if (text.includes(keyword)) {
                        detected = kategoriMapping[keyword];
                        break;
                    }
                }

                // Reset visibility semua opsi
                for (const option of categorySelect.options) {
                    option.hidden = false;
                }

                // Sembunyikan semua kecuali yang cocok (jika ditemukan)
                if (detected) {
                    for (const option of categorySelect.options) {
                        if (option.value !== "" && option.text !== detected) {
                            option.hidden = true;
                        }
                    }

                    // Pilih otomatis
                    for (const option of categorySelect.options) {
                        if (option.text === detected) {
                            categorySelect.value = option.value;
                            break;
                        }
                    }
                }
            });
        }
    });
});
</script> -->
@endsection