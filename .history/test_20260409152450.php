<?php
include 'config/koneksi.php';

$query = mysqli_query($conn, "SELECT 1");

if ($query) {
    echo "Database ready 🔥";
} else {
    echo "Query gagal!";
}
?>