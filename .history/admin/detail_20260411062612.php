<?php
session_start();
include '../config/connection.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];

$query = mysqli_query($conn, "SELECT * FROM results WHERE id='$id'");
$data = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Detail Data - PathFinderIT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="../img/logo-pathfinderit.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>

    <div class="admin-page-wrapper"></div>
    <div class="admin-page-overlay"></div>

    <div class="admin-page-content">
    
        <?php include '../components/navbar-admin.php'; ?>
        
        <div class="admin-page-main">
            <div class="container">
                <h1 class="admin-page-title">Detail Hasil Tes #<?= htmlspecialchars($id) ?></h1>

                <div class="admin-detail-card">
                    <div class="row mb-4">
                        <div class="col-md-8">
                            <h4 style="color: #1a0d0d; font-weight: 700; margin-bottom: 1rem;">Data Peserta</h4>
                            <div style="background: #f9f9f9; padding: 1.5rem; border-radius: 8px; margin-bottom: 2rem;">
                                <p style="margin: 0.5rem 0; color: #333;"><strong>Nama Peserta:</strong> <?= htmlspecialchars($data['name'] ?: 'Tidak diisi') ?></p>
                                <p style="margin: 0.5rem 0; color: #333;"><strong>Tanggal Tes:</strong> <?= date("d/m/Y H:i", strtotime($data['created_at'])) ?></p>
                                <p style="margin: 0.5rem 0; color: #333;"><strong>ID Data:</strong> #<?= htmlspecialchars($id) ?></p>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <h4 style="color: #1a0d0d; font-weight: 700; margin-bottom: 1rem;">Skor Hasil Tes</h4>
                            <div style="background: linear-gradient(135deg, rgba(255, 107, 107, 0.1), rgba(107, 31, 31, 0.1)); padding: 1.5rem; border-radius: 8px; border-left: 4px solid #ff6b6b;">
                                <table style="width: 100%; font-size: 0.95rem;">
                                    <tr>
                                        <td style="padding: 0.5rem 0; color: #333;"><strong>AI</strong></td>
                                        <td style="padding: 0.5rem 0; text-align: right; color: #ff6b6b; font-weight: 700;"><?= round($data['ai_score'], 4) ?></td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 0.5rem 0; color: #333;"><strong>SE</strong></td>
                                        <td style="padding: 0.5rem 0; text-align: right; color: #ff6b6b; font-weight: 700;"><?= round($data['se_score'], 4) ?></td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 0.5rem 0; color: #333;"><strong>DS</strong></td>
                                        <td style="padding: 0.5rem 0; text-align: right; color: #ff6b6b; font-weight: 700;"><?= round($data['ds_score'], 4) ?></td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 0.5rem 0; color: #333;"><strong>CN</strong></td>
                                        <td style="padding: 0.5rem 0; text-align: right; color: #ff6b6b; font-weight: 700;"><?= round($data['cn_score'], 4) ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Questions & Answers -->
                    <h4 style="color: #1a0d0d; font-weight: 700; margin-bottom: 1.5rem; margin-top: 2rem; padding-top: 2rem; border-top: 2px solid #e8e8e8;">Detail Jawaban Pertanyaan</h4>
                    
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width: 10%;">No</th>
                                <th style="width: 90%;">Jawaban</th>
                            </tr>
                        </thead>
                        <tbody>
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
                                
                                for ($i=1;$i<=12;$i++) { 
                                    $answer = $data["q$i"];
                                    $labels = ["1 - Sangat Tidak Setuju", "2 - Tidak Setuju", "3 - Netral", "4 - Setuju", "5 - Sangat Setuju"];
                            ?>
                            <tr>
                                <td style="font-weight: 600; color: #1a0d0d;">Q<?= $i ?></td>
                                <td>
                                    <div style="font-size: 0.95rem; color: #333;">
                                        <strong><?= $questions[$i-1] ?></strong><br>
                                        <span style="color: #ff6b6b; font-weight: 600; margin-top: 0.3rem; display: inline-block;">
                                            ✓ <?= isset($labels[$answer-1]) ? $labels[$answer-1] : 'Tidak menjawab' ?>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <a href="index.php" class="admin-btn-back">
                    ← Kembali ke Dashboard
                </a>
            </div>

        </div>

        <!-- CREDIT FREEPIK -->
        <div class="credit">
            <a href="http://www.freepik.com">Designed by starline / Freepik</a>
        </div>
    </div>

    <!-- BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>