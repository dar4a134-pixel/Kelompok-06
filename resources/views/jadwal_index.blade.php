<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Kursus Bahasa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container my-5">
        <h2 class="text-center mb-2 fw-bold text-success">Jadwal Kelas Kursus Bahasa</h2>
        <p class="text-center text-muted mb-5">Gabungan Data Jadwal, Bahasa, dan Instruktur via MySQL View</p>
        
        <div class="row g-4">
            @foreach($jadwal as $j)
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-header bg-success text-white fw-bold py-3">
                        Kelas Bahasa: {{ $j->nama_bahasa }}
                    </div>
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-muted">Tingkat: <span class="badge bg-secondary">{{ $j->tingkat }}</span></h6>
                        <hr>
                        <p class="card-text mb-1"><strong>Instruktur:</strong> {{ $j->nama_instruktur }}</p>
                        <p class="card-text mb-1"><strong>Hari:</strong> {{ $j->hari }}</p>
                        <p class="card-text mb-0"><strong>Jam:</strong> {{ \Carbon\Carbon::parse($j->jam)->format('H:i') }} WIB</p>
                    </div>
                    <div class="card-footer bg-white border-0 text-end pb-3">
                        <span class="badge bg-light text-success border border-success">ID: {{ $j->id_jadwal }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</body>
</html>