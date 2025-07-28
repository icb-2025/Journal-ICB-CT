<!DOCTYPE html>
<html>
<head>
    <title>Data Siswa</title>
    <style>
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #e2e8f0;
            padding: 6px 8px;
            text-align: left;
            vertical-align: top;
        }
        th {
            background-color: #f7fafc;
            font-weight: 600;
            color: #4a5568;
            text-transform: uppercase;
            font-size: 9px;
        }
        tr:nth-child(even) {
            background-color: #f8fafc;
        }
        .header {
            text-align: center;
            margin-bottom: 15px;
        }
        .header h1 {
            font-size: 16px;
            color: #2d3748;
            margin-bottom: 3px;
        }
        .header p {
            font-size: 10px;
            color: #718096;
        }
        .text-center {
            text-align: center;
        }
        .nowrap {
            white-space: nowrap;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>DATA SISWA</h1>
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
                <th>Alamat Sekolah</th>
                <th>No. Telp/Fax</th>
                <th>Nama Ortu/Wali</th>
                <th>Alamat Ortu/Wali</th>
                <th>No. Telp Ortu/Wali</th>
            </tr>
        </thead>
        <tbody>
            @foreach($siswas as $siswa)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td class="nowrap">{{ $siswa->nama_lengkap ?? '-' }}</td>
                <td class="nowrap">{{ $siswa->nis ?? '-' }}</td>
                <td class="nowrap">
                    {{ $siswa->tempat_lahir ?? '-' }}, {{ isset($siswa->tanggal_lahir) ? \Carbon\Carbon::parse($siswa->tanggal_lahir)->format('d/m/Y') : '-' }}
                </td>
                <td class="text-center">{{ $siswa->gol_darah ?? '-' }}</td>
                <td>{{ $siswa->sekolah ?? '-' }}</td>
                <td>{{ $siswa->alamat_sekolah ?? '-' }}</td>
                <td class="nowrap">{{ $siswa->no_telepon ?? $siswa->telepon_sekolah ?? '-' }}</td>
                <td class="nowrap">{{ $siswa->nama_orang_tua ?? $siswa->nama_wali ?? '-' }}</td>
                <td>{{ $siswa->alamat_orang_tua ?? $siswa->alamat_wali ?? '-' }}</td>
                <td class="nowrap">{{ $siswa->no_telepon_orang_tua ?? $siswa->telepon_wali ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>