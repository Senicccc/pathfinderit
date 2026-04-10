<?php include 'components/navbar.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <title>Kuesioner - PathFinderIT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="img/logo-pathfinderit.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
</head>

<body class="d-flex flex-column">

    <div class="questionnaire-container flex-grow-1">
        <div class="container">
            <div class="form-card">
                <h2>Kuesioner Minat Informatika</h2>

                <p style="text-align: center; color: #888; margin-bottom: 0.5rem; font-size: 0.95rem;">
                    Jawablah setiap pernyataan sesuai dengan dirimu saat ini
                </p>

                <p style="text-align: center; color: #aaa; margin-bottom: 2rem; font-size: 0.85rem;">
                    Tidak ada jawaban benar atau salah — pilih yang paling menggambarkan dirimu
                </p>

                <form action="process.php" method="POST">

                    <div class="form-group mb-4">
                        <input type="text" name="name" class="form-control input-name form-control-lg"
                            placeholder="Nama Anda (opsional)">
                    </div>

                    <?php
                    $questions = [
                        "Saya merasa tertarik untuk memahami bagaimana mesin dapat berpikir dan mengambil keputusan seperti manusia",
                        "Saya menikmati proses coding dan merasa puas ketika program yang saya buat berjalan dengan baik",
                        "Saya tertarik memahami bagaimana komputer dapat saling terhubung dan berkomunikasi dalam sebuah jaringan",
                        "Saya tertarik mengolah data untuk menemukan pola atau informasi yang bermakna",
                        "Saya menikmati kegiatan mengatur atau mengkonfigurasi jaringan komputer",
                        "Saya tertarik untuk mengembangkan aplikasi atau sistem yang dapat digunakan oleh banyak orang",
                        "Saya merasa nyaman bekerja dengan angka, statistik, atau analisis data",
                        "Saya merasa kesulitan ketika harus melakukan troubleshooting atau memperbaiki masalah jaringan",
                        "Saya memiliki keinginan untuk menciptakan sistem cerdas yang dapat belajar dan berkembang",
                        "Saya merasa bahwa proses analisis atau visualisasi data cukup rumit untuk dipahami",
                        "Saya sering merasa kesulitan atau bingung saat harus memahami logika dalam coding",
                        "Saya merasa bahwa konsep machine learning atau AI cukup sulit untuk dipahami"
                    ];

                    for ($i = 1; $i <= 12; $i++) {
                    ?>

                    <div class="form-group mb-4">
                        <label class="mb-3">
                            <strong style="color: #6b1f1f;">Pertanyaan <?= $i ?></strong><br>
                            <span style="color: #555;"><?= $questions[$i-1] ?></span>
                        </label>

                        <div class="radio-group">
                            <?php for ($j = 1; $j <= 5; $j++) { ?>
                            <label>
                                <input type="radio" name="q<?= $i ?>" value="<?= $j ?>" required>
                                <span><?= $j ?></span>
                            </label>
                            <?php } ?>
                        </div>

                        <!-- MICROCOPY -->
                        <div class="microcopy-hint">
                            1 = Sangat tidak sesuai &nbsp; | &nbsp; 5 = Sangat sesuai
                        </div>

                    </div>

                    <?php } ?>

                    <button type="submit" class="btn-submit">
                        Lihat Hasil Analisis
                    </button>
                </form>
            </div>
        </div>
    </div>

    <?php include 'components/footer.php'; ?>

    <!-- BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>