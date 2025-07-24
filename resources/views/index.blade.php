@extends('layouts.user')

@section('title', 'Input Data Kategori')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Form Input Data Kategori</h1>
        
        <form method="POST" action="">
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
                            <td class="px-4 py-4">
                                <input type="text" name="company_code[]" value="PRSHN-001" 
                                    class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
                                    readonly>
                            </td>
                            <td class="px-4 py-4">
                                <input type="date" name="input_date[]" value="{{ date('Y-m-d') }}"
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </td>
                            <td class="px-4 py-4">
                                <input type="time" name="start_time[]" 
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </td>
                            <td class="px-4 py-4">
                                <input type="time" name="end_time[]" 
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </td>
                            <td class="px-4 py-4">
                                <textarea name="description[]" rows="3"
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="Masukkan Kegiatan"></textarea>
                            </td>
                            <td class="px-4 py-4">
                                <select name="category[]" 
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
                                    <option value="REFACTOR">🔄 Aktivitas Refactor dan Optimasi</option>
                                    <option value="SECURITY">🔒 Keamanan dan Validasi</option>
                                    <option value="UIUX">🎨 UI/UX</option>
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="mt-6 flex justify-end">
                <button type="submit" class="text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                    Simpan Data
                </button>
            </div>

        </form>
    </div>
</div>
@endsection
