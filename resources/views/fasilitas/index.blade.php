<!DOCTYPE html>
<html>
<head>
    <title>Data Fasilitas Desa</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #e17dd6ff; }
    </style>
</head>
<body>
    <h2>Daftar Fasilitas Desa & Peminjaman Ruang</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Jenis</th>
                <th>Alamat</th>
                <th>RT</th>
                <th>RW</th>
                <th>Kapasitas</th>
                <th>Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($fasilitas as $item)
                <tr>
                    <td>{{ $item['fasilitas_id'] }}</td>
                    <td>{{ $item['nama'] }}</td>
                    <td>{{ $item['jenis'] }}</td>
                    <td>{{ $item['alamat'] }}</td>
                    <td>{{ $item['rt'] }}</td>
                    <td>{{ $item['rw'] }}</td>
                    <td>{{ $item['kapasitas'] }}</td>
                    <td>{{ $item['deskripsi'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
