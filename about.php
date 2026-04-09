<!DOCTYPE html>
<html>

<head>
    <title>About - PathFinderIT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
    body {
        background: #F8F5F5;
    }

    .navbar {
        background-color: #6B1F1F;
    }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-dark">
        <div class="container">
            <a href="index.php" class="navbar-brand fw-bold">PathFinderIT</a>
        </div>
    </nav>

    <!-- CONTENT -->
    <div class="container mt-5">

        <h3 class="mb-4">Tentang PathFinderIT</h3>

        <p>
            PathFinderIT adalah Sistem Pendukung Keputusan (SPK) yang dirancang untuk membantu mahasiswa
            menentukan bidang minat di dunia Informatika berdasarkan preferensi dan minat pengguna.
        </p>

        <h5 class="mt-4">Metode yang Digunakan</h5>
        <p>
            Sistem ini menggunakan metode <b>SMART (Simple Multi Attribute Rating Technique)</b>,
            yaitu metode pengambilan keputusan berbasis pembobotan dan penilaian utilitas.
        </p>

        <h5 class="mt-4">Cara Kerja Sistem</h5>
        <ul>
            <li>Pengguna mengisi kuesioner</li>
            <li>Sistem melakukan normalisasi nilai (utility)</li>
            <li>Dihitung menggunakan metode SMART</li>
            <li>Menampilkan ranking bidang minat</li>
        </ul>

        <h5 class="mt-4">Tujuan</h5>
        <p>
            Membantu pengguna dalam menentukan bidang minat secara objektif berdasarkan data,
            bukan hanya asumsi.
        </p>

    </div>

</body>

</html>