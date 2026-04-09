<?php
session_start();

if (!isset($_SESSION['results'])) {
    header("Location: questionnaire.php");
    exit;
}

$results = $_SESSION['results'];
$name = isset($_SESSION['name']) ? $_SESSION['name'] : "";

// ambil ranking pertama
$top = array_key_first($results);

// ambil nilai
$values = array_values($results);
$uniqueValues = array_unique($values);
$countUnique = count($uniqueValues);

// fungsi sapaan
function getGreeting($name) {
    if ($name != "") {
        $greetings = [
            "Halo $name, dari hasil yang kamu berikan, terlihat bahwa",
            "Menarik sekali $name, berdasarkan jawaban kamu, sistem melihat bahwa",
            "$name, setelah dianalisis lebih lanjut, hasil menunjukkan bahwa",
            "Terima kasih $name, dari data yang kamu isi, dapat disimpulkan bahwa"
        ];
    } else {
        $greetings = [
            "Berdasarkan hasil kuesioner yang telah diisi, terlihat bahwa",
            "Dari analisis yang dilakukan sistem, dapat disimpulkan bahwa",
            "Hasil pengolahan data menunjukkan bahwa",
            "Berdasarkan preferensi yang diberikan, sistem merekomendasikan bahwa"
        ];
    }

    return $greetings[array_rand($greetings)];
}

// narasi utama
function getRecommendationText($top) {

    $texts = [

        "Artificial Intelligence" => [
            "bidang Artificial Intelligence menjadi pilihan yang paling menonjol. Hal ini menunjukkan ketertarikan yang kuat terhadap pengembangan sistem cerdas, machine learning, serta teknologi yang mampu meniru cara berpikir manusia. Minat ini biasanya sejalan dengan kemampuan analitis yang baik serta rasa ingin tahu yang tinggi terhadap perkembangan teknologi masa depan.",
            
            "Artificial Intelligence muncul sebagai bidang dengan skor tertinggi. Ini mengindikasikan bahwa kamu memiliki kecenderungan untuk tertarik pada pengolahan data kompleks, algoritma pembelajaran mesin, serta pengembangan sistem yang adaptif dan inovatif. Bidang ini sangat relevan dengan perkembangan industri saat ini.",
        ],

        "Software Engineering" => [
            "Software Engineering menjadi bidang yang paling sesuai. Hal ini menunjukkan bahwa kamu memiliki ketertarikan dalam membangun aplikasi, memahami struktur sistem, serta mengembangkan solusi perangkat lunak yang efisien dan terstruktur.",
            
            "hasil menunjukkan kecenderungan kuat pada Software Engineering. Ini berarti kamu cenderung menikmati proses coding, debugging, serta pengembangan sistem yang kompleks namun terorganisir dengan baik."
        ],

        "Data Science" => [
            "Data Science menjadi pilihan utama berdasarkan hasil perhitungan. Hal ini menunjukkan bahwa kamu memiliki minat dalam menganalisis data, menemukan pola, serta menghasilkan insight yang berguna untuk pengambilan keputusan.",
            
            "hasil menunjukkan kecocokan yang tinggi pada bidang Data Science. Ini berarti kamu tertarik pada pengolahan data, statistik, serta visualisasi informasi untuk memahami fenomena yang terjadi."
        ],

        "Computer Network" => [
            "Computer Network menjadi bidang yang paling sesuai. Hal ini menunjukkan bahwa kamu memiliki ketertarikan pada infrastruktur jaringan, komunikasi data, serta bagaimana sistem terhubung satu sama lain.",
            
            "hasil menunjukkan kecenderungan pada bidang Computer Network. Ini berarti kamu tertarik dalam memahami konektivitas, keamanan jaringan, serta pengelolaan sistem berbasis jaringan."
        ]
    ];

    return $texts[$top][array_rand($texts[$top])];
}

// kondisi khusus (nilai sama)
function getSpecialCaseText($countUnique) {

    if ($countUnique == 1) {
        return "Menariknya, semua bidang memiliki nilai yang sama. Ini menunjukkan bahwa minat kamu tersebar secara merata di berbagai bidang Informatika. Kamu memiliki fleksibilitas yang tinggi dan berpotensi untuk berkembang di berbagai jalur karier tanpa kecenderungan yang terlalu dominan pada satu bidang tertentu.";
    }

    if ($countUnique == 2) {
        return "Terdapat beberapa bidang yang memiliki nilai yang sama atau sangat berdekatan. Hal ini menunjukkan bahwa kamu memiliki lebih dari satu minat yang cukup kuat, sehingga kamu bisa mempertimbangkan lebih dari satu jalur spesialisasi.";
    }

    if ($countUnique == 3) {
        return "Sebagian besar bidang memiliki nilai yang mirip, dengan satu bidang yang sedikit lebih unggul. Ini menunjukkan bahwa kamu memiliki minat yang cukup luas namun tetap ada kecenderungan tertentu yang lebih dominan.";
    }

    return "";
}

$greeting = getGreeting($name);
$mainText = getRecommendationText($top);
$specialText = getSpecialCaseText($countUnique);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Hasil - PathFinderIT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

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
        <?php
        $rank++;
    }
    ?>

        <!-- INTERPRETASI -->
        <div class="card mt-4">
            <div class="card-body">

                <h5>Interpretasi Hasil</h5>

                <p>
                    <?= $greeting ?> <?= $mainText ?>
                </p>

                <?php if ($specialText != "") { ?>
                <p>
                    <?= $specialText ?>
                </p>
                <?php } ?>

                <p>
                    Rekomendasi ini tidak bersifat mutlak, namun dapat dijadikan sebagai acuan awal dalam menentukan
                    bidang minat yang paling sesuai. Kamu tetap dapat mengeksplorasi berbagai bidang lainnya untuk
                    menemukan kecocokan yang paling tepat sesuai dengan perkembangan minat dan kemampuan kamu di masa
                    depan.
                </p>

            </div>
        </div>

    </div>

</body>

</html>