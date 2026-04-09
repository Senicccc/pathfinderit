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

// analisis nilai
$values = array_values($results);
$uniqueValues = array_unique($values);
$countUnique = count($uniqueValues);

// ================= AI GENERATOR =================
function generateAIText($name, $top, $countUnique) {

    $greetings = $name != "" ? [
        "Halo $name,",
        "Hai $name,",
        "Terima kasih $name,",
        "$name,",
        "Menarik sekali $name,",
        "Selamat $name,"
    ] : [
        "Berdasarkan hasil analisis,",
        "Dari pengolahan data yang dilakukan,",
        "Setelah sistem mengevaluasi jawaban,",
        "Berdasarkan perhitungan yang telah dilakukan,"
    ];

    $analysis = [
        "terdapat pola jawaban yang cukup konsisten dalam preferensi yang diberikan.",
        "terlihat kecenderungan minat yang cukup jelas pada beberapa aspek tertentu.",
        "dapat diidentifikasi adanya dominasi pada kategori tertentu berdasarkan hasil pengisian kuesioner.",
        "terlihat adanya arah preferensi yang cukup kuat dibandingkan alternatif lainnya.",
        "hasil menunjukkan distribusi nilai yang memberikan indikasi terhadap minat utama pengguna.",
        "terdapat kecenderungan yang menggambarkan pola pilihan yang cukup stabil."
    ];

    $fields = [
        "Artificial Intelligence" => [
            "bidang Artificial Intelligence yang berkaitan dengan pengembangan sistem cerdas dan machine learning.",
            "Artificial Intelligence yang berfokus pada teknologi kecerdasan buatan dan sistem adaptif.",
            "Artificial Intelligence yang erat kaitannya dengan algoritma pembelajaran mesin dan otomasi cerdas."
        ],
        "Software Engineering" => [
            "bidang Software Engineering yang berfokus pada pengembangan aplikasi dan sistem perangkat lunak.",
            "Software Engineering yang berkaitan dengan desain sistem dan implementasi aplikasi.",
            "Software Engineering yang menekankan pada coding, debugging, dan pengelolaan sistem."
        ],
        "Data Science" => [
            "bidang Data Science yang berhubungan dengan analisis data dan pengambilan keputusan berbasis data.",
            "Data Science yang mencakup statistik, data mining, dan visualisasi data.",
            "Data Science yang berfokus pada pengolahan data menjadi insight yang berguna."
        ],
        "Computer Network" => [
            "bidang Computer Network yang berkaitan dengan jaringan komputer dan komunikasi data.",
            "Computer Network yang berfokus pada infrastruktur jaringan dan konektivitas sistem.",
            "Computer Network yang mencakup konfigurasi, keamanan, dan pengelolaan jaringan."
        ]
    ];

    $emphasis = [
        "Hal ini menunjukkan adanya kecocokan yang cukup kuat terhadap bidang tersebut.",
        "Ini mengindikasikan bahwa bidang tersebut memiliki relevansi tinggi dengan preferensi kamu.",
        "Dengan demikian, bidang tersebut menjadi pilihan yang paling menonjol dibandingkan lainnya.",
        "Hasil ini memperkuat bahwa bidang tersebut merupakan opsi yang paling sesuai.",
        "Hal ini menjadi indikasi kuat bahwa bidang tersebut patut dipertimbangkan lebih lanjut."
    ];

    $extra = [
        "Minat ini biasanya berkaitan dengan kemampuan analisis, logika, serta ketertarikan terhadap teknologi.",
        "Kecenderungan ini juga sering ditemukan pada individu yang memiliki pola pikir sistematis.",
        "Preferensi ini dapat berkembang lebih jauh melalui eksplorasi dan praktik langsung.",
        "Hal ini juga menunjukkan potensi untuk berkembang di bidang teknologi modern.",
        "Kecenderungan ini dapat menjadi dasar yang baik untuk pengembangan karier ke depan."
    ];

    $closing = [
        "Rekomendasi ini dapat dijadikan sebagai acuan awal dalam menentukan arah pengembangan diri.",
        "Namun demikian, keputusan akhir tetap berada pada eksplorasi dan pengalaman yang kamu jalani.",
        "Hasil ini bersifat sebagai panduan awal yang dapat dikembangkan lebih lanjut.",
        "Kamu tetap memiliki kesempatan untuk mengeksplorasi berbagai bidang lainnya.",
        "Dengan eksplorasi lebih lanjut, kamu dapat menemukan bidang yang paling sesuai."
    ];

    $special = "";
    if ($countUnique == 1) {
        $special = " Menariknya, seluruh bidang memiliki nilai yang sama, yang menunjukkan bahwa kamu memiliki fleksibilitas minat yang sangat luas dan tidak terbatas pada satu bidang tertentu.";
    } elseif ($countUnique == 2) {
        $special = " Selain itu, terdapat beberapa bidang dengan nilai yang setara, yang menunjukkan adanya lebih dari satu minat dominan.";
    } elseif ($countUnique == 3) {
        $special = " Beberapa bidang memiliki nilai yang cukup berdekatan, menunjukkan bahwa minat kamu cukup luas meskipun tetap ada kecenderungan utama.";
    }

    $paragraph = [];

    $paragraph[] = $greetings[array_rand($greetings)];
    $paragraph[] = $analysis[array_rand($analysis)];
    $paragraph[] = "Berdasarkan hasil perhitungan, bidang yang paling menonjol adalah " . $fields[$top][array_rand($fields[$top])];
    $paragraph[] = $emphasis[array_rand($emphasis)];
    $paragraph[] = $extra[array_rand($extra)];
    $paragraph[] = $closing[array_rand($closing)];

    if (rand(0,1)) $paragraph[] = $extra[array_rand($extra)];
    if (rand(0,1)) $paragraph[] = $closing[array_rand($closing)];

    return implode(" ", $paragraph) . $special;
}

$aiText = generateAIText($name, $top, $countUnique);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Hasil - PathFinderIT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
            <span class="navbar-brand fw-bold">PathFinderIT</span>
        </div>
    </nav>

    <div class="container mt-5">

        <h3 class="text-center mb-4">Hasil Rekomendasi</h3>

        <!-- RANKING -->
        <?php $rank=1; foreach ($results as $key=>$value) { ?>
        <div class="card mb-2 <?= $rank==1 ? 'border-success' : '' ?>">
            <div class="card-body">
                <h5><?= $rank==1 ? "🏆 " : "" ?><?= $rank.". ".$key ?></h5>
                <p>Skor: <?= round($value,3) ?></p>
            </div>
        </div>
        <?php $rank++; } ?>

        <!-- CHART -->
        <div class="card mt-4">
            <div class="card-body">
                <h5>Visualisasi Hasil</h5>
                <canvas id="chart"></canvas>
            </div>
        </div>

        <!-- INTERPRETASI -->
        <div class="card mt-4 mb-5">
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

    new Chart(document.getElementById('chart'), {
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