<?php
session_start();

if (!isset($_SESSION['results'])) {
    header("Location: questionnaire.php");
    exit;
}

$results = $_SESSION['results'];
$name = isset($_SESSION['name']) ? $_SESSION['name'] : "";

$values = array_values($results);
$uniqueValues = array_unique($values);
$countUnique = count($uniqueValues);

function generateAnalysisText($name, $results, $countUnique) {
    global $results;
    // Generate text analysis dengan random variations
    
    $ranking = array_keys($results);
    $rankingValues = array_values($results);
    $topScore = $rankingValues[0];
    $secondScore = isset($rankingValues[1]) ? $rankingValues[1] : 0;
    $scoreDifference = count($rankingValues) > 1 ? $topScore - $secondScore : 0;
    // Cek kalau gap-nya besar (strong lead) atau kecil (minat merata)
    $isStrongLead = $scoreDifference > 0.15;
    $isVeryClose = $scoreDifference < 0.05 && count($rankingValues) > 1;
    
    // 4 domain × 4 rank × 5 variations = biar gak repetitif
    $fieldInsights = [
        "Artificial Intelligence" => [
            1 => [
                "Passion untuk Artificial Intelligence menunjukkan potensi luar biasa dalam mengembangkan sistem cerdas, machine learning, dan automasi yang transformatif.",
                "Ketertarikan tinggi pada Artificial Intelligence mengindikasikan kemampuan analitis dan logical thinking yang kuat, ideal untuk AI/ML engineering dan research.",
                "Minat utama pada Artificial Intelligence mencerminkan visi forward-thinking dalam mengadopsi teknologi cutting-edge seperti deep learning dan neural networks.",
                "Preferensi kuat untuk Artificial Intelligence menunjukkan potensi untuk menjadi architect dalam solusi AI-driven yang memberikan business value signifikan.",
                "Fokus pada Artificial Intelligence mengidentifikasi keahlian dalam problem-solving kompleks menggunakan algoritma pembelajaran mesin dan system intelligence."
            ],
            2 => [
                "Minat sekunder pada Artificial Intelligence menunjukkan komplementaritas skill yang dapat meningkatkan value proposition di bidang utama kamu.",
                "Artificial Intelligence sebagai opsi kedua mengindikasikan potential untuk cross-functional expertise dalam integration AI solutions.",
                "Porsi signifikan pada Artificial Intelligence menunjukkan awareness terhadap importance AI dalam transformasi digital modern.",
                "Secondary interest di Artificial Intelligence membuka peluang untuk specialization dalam strategic AI implementation dan digital transformation.",
                "Ketertarikan pada AI di urutan kedua menunjukkan balanced profile dengan capability untuk bridge technical AI dengan business requirements."
            ],
            3 => [
                "Minat moderat pada Artificial Intelligence mengindikasikan foundational understanding yang dapat diperdalam melalui continuous learning.",
                "Artificial Intelligence di posisi ketiga menunjukkan awareness terhadap AI landscape tanpa deep specialization focus.",
                "Tertiary interest pada AI mencerminkan open mindset untuk eksplorasi teknologi emerging dalam trajectory karir kamu.",
                "Ketertarikan terukur pada Artificial Intelligence membuka opsi untuk future pivot ke AI domain dengan investment pembelajaran yang reasonable.",
                "Moderate engagement dengan AI menunjukkan potential untuk adjacent roles yang memerlukan AI literacy tanpa menjadi core expertise."
            ],
            4 => [
                "Interest minimal pada Artificial Intelligence mengindikasikan bahwa prioritas kamu terletak pada domain lain yang lebih resonan dengan passion internal.",
                "Artificial Intelligence di ranking terakhir menunjukkan preference untuk teknologi yang lebih operational daripada research-oriented.",
                "Posisi keempat untuk AI mencerminkan natural inclination terhadap practical implementation daripada theoretical innovation.",
                "Rendahnya interest pada Artificial Intelligence menunjukkan bahwa value kamu lebih optimal di domain yang lebih aligned dengan strengths kamu.",
                "Minimal focus pada AI mengindikasikan bahwa specialized AI knowledge bukan critical differentiator untuk karir path optimal kamu."
            ]
        ],
        "Software Engineering" => [
            1 => [
                "Passion untuk Software Engineering menunjukkan strong builder mentality dan kemampuan untuk mengkonversi ide menjadi aplikasi yang scalable dan impactful.",
                "Ketertarikan tinggi pada Software Engineering mengindikasikan excellent problem-solving capability dan attention to detail dalam code quality dan system design.",
                "Minat utama pada Software Engineering mencerminkan competence dalam full-stack development, architecture thinking, dan software craftsmanship.",
                "Preferensi kuat untuk Software Engineering menunjukkan potential untuk engineering leadership dan mentoring dalam engineering excellence.",
                "Fokus pada Software Engineering mengidentifikasi capability untuk deliver robust, maintainable solutions yang scale dengan business growth."
            ],
            2 => [
                "Minat sekunder pada Software Engineering menunjukkan strong fundamentals yang dapat enhance overall technical capability dan project delivery.",
                "Software Engineering sebagai opsi kedua mengindikasikan balanced approach antara technical depth dan broader strategic thinking.",
                "Porsi signifikan pada Software Engineering menunjukkan commitment terhadap engineering excellence sebagai supporting pillar.",
                "Secondary interest di Software Engineering membuka peluang untuk technical contributions dan engineering-focused impact dalam career path.",
                "Ketertarikan pada SE di urutan kedua menunjukkan capability untuk terjembatani gap antara technical teams dan business stakeholders effectively."
            ],
            3 => [
                "Minat moderat pada Software Engineering mengindikasikan kompetensi functional dalam coding dan development practices.",
                "Software Engineering di posisi ketiga menunjukkan foundational technical knowledge yang dapat diaplikasikan dalam berbagai konteks.",
                "Tertiary interest pada SE mencerminkan practical approach terhadap technology implementation tanpa seeking specialization depth.",
                "Ketertarikan terukur pada Software Engineering membuka opsi untuk technical contributor roles dengan room untuk growth selective.",
                "Moderate engagement dengan SE menunjukkan potential untuk technical roles dengan flexibility untuk eksplorasi domain lain."
            ],
            4 => [
                "Interest minimal pada Software Engineering mengindikasikan bahwa priority kamu lebih pada strategic atau operational aspects.",
                "Software Engineering di ranking terakhir menunjukkan preference untuk higher-level concerns daripada detailed implementation work.",
                "Posisi keempat untuk SE mencerminkan natural inclination terhadap meta-level problems daripada coding aspects.",
                "Rendahnya interest pada Software Engineering menunjukkan bahwa true value proposition kamu terletak di non-engineering domains.",
                "Minimal focus pada SE mengindikasikan bahwa optimal career trajectory melibatkan supporting roles atau domains lain yang lebih aligned."
            ]
        ],
        "Data Science" => [
            1 => [
                "Passion untuk Data Science menunjukkan exceptional analytical capability dan ability untuk extract actionable insights dari complex datasets.",
                "Ketertarikan tinggi pada Data Science mengindikasikan strength dalam statistical thinking, pattern recognition, dan data-driven decision making.",
                "Minat utama pada Data Science mencerminkan capability untuk transforming raw data menjadi strategic assets yang drive business value.",
                "Preferensi kuat untuk Data Science menunjukkan potential untuk analytics leadership dan setting data-driven organizational culture.",
                "Fokus pada Data Science mengidentifikasi competence dalam advanced analytics, predictive modeling, dan business intelligence architecture."
            ],
            2 => [
                "Minat sekunder pada Data Science menunjukkan analytical thinking yang valuable untuk complementing technical atau business domains.",
                "Data Science sebagai opsi kedua mengindikasikan capability untuk leverage data insights dalam business strategy formulation.",
                "Porsi signifikan pada Data Science menunjukkan interest pada evidence-based decision making dan quantitative analysis.",
                "Secondary interest di Data Science membuka peluang untuk analytics-driven roles dengan impact pada business outcomes.",
                "Ketertarikan pada DS di urutan kedua menunjukkan capability untuk interpret data insights dan translate ke business-relevant recommendations."
            ],
            3 => [
                "Minat moderat pada Data Science mengindikasikan foundational statistical literacy dan appreciation untuk data-driven approaches.",
                "Data Science di posisi ketiga menunjukkan awareness terhadap importance analytics dalam modern business landscape.",
                "Tertiary interest pada DS mencerminkan openness terhadap data-informed methods within broader domain focus.",
                "Ketertarikan terukur pada Data Science membuka opsi untuk analytics exposure dalam operational roles.",
                "Moderate engagement dengan DS menunjukkan potential untuk data literacy yang mendukung adjacent technical atau business functions."
            ],
            4 => [
                "Interest minimal pada Data Science mengindikasikan bahwa approach kamu lebih qualitative atau operational daripada quantitative analytical.",
                "Data Science di ranking terakhir menunjukkan preference untuk intuitive decision making atau other knowledge discovery methods.",
                "Posisi keempat untuk DS mencerminkan natural inclination yang tidak heavily analytics-oriented dalam problem solving.",
                "Rendahnya interest pada Data Science menunjukkan bahwa strength kamu terletak di domain yang tidak require deep statistical expertise.",
                "Minimal focus pada DS mengindikasikan bahwa career optimization tidak memerlukan specialization dalam advanced analytics."
            ]
        ],
        "Computer Network" => [
            1 => [
                "Passion untuk Computer Network menunjukkan exceptional infrastructure thinking dan ability untuk desain, implement, dan optimize complex network systems.",
                "Ketertarikan tinggi pada Computer Network mengindikasikan strength dalam system administration, network security, dan infrastructure reliability.",
                "Minat utama pada Computer Network mencerminkan capability untuk building robust connectivity solutions yang enable business operations.",
                "Preferensi kuat untuk Computer Network menunjukkan potential untuk infrastructure leadership dan ensuring enterprise-grade system reliability.",
                "Fokus pada Computer Network mengidentifikasi competence dalam network architecture, cybersecurity, dan disaster recovery planning."
            ],
            2 => [
                "Minat sekunder pada Computer Network menunjukkan valuable infrastructure knowledge yang complement technical atau operational expertise.",
                "Computer Network sebagai opsi kedua mengindikasikan understanding terhadap network-level considerations dalam system design.",
                "Porsi signifikan pada Computer Network menunjukkan IT infrastructure mindset yang penting untuk enterprise solutions.",
                "Secondary interest di Computer Network membuka peluang untuk infrastructure-aware roles dengan system reliability focus.",
                "Ketertarikan pada CN di urutan kedua menunjukkan capability untuk bridge application layer dengan infrastructure requirements effectively."
            ],
            3 => [
                "Minat moderat pada Computer Network mengindikasikan foundational networking knowledge yang adequate untuk general IT competency.",
                "Computer Network di posisi ketiga menunjukkan awareness terhadap networking essentials tanpa deep specialism.",
                "Tertiary interest pada CN mencerminkan practical approach terhadap infrastructure requirements dalam technology stack.",
                "Ketertarikan terukur pada Computer Network membuka opsi untuk infrastructure roles dengan supporting technical capabilities.",
                "Moderate engagement dengan CN menunjukkan potential untuk network literacy yang mendukung broader IT responsibilities."
            ],
            4 => [
                "Interest minimal pada Computer Network mengindikasikan bahwa focus kamu lebih pada application atau user-facing aspects daripada infrastructure.",
                "Computer Network di ranking terakhir menunjukkan preference untuk higher-level abstraction daripada networking implementation details.",
                "Posisi keempat untuk CN mencerminkan natural inclination terhadap software atau business concerns dibanding network architecture.",
                "Rendahnya interest pada Computer Network menunjukkan bahwa strategic value kamu tidak terletak pada infrastructure specialization.",
                "Minimal focus pada CN mengindikasikan bahwa optimal career path tidak memerlukan deep networking expertise atau specialization."
            ]
        ]
    ];
    
    $openings = [
        "Analisis komprehensif terhadap profil kamu menunjukkan pola preferensi yang jelas dan konsisten.",
        "Data yang kamu berikan mengungkapkan strength areas yang significant dan opportunities untuk career development.",
        "Evaluasi mendalam terhadap jawaban kamu mengidentifikasi unique combination of interests dan natural inclinations.",
        "Hasil analisis menunjukkan strong alignment antara capability assessment dan career preference clustering.",
        "Profiling yang kami lakukan mengungkapkan distinct talent profile dengan clear differentiation among domains.",
        "Insight dari assessment kamu menunjukkan coherent narrative tentang professional interests dan technical passions."
    ];
    
    $contextInsights = [];
    
    if ($isStrongLead) {
        $contextInsights[] = "Margin yang signifikan antara preferensi utama dan secondary mengindikasikan clear vocational focus yang robust.";
        $contextInsights[] = "Strong differentiation dalam ranking menunjukkan specialized interest profile yang memberikan clear direction untuk specialization.";
    } else if ($isVeryClose) {
        $contextInsights[] = "Proximity yang erat antar bidang mengindikasikan multidimensional capability dan potential untuk cross-functional contributions.";
        $contextInsights[] = "Keseimbangan dalam scoring menunjukkan versatile professional profile dengan strength di multiple domains.";
    }
    
    $closings = [
        "Trajectory karir optimal kamu dapat dibangun dengan memfokuskan development effort pada area preferensi utama sambil maintaining flexibility untuk skill adjacent.",
        "Strategic approach adalah mengledak di domain primary sambil building support competencies di secondary areas untuk holistic professional growth.",
        "Recommendation adalah pursue specialization dalam ranked preference dengan gradual expansion ke complementary areas sesuai career opportunities.",
        "Best practice untuk maximizing career potential adalah focused depth di core passion dengan breadth di supporting domains untuk organisational flexibility.",
        "Innovation roadmap kamu dapat dioptimasi dengan deep expertise di primary domain combined dengan emerging skills di adjacent areas."
    ];
    
    // Build text dari parts2 random
    $parts = [];
    
    $greeting = $name != "" ? "Halo " . htmlspecialchars($name) . "," : "Berdasarkan comprehensive assessment,";
    $parts[] = $greeting . " " . $openings[array_rand($openings)];
    
    $parts[] = $fieldInsights[$ranking[0]][1][array_rand($fieldInsights[$ranking[0]][1])];
    
    if (count($ranking) > 1) {
        $parts[] = "Komplemen yang valuable hadir dari " . lcfirst($fieldInsights[$ranking[1]][2][array_rand($fieldInsights[$ranking[1]][2])]);
    }
    
    if (!empty($contextInsights)) {
        $parts[] = $contextInsights[array_rand($contextInsights)];
    }
    
    if ($countUnique == 1) {
        $parts[] = "Menariknya, keempat domain menunjukkan nilai yang setara, yang mencerminkan rare multidomain capability—fleksibilitas ekstrem dan adaptability tinggi yang valuable dalam dynamic technology landscape modern.";
    } elseif ($countUnique == 2) {
        $parts[] = "Beberapa domain menunjukkan scoring yang equivalen, mengindikasikan dual-priority expertise yang memberikan strategic advantage dalam complex projects memerlukan cross-domain knowledge.";
    } elseif ($countUnique == 3) {
        $parts[] = "Terlihat clustering value dengan beberapa domain memiliki assessment score sangat berdekatan, menunjukkan broad technical base dengan clear primary specialization.";
    }
    
    $parts[] = $closings[array_rand($closings)];
    
    return implode(" ", $parts);
}

