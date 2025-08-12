@extends('layouts.user')

@section('title', 'Dashboard')

@section('content')
<div class="container mx-auto px-4 py-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-6">
            <h1 class="text-xl sm:text-2xl font-bold text-white">Input Kegiatan</h1>
            <p class="text-blue-100 mt-1 text-sm sm:text-base">Isi aktivitas harian Anda dengan detail</p>
        </div>

        <div class="p-4 sm:p-6">
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
                        <thead class="bg-gray-50 hidden sm:table-header-group">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode Perusahaan</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Input</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mulai Pukul</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Selesai Pukul</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-[320px]">Kegiatan</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-[240px]">Kategori</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900 align-top">1</td>

                                @php
                                    $kodeBelakang = $perusahaanUser ? \Illuminate\Support\Str::afterLast($perusahaanUser->kode_perusahaan, '-') : '';
                                    $user = Auth::user();
                                    $isSiswa = $user->role === 'siswa';
                                    $akunAktif = $user->status === 'aktif';
                                    $statusDefault = 'masuk';
                                @endphp

                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 align-top">
                                    @if ($perusahaanUser)
                                        <input type="hidden" name="company_code[]" value="{{ $perusahaanUser->id }}">
                                        <div class="p-2 bg-gray-100 border border-gray-200 rounded-md text-gray-700">
                                            <span class="font-semibold">{{ $kodeBelakang }}</span> - {{ $perusahaanUser->nama_industri }}
                                        </div>
                                    @else
                                        <div class="p-2 text-red-600 text-xs sm:text-sm bg-red-50 rounded-md border border-red-100">
                                            @if (!$isSiswa)
                                                Anda Bukan Siswa
                                            @elseif (!$akunAktif)
                                                Akun Anda telah expired, silakan hubungi guru.
                                            @else
                                                Perusahaan tidak ditemukan atau belum dikaitkan dengan user ini.
                                            @endif
                                        </div>
                                    @endif
                                </td>

                                <td class="px-4 py-4 whitespace-nowrap align-top">
                                    <label class="sm:hidden block text-xs text-gray-500 mb-1">Tanggal Input</label>
                                    <input type="date" name="input_date[]" value="{{ date('Y-m-d') }}" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-sm">
                                </td>

                                <td class="px-4 py-4 whitespace-nowrap align-top min-w-[115px]">
    <label class="sm:hidden block text-xs text-gray-500 mb-1">Status</label>
    <select name="status[]" 
        class="status-select w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
               focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-sm">
        <option value="masuk" selected>Masuk</option>
        <option value="izin">Izin</option>
        <option value="sakit">Sakit</option>
    </select>
</td>


                                <td class="px-4 py-4 whitespace-nowrap align-top">
                                    <label class="sm:hidden block text-xs text-gray-500 mb-1">Mulai Pukul</label>
                                    <input type="time" name="start_time[]"
                                        class="start-time-input w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-sm"
                                        {{ $statusDefault == 'sakit' ? 'disabled' : '' }}>
                                </td>

                                <td class="px-4 py-4 whitespace-nowrap align-top">
                                    <label class="sm:hidden block text-xs text-gray-500 mb-1">Selesai Pukul</label>
                                    <input type="time" name="end_time[]"
                                        class="end-time-input w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-sm"
                                        {{ $statusDefault == 'sakit' ? 'disabled' : '' }}>
                                </td>

                                <!-- Deskripsi Kegiatan -->
                                <td class="px-4 py-4 align-top min-w-[220px]">
                                    <label class="sm:hidden block text-xs text-gray-500 mb-1">Kegiatan</label>
                                    <textarea name="description[]" rows="3" maxlength="300" required
                                        oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')"
                                        class="desc-input w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm resize-none focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-sm"
                                        placeholder="Deskripsikan kegiatan Anda..."></textarea>
                                </td>


                                <!-- Kategori Tugas -->
                                <td class="px-4 py-4 align-top min-w-[165px]">
                                    <label class="sm:hidden block text-xs text-gray-500 mb-1">Kategori</label>
                                    <select name="category[]"
                                        class="category-select w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-sm"
                                        {{ in_array($statusDefault, ['izin', 'sakit']) ? 'disabled' : '' }}>
                                        <option value="">Pilih Kategori</option>
                                        @foreach($kategoriTugas as $kategori)
                                            <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="mt-6 flex justify-end space-x-3">
                    @if ($sudahInputHariIni)
                        <button type="button" disabled
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-gray-400 cursor-not-allowed opacity-60">
                            Sudah Mengisi Hari Ini
                        </button>
                    @else
                        <button type="submit" id="simpanDataBtn"
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
            <div class="p-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800">Riwayat Kegiatan</h2>
                <p class="text-sm text-gray-600 mt-1">Daftar kegiatan yang telah Anda input sebelumnya</p>
            </div>
            <div id="history-container">
                @include('partials.activity-history', ['aktivitasSiswa' => $aktivitasSiswa])
            </div>
        </div>
    @endif
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection
