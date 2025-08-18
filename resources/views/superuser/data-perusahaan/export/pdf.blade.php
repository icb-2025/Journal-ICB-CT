<!DOCTYPE html>
<html>
<head>
    <title>Data Perusahaan</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .title { font-size: 16px; font-weight: bold; }
        .date { font-size: 14px; margin-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 8px; }
        th { background-color: #f2f2f2; text-align: center; }
        .text-center { text-align: center; }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">LAPORAN DATA PERUSAHAAN</div>
        <div class="date">Dicetak pada: {{ $tanggal }}</div>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Nama Industri</th>
                <th>Bidang Usaha</th>
                <th>Alamat</th>
                <th>No Telp</th>
                <th>Direktur</th>
                <th>Pembimbing</th>
                <th>Input Oleh</th>
            </tr>
        </thead>
        <tbody>
            @foreach($perusahaans as $perusahaan)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $perusahaan->kode_perusahaan }}</td>
                <td>{{ $perusahaan->nama_industri }}</td>
                <td>{{ $perusahaan->bidang_usaha }}</td>
                <td>{{ $perusahaan->alamat }}</td>
                <td>{{ $perusahaan->no_telepon }}</td>
                <td>{{ $perusahaan->nama_direktur }}</td>
                <td>{{ $perusahaan->nama_pembimbing }}</td>
                <td>{{ $perusahaan->user->name ?? 'System' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>