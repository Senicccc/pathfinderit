<?php include 'components/navbar.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <title>About - PathFinderIT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="img/logo-pathfinderit.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
</head>

<body class="d-flex flex-column">

    <div class="about-container flex-grow-1">
        <div class="container">
            <div class="about-content">

                <h2>Tentang PathFinderIT</h2>

                <p>
                    <strong>PathFinderIT</strong> adalah Sistem Pendukung Keputusan (SPK) yang dirancang khusus untuk
                    membantu mahasiswa
                    menentukan bidang minat di dunia Informatika berdasarkan preferensi, kemampuan, dan minat pengguna
                    secara objektif.
                </p>

                <div class="feature-box">
                    <strong>Visi</strong><br>
                    Membantu mahasiswa informatika menemukan bidang keahlian yang paling sesuai dengan potensi mereka
                    melalui analisis data yang berbasis ilmiah.
                </div>

                <h3>Metode yang Digunakan</h3>
                <p>
                    Sistem ini menggunakan metode <strong>SMART (Simple Multi Attribute Rating Technique)</strong>,
                    yaitu metode pengambilan keputusan berbasis pembobotan dan penilaian utilitas yang telah terbukti
                    efektif
                    dalam berbagai aplikasi pengambilan keputusan multi-kriteria.
                </p>

                <div class="feature-box">
                    <strong>Keunggulan Metode SMART</strong>
                    <ul style="margin: 0.5rem 0 0 0;">
                        <li>Sistematis dan terukur</li>
                        <li>Berbasis data dan kriteria yang jelas</li>
                        <li>Mudah dipahami dan diimplementasikan</li>
                        <li>Memberikan hasil yang objektif</li>
                    </ul>
                </div>

                <h3>Cara Kerja Sistem</h3>
                <ul>
                    <li><strong>Langkah 1: Pengisian Kuesioner</strong> - Pengguna menjawab 12 pertanyaan untuk mengukur
                        minat dan preferensi</li>
                    <li><strong>Langkah 2: Normalisasi Nilai</strong> - Sistem melakukan normalisasi nilai (utility)
                        dari setiap jawaban</li>
                    <li><strong>Langkah 3: Perhitungan SMART</strong> - Dihitung menggunakan metode SMART dengan bobot
                        yang telah ditentukan</li>
                    <li><strong>Langkah 4: Hasil dan Rekomendasi</strong> - Menampilkan ranking bidang minat dengan
                        penjelasan detail</li>
                </ul>

                <h3>Bidang Minat yang Dianalisis</h3>
                <div
                    style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin: 1.5rem 0;">
                    <div class="feature-box">
                        <strong>AI (Artificial Intelligence)</strong><br>
                        Kecerdasan buatan dan machine learning
                    </div>
                    <div class="feature-box">
                        <strong>SE (Software Engineering)</strong><br>
                        Pengembangan aplikasi dan software
                    </div>
                    <div class="feature-box">
                        <strong>DS (Data Science)</strong><br>
                        Analisis data dan visualisasi
                    </div>
                    <div class="feature-box">
                        <strong>CN (Computer Networking)</strong><br>
                        Jaringan komputer dan infrastruktur
                    </div>
                </div>

                <h3>Tujuan Sistem</h3>
                <p>
                    Membantu pengguna dalam menentukan bidang minat secara <strong>objektif berdasarkan data</strong>,
                    bukan hanya asumsi atau pendapat subjektif. Hasil dari sistem ini dapat dijadikan sebagai
                    <strong>acuan awal</strong> dalam menentukan arah pengembangan karier dan studi lebih lanjut.
                </p>

                <div class="feature-box"
                    style="background: linear-gradient(135deg, rgba(255, 107, 107, 0.1), rgba(107, 31, 31, 0.1)); border-left-color: #ff6b6b;">
                    <strong>Catatan Penting</strong><br>
                    Hasil yang ditampilkan adalah panduan awal yang dapat dikembangkan lebih lanjut. Anda tetap memiliki
                    kesempatan untuk mengeksplorasi berbagai bidang lainnya. Dengan eksplorasi lebih lanjut dan
                    pengalaman praktis,
                    Anda dapat menemukan bidang yang paling sesuai dengan passion dan skill Anda.
                </div>

            </div>
        </div>
    </div>

    <?php include 'components/footer.php'; ?>

    <!-- BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>