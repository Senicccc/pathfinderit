<?php
$conn = mysqli_connect("localhost", "root", "", "pathfinderit");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>