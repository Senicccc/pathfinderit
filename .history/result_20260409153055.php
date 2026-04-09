<?php
session_start();
$results = $_SESSION['results'];
?>

<!DOCTYPE html>
<html>

<head>
    <title>Hasil - PathFinderIT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <h3 class="text-center mb-4">Hasil Rekomendasi</h3>

        <ul class="list-group">
            <?php
        $rank = 1;
        foreach ($results as $key => $value) {
        ?>
            <li class="list-group-item">
                <?= $rank . ". " . $key . " — " . round($value, 3) ?>
            </li>
            <?php
            $rank++;
        }
        ?>
        </ul>
    </div>

</body>

</html>