<?php
session_start();
include '../config/koneksi.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

// search
$keyword = isset($_GET['search']) ? $_GET['search'] : '';

$query = mysqli_query($conn, "
SELECT * FROM results
WHERE id LIKE '%$keyword%' OR name LIKE '%$keyword%'
ORDER BY id DESC
");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-4">
        <h3>Dashboard Admin 🔥</h3>

        <form method="GET" class="mb-3">
            <input type="text" name="search" placeholder="Cari ID / Nama" class="form-control">
        </form>

        <a href="export.php" class="btn btn-success mb-3">Export Excel</a>

        <table class="table table-bordered table-striped">
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>AI</th>
                <th>SE</th>
                <th>DS</th>
                <th>CN</th>
                <th>Tanggal</th>
            </tr>

            <?php while($row = mysqli_fetch_assoc($query)) { ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= round($row['ai_score'],3) ?></td>
                <td><?= round($row['se_score'],3) ?></td>
                <td><?= round($row['ds_score'],3) ?></td>
                <td><?= round($row['cn_score'],3) ?></td>
                <td><?= $row['created_at'] ?></td>
            </tr>
            <?php } ?>

        </table>
    </div>

</body>

</html>