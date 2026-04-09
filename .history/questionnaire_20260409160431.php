<!DOCTYPE html>
<html>

<head>
    <title>Kuesioner - PathFinderIT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <h3 class="text-center mb-4">Kuesioner Minat Informatika</h3>

        <form action="process.php" method="POST">

            <input type="text" name="name" class="form-control mb-3" placeholder="Nama (opsional)">

            <?php
        $questions = [
            "Saya tertarik dengan kecerdasan buatan",
            "Saya suka coding",
            "Saya tertarik jaringan komputer",
            "Saya suka analisis data",
            "Saya suka konfigurasi jaringan",
            "Saya suka membuat aplikasi",
            "Saya tertarik statistik",
            "Saya suka troubleshooting jaringan",
            "Saya ingin membuat sistem pintar",
            "Saya suka visualisasi data",
            "Coding itu sulit bagi saya",
            "Saya tertarik machine learning"
        ];

        for ($i = 1; $i <= 12; $i++) {
        ?>

            <div class="mb-3">
                <label><?= $i . ". " . $questions[$i-1] ?></label><br>

                <?php for ($j = 1; $j <= 5; $j++) { ?>
                <input type="radio" name="q<?= $i ?>" value="<?= $j ?>" required> <?= $j ?>
                <?php } ?>

            </div>

            <?php } ?>

            <button type="submit" class="btn btn-primary">Submit</button>

        </form>
    </div>

</body>

</html>