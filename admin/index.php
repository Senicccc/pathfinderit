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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-4">

        <h3 class="mb-3">Dashboard Admin 🔥</h3>

        <!-- SEARCH -->
        <form method="GET" class="mb-3">
            <div class="row">
                <div class="col-md-6">
                    <input type="text" name="search" value="<?= $keyword ?>" placeholder="Cari ID (angka) atau Nama"
                        class="form-control">
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary w-100">Search</button>
                </div>
                <div class="col-md-2">
                    <a href="index.php" class="btn btn-secondary w-100">Reset</a>
                </div>
            </div>
        </form>

        <!-- EXPORT -->
        <a href="export.php?search=<?= $keyword ?>" class="btn btn-success mb-3">
            Export Excel
        </a>

        <!-- TABLE -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped text-center">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>AI</th>
                        <th>SE</th>
                        <th>DS</th>
                        <th>CN</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php while($row = mysqli_fetch_assoc($query)) { ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['name'] ?></td>
                        <td><?= round($row['ai_score'],3) ?></td>
                        <td><?= round($row['se_score'],3) ?></td>
                        <td><?= round($row['ds_score'],3) ?></td>
                        <td><?= round($row['cn_score'],3) ?></td>
                        <td><?= date("Y-m-d H:i", strtotime($row['created_at'])) ?></td>
                        <td>
                            <a href="detail.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-primary">
                                Detail
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>

            </table>
        </div>

    </div>

</body>

</html>