<!DOCTYPE html>
<html>
<head>
    <title>Laporan Aktivitas Siswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            color: #333;
        }
        .title {
            text-align: center;
            margin-bottom: 10px;
        }
        .title h2 {
            margin: 0;
            font-size: 18px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .title p {
            margin: 3px 0 0;
            font-size: 12px;
            color: #666;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            font-size: 13px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 6px 8px;
        }
        th {
            background-color: #f4f6f9;
            font-weight: bold;
            text-align: center;
        }
        td {
            vertical-align: middle;
        }
        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="title">
        <h2>Laporan Aktivitas Siswa</h2>
        <p>Tanggal Cetak: {{ date('d F Y') }}</p>
    </div>

    <table>
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
                <th>Jurusan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($aktivitas as $item)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $item->siswa->name ?? '-' }}</td>
                <td>{{ $item->perusahaan->nama_industri ?? '-' }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($item->mulai)->format('H:i') }}</td>
                <td>{{ \Carbon\Carbon::parse($item->selesai)->format('H:i') }}</td>
                <td>{{ $item->deskripsi ?? '-' }}</td>
                <td>{{ $item->kategoriTugas->nama_kategori ?? '-' }}</td>
                <td>{{ $item->siswa->jurusan->nama_jurusan ?? '-' }}</td>
                <td>{{ $item->status ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
