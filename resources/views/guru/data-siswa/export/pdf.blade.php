<!DOCTYPE html>
<html>
<head>
    <title>Data Siswa</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #f2f2f2; text-align: left; }
        .text-center { text-align: center; }
        .title { text-align: center; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="title">
        <h1>Data Siswa</h1>
        <p>Dicetak pada: {{ now()->format('d F Y H:i:s') }}</p>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>NIS</th>
                <th>Tempat, Tanggal Lahir</th>
                <th>Gol. Darah</th>
                <th>Sekolah</th>
                <th>Nama Wali</th>
            </tr>
        </thead>
        <tbody>
            @foreach($siswas as $siswa)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $siswa->nama_lengkap }}</td>
                <td>{{ $siswa->nis }}</td>
                <td>{{ $siswa->tempat_lahir }}, {{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->format('d/m/Y') }}</td>
                <td class="text-center">{{ $siswa->gol_darah }}</td>
                <td>{{ $siswa->sekolah }}</td>
                <td>{{ $siswa->nama_wali }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>