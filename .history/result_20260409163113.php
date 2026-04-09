<?php
session_start();

if (!isset($_SESSION['results'])) {
    header("Location: questionnaire.php");
    exit;
}

$results = $_SESSION['results'];
$name = isset($_SESSION['name']) ? $_SESSION['name'] : "";

// ambil top
$top = array_key_first($results);

// hitung kondisi nilai
$values = array_values($results);
$uniqueValues = array_unique($values);
$countUnique = count($uniqueValues);

// ================= AI STYLE GENERATOR =================
function generateAIText($name, $top, $countUnique) {

    $openings = $name != "" ? [
        "Halo $name, setelah sistem menganalisis jawaban yang kamu berikan secara menyeluruh,",
        "$name, berdasarkan hasil evaluasi yang dilakukan terhadap preferensi kamu,",
        "Terima kasih $name, dari proses analisis yang telah dilakukan,",
    ] : [
        "Berdasarkan hasil analisis sistem,",
        "Dari pengolahan data yang telah dilakukan,",
        "Setelah dilakukan evaluasi terhadap seluruh jawaban,",
    ];

    $insights = [
        "terlihat adanya pola kecenderungan yang cukup konsisten dalam pilihan yang kamu berikan.",
        "terdapat indikasi preferensi yang cukup kuat pada beberapa aspek tertentu.",
        "dapat diidentifikasi kecenderungan minat yang mengarah pada bidang tertentu.",
    ];

    $fields = [
        "Artificial Intelligence" => "Artificial Intelligence, yang berkaitan erat dengan pengembangan sistem cerdas, machine learning, serta teknologi berbasis kecerdasan buatan.",
        "Software Engineering" => "Software Engineering, yang berfokus pada pengembangan perangkat lunak, desain sistem, serta implementasi aplikasi secara terstruktur.",
        "Data Science" => "Data Science, yang berhubungan dengan analisis data, pengolahan informasi, serta pengambilan keputusan berbasis data.",
        "Computer Network" => "Computer Network, yang mencakup jaringan komputer, komunikasi data, serta pengelolaan infrastruktur sistem."
    ];

    $closing = [
        "Hal ini menunjukkan bahwa bidang tersebut dapat menjadi salah satu pilihan utama yang layak untuk dipertimbangkan lebih lanjut.",
        "Dengan demikian, bidang ini dapat dijadikan sebagai arah pengembangan yang potensial ke depannya.",
        "Oleh karena itu, bidang ini dapat menjadi fokus utama dalam pengembangan kemampuan kamu."
    ];

    $special = "";
    if ($countUnique == 1) {
        $special = " Menariknya, seluruh bidang memiliki nilai yang sama, yang berarti kamu memiliki fleksibilitas minat yang sangat luas dan tidak terbatas pada satu bidang tertentu.";
    } elseif ($countUnique == 2) {
        $special = " Selain itu, terdapat beberapa bidang dengan nilai yang setara, yang menunjukkan adanya lebih dari satu minat dominan.";
    } elseif ($countUnique == 3) {
        $special = " Beberapa bidang memiliki nilai yang cukup berdekatan, menunjukkan bahwa minat kamu cukup luas meskipun tetap ada kecenderungan utama.";
    }

    return 
        $openings[array_rand($openings)] . " " .
        $insights[array_rand($insights)] . " " .
        "Berdasarkan hasil perhitungan, bidang yang paling menonjol adalah " .
        $fields[$top] . " " .
        $closing[array_rand($closing)] .
        $special .
        " Rekomendasi ini bersifat sebagai panduan awal dan dapat dikembangkan lebih lanjut sesuai dengan pengalaman dan eksplorasi yang kamu lakukan di masa mendatang.";
}
$aiText = generateAIText($name, $top, $countUnique);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Hasil - PathFinderIT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
    body {
        background: #F8F5F5;
    }

    .navbar {
        background: #6B1F1F;
    }
    </style>
</head>

<body>

    <nav class="navbar navbar-dark">
        <div class="container">
            <span class="navbar-brand">PathFinderIT</span>
        </div>
    </nav>

    <div class="container mt-5">

        <h3 class="text-center mb-4">Hasil Rekomendasi</h3>

        <!-- RANKING -->
        <?php
    $rank = 1;
    foreach ($results as $key => $value) {
    ?>
        <div class="card mb-2 <?= $rank == 1 ? 'border-success' : '' ?>">
            <div class="card-body">
                <h5><?= $rank == 1 ? "🏆 " : "" ?><?= $rank . ". " . $key ?></h5>
                <p>Skor: <?= round($value, 3) ?></p>
            </div>
        </div>
        <?php $rank++; } ?>

        <!-- CHART -->
        <div class="card mt-4">
            <div class="card-body">
                <h5>Visualisasi Hasil</h5>
                <canvas id="resultChart"></canvas>
            </div>
        </div>

        <!-- AI INTERPRETASI -->
        <div class="card mt-4">
            <div class="card-body">
                <h5>Interpretasi Sistem</h5>
                <p><?= $aiText ?></p>
            </div>
        </div>

    </div>

    <script>
    const data = {
        labels: <?= json_encode(array_keys($results)) ?>,
        datasets: [{
            label: 'Skor',
            data: <?= json_encode(array_values($results)) ?>
        }]
    };

    new Chart(document.getElementById('resultChart'), {
        type: 'bar',
        data: data,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
    </script>

</body>

</html>