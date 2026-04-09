<!DOCTYPE html>
<html>

<head>
    <title>PathFinderIT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
    body {
        background: #F8F5F5;
    }

    .navbar {
        background-color: #6B1F1F;
    }

    .hero {
        height: 90vh;
        display: flex;
        align-items: center;
        text-align: center;
    }

    .btn-main {
        background-color: #6B1F1F;
        color: white;
    }

    .btn-main:hover {
        background-color: #A94442;
        color: white;
    }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-dark">
        <div class="container">
            <span class="navbar-brand fw-bold">PathFinderIT</span>
            <div>
                <a href="about.php" class="btn btn-outline-light btn-sm">About</a>
            </div>
        </div>
    </nav>

    <!-- HERO -->
    <div class="container hero">
        <div class="w-100">
            <h1 class="fw-bold">Ayo Tentukan Bidang Minat Informatikamu 🚀</h1>

            <p class="mt-3 text-muted">
                Sistem Pendukung Keputusan berbasis metode SMART untuk membantu kamu
                menemukan bidang yang paling sesuai dengan minatmu.
            </p>

            <a href="questionnaire.php" class="btn btn-main mt-4 px-4 py-2">
                Mulai Kuesioner
            </a>
        </div>
    </div>

    <!-- SECTION INFO -->
    <div class="container text-center mb-5">
        <div class="row">

            <div class="col-md-4 mb-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5>🎯 Akurat</h5>
                        <p>Menggunakan metode SMART untuk hasil yang objektif</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5>⚡ Cepat</h5>
                        <p>Hasil langsung keluar setelah kuesioner selesai</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5>📊 Informatif</h5>
                        <p>Memberikan rekomendasi berdasarkan minat kamu</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

</body>

</html>