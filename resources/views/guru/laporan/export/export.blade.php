<!DOCTYPE html>
<html>
<head>
    <title>Laporan Aktivitas Siswa</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .text-center { text-align: center; }
        .title { text-align: center; margin-bottom: 20px; }
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
            </tr>
        </thead>
        <tbody>
            @foreach($aktivitas as $item)
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
            @endforeach
        </tbody>
    </table>
</body>
</html><!DOCTYPE html>
<html>
<head>
    <title>Laporan Aktivitas Siswa</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .text-center { text-align: center; }
        .title { text-align: center; margin-bottom: 20px; }
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
            </tr>
        </thead>
        <tbody>
            @foreach($aktivitas as $item)
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
            @endforeach
        </tbody>
    </table>
</body>
</html>