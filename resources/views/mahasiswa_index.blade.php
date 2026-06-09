<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa Kursus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container my-5">
        <h2 class="text-center mb-4 fw-bold text-primary">Daftar Mahasiswa Kursus Bahasa</h2>
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>NIM</th>
                            <th>Nama Lengkap</th>
                            <th>Jurusan</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mahasiswa as $m)
                        <tr>
                            <td class="fw-bold text-secondary">{{ $m->nim }}</td>
                            <td>{{ $m->nama }}</td>
                            <td><span class="badge bg-info text-dark">{{ $m->jurusan }}</span></td>
                            <td>{{ $m->email }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>