<?php
$conn = mysqli_connect("localhost", "root", "", "pathfinderit");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>