$analysisText = generateAnalysisText($name, $results, $countUnique);
?>
<?php include 'components/navbar.php'; ?>

<!DOCTYPE html>
<html>

<head>
    <title>Hasil - PathFinderIT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="img/logo-pathfinderit.png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
    body {
        background: linear-gradient(135deg, #f8f5f5 0%, #f2eded 100%);
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    .navbar {
        background: linear-gradient(135deg, #6B1F1F, #8b2f2f);
        box-shadow: 0 4px 15px rgba(107, 31, 31, 0.2);
    }

    .content-wrapper {
        flex: 1;
    }
    </style>
</head>

<body>

    <div class="content-wrapper">

        <div class="result-container">
            <div class="container">

                <div class="result-card">
                    <h3>Hasil Analisis Minat Informatika</h3>
                    <?php if ($name != ""): ?>
                    <p style="color: #ff6b6b; font-weight: 600; margin-bottom: 1rem; font-size: 1.1rem;">
                        Selamat, <?= htmlspecialchars($name) ?>!
                    </p>
                    <?php endif; ?>
                    <p style="color: #666; margin-bottom: 0;">
                        Berikut adalah ranking bidang minat Anda berdasarkan analisis menggunakan metode SMART:
                    </p>
                </div>

                <div class="result-card">
                    <h3>Ranking Bidang Minat</h3>
                    <?php $rank=1; foreach ($results as $key=>$value) { ?>
                    <div class="ranking-item">
                        <h5><?= $rank==1 ? "(1) " : "(" . $rank . ") " ?><?= $key ?></h5>
                        <p>Skor: <?= round($value,3) ?></p>
                    </div>
                    <?php $rank++; } ?>
                </div>

                <div class="result-card">
                    <h3>Visualisasi Hasil</h3>
                    <div style="position: relative; height: 300px; margin-bottom: 1rem;">
                        <canvas id="chart"></canvas>
                    </div>
                </div>

                <div class="result-card">
                    <h3>Analisis dan Rekomendasi</h3>
                    <p style="color: #555; line-height: 1.8;"><?= $analysisText ?></p>
                </div>

                <div class="result-card"
                    style="background: linear-gradient(135deg, rgba(107, 31, 31, 0.05), rgba(255, 107, 107, 0.05)); border-left: 4px solid #ff6b6b;">
                    <h3 style="color: #6b1f1f; font-size: 1.1rem;">⚠️ Disclaimer Penting</h3>
                    <p style="color: #555; line-height: 1.8; margin-bottom: 0; font-size: 0.95rem;">
                        Hasil analisis ini adalah <strong>rekomendasi berbasis data</strong> dari sistem SMART yang
                        dirancang untuk memberikan panduan awal dalam memilih bidang minat.
                        Hasil ini <strong>bukan keputusan final</strong> dan tidak mengikat. Setiap individu memiliki
                        potensi untuk berkembang di berbagai bidang sesuai dengan:
                    </p>
                    <ul style="color: #555; line-height: 1.8; margin-top: 1rem; margin-bottom: 0;">
                        <li><strong>Pengalaman praktis</strong> dan eksplorasi langsung di lapangan</li>
                        <li><strong>Pengembangan skill</strong> berkelanjutan melalui pembelajaran dan pelatihan</li>
                        <li><strong>Passion dan motivasi pribadi</strong> yang terus berkembang seiring waktu</li>
                        <li><strong>Mentorship dan guidance</strong> dari praktisi berpengalaman di bidang tersebut</li>
                    </ul>
                    <p style="color: #555; margin-top: 1rem; margin-bottom: 0; font-size: 0.95rem;">
                        Gunakan hasil ini sebagai <strong>panduan awal</strong> untuk penelusuran lebih lanjut, bukan
                        sebagai penentuan karir yang definitif.
                        Keputusan final tetap ada di tangan Anda berdasarkan eksplorasi, pengalaman, dan pertimbangan
                        pribadi yang mendalam.
                    </p>
                </div>

            </div>
        </div>

        <?php include 'components/footer.php'; ?>

        <script>
        const ctx = document.getElementById('chart').getContext('2d');
        const data = {
            labels: <?= json_encode(array_keys($results)) ?>,
            datasets: [{
                label: 'Skor Minat',
                data: <?= json_encode(array_values($results)) ?>,
                backgroundColor: [
                    'rgba(255, 107, 107, 0.8)',
                    'rgba(255, 174, 174, 0.8)',
                    'rgba(255, 206, 206, 0.8)',
                    'rgba(255, 225, 225, 0.8)'
                ],
                borderColor: [
                    'rgba(255, 107, 107, 1)',
                    'rgba(255, 174, 174, 1)',
                    'rgba(255, 206, 206, 1)',
                    'rgba(255, 225, 225, 1)'
                ],
                borderWidth: 2,
                borderRadius: 8,
                hoverBackgroundColor: 'rgba(255, 82, 82, 1)',
                hoverBorderColor: 'rgba(255, 82, 82, 1)',
                hoverBorderWidth: 3
            }]
        };

        const chart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom',
                        labels: {
                            font: {
                                size: 12,
                                weight: '600'
                            },
                            color: '#333',
                            padding: 15,
                            generateLabels: function() {
                                return [];
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        padding: 12,
                        titleFont: {
                            size: 13,
                            weight: 'bold'
                        },
                        bodyFont: {
                            size: 12
                        },
                        borderColor: '#ff6b6b',
                        borderWidth: 1,
                        displayColors: true,
                        callbacks: {
                            label: function(context) {
                                return 'Skor: ' + context.parsed.y.toFixed(3);
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 1,
                        ticks: {
                            color: '#666',
                            font: {
                                size: 11,
                                weight: '500'
                            },
                            stepSize: 0.25
                        },
                        grid: {
                            color: 'rgba(200, 200, 200, 0.1)',
                            drawBorder: false
                        }
                    },
                    x: {
                        ticks: {
                            color: '#333',
                            font: {
                                size: 11,
                                weight: '600'
                            }
                        },
                        grid: {
                            display: false,
                            drawBorder: false
                        }
                    }
                }
            }
        });
        </script>

        <!-- BOOTSTRAP JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>