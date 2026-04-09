<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        echo "Welcome " . $_SESSION['admin'];
        <p>Dashboard siap!</p>

        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>

</body>

</html>