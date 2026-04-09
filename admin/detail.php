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
    <title>Detail Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-4">
        <h3>Detail Data ID: <?= $id ?></h3>

        <table class="table table-bordered">
            <tr>
                <th>Nama</th>
                <td><?= $data['name'] ?></td>
            </tr>

            <?php for ($i=1;$i<=12;$i++) { ?>
            <tr>
                <th>Q<?= $i ?></th>
                <td><?= $data["q$i"] ?></td>
            </tr>
            <?php } ?>

            <tr>
                <th>AI</th>
                <td><?= $data['ai_score'] ?></td>
            </tr>
            <tr>
                <th>SE</th>
                <td><?= $data['se_score'] ?></td>
            </tr>
            <tr>
                <th>DS</th>
                <td><?= $data['ds_score'] ?></td>
            </tr>
            <tr>
                <th>CN</th>
                <td><?= $data['cn_score'] ?></td>
            </tr>
        </table>

        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </div>

</body>

</html>