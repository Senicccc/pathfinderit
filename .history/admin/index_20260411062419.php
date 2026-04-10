<?php
session_start();
include '../config/connection.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

// ambil keyword
$keyword = isset($_GET['search']) ? $_GET['search'] : '';

// query dinamis
if ($keyword != '') {
    if (is_numeric($keyword)) {
        $query = mysqli_query($conn, "SELECT * FROM results WHERE id = '$keyword'");
    } else {
        $query = mysqli_query($conn, "SELECT * FROM results WHERE name LIKE '%$keyword%'");
    }
} else {
    $query = mysqli_query($conn, "SELECT * FROM results ORDER BY id DESC");
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Dashboard Admin - PathFinderIT</title>
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
                <!-- Page Title -->
                <h1 class="admin-page-title">Dashboard Admin</h1>

                <!-- Search & Filter Section -->
                <form method="GET" class="admin-search-section">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-6">
                            <input type="text" name="search" value="<?= $keyword ?>"
                                placeholder="Cari berdasarkan ID atau Nama..." class="form-control">
                        </div>
                        <div class="col-md-6 d-flex gap-2">
                            <button type="submit" class="admin-btn-search flex-grow-1">
                                Cari Data
                            </button>
                            <a href="index.php" class="admin-btn-reset">
                                Reset
                            </a>
                        </div>
                    </div>
                </form>

                <!-- Export Button -->
                <div class="mb-4">
                    <a href="export.php?search=<?= $keyword ?>" class="admin-btn-export">
                        Export ke Excel
                    </a>
                </div>

                <!-- Data Table -->
                <div class="admin-table-card">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Peserta</th>
                                    <th>AI</th>
                                    <th>SE</th>
                                    <th>DS</th>
                                    <th>CN</th>
                                    <th>Tanggal Tes</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php 
                                if (mysqli_num_rows($query) > 0) {
                                    while($row = mysqli_fetch_assoc($query)) { 
                            ?>
                                <tr>
                                    <td>#<?= $row['id'] ?></td>
                                    <td><?= htmlspecialchars($row['name']) ?></td>
                                    <td><?= round($row['ai_score'],3) ?></td>
                                    <td><?= round($row['se_score'],3) ?></td>
                                    <td><?= round($row['ds_score'],3) ?></td>
                                    <td><?= round($row['cn_score'],3) ?></td>
                                    <td><?= date("d/m/Y H:i", strtotime($row['created_at'])) ?></td>
                                    <td>
                                        <a href="detail.php?id=<?= $row['id'] ?>" class="btn btn-sm admin-btn-detail">
                                            Lihat Detail
                                        </a>
                                    </td>
                                </tr>
                                <?php 
                                    }
                                } else {
                            ?>
                                <tr>
                                    <td colspan="8" style="text-align: center; padding: 2rem; color: #999;">
                                        ℹ️ Tidak ada data ditemukan
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>

                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- CREDIT FREEPIK -->
    <div class="credit">
        <a href="http://www.freepik.com">Designed by starline / Freepik</a>
    </div>

    <!-- BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>