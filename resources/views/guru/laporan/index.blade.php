@extends('layouts.guru')

@section('title', 'Data Aktivitas Siswa')

@section('content')
    <div class="container mt-4">
        <h3>Data Aktivitas Siswa</h3>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>Perusahaan</th>
                    <th>Tanggal</th>
                    <th>Jam Mulai</th>
                    <th>Jam Selesai</th>
                    <th>Kegiatan</th>
                    <th>Kategori Tugas</th>
                </tr>
            </thead>
            <tbody>
                @forelse($aktivitas as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->siswa->name ?? '-' }}</td>
                        <td>{{ $item->perusahaan->nama_industri ?? '-' }}</td>
                        <td>{{ $item->tanggal }}</td>
                        <td>{{ $item->mulai }}</td>
                        <td>{{ $item->selesai }}</td>
                        <td>{{ $item->deskripsi }}</td>
                        <td>{{ $item->kategoriTugas->nama_kategori ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8">Tidak ada data aktivitas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
