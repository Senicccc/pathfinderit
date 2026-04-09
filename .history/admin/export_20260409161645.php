<?php
include '../config/connection.php';

// ambil keyword
$keyword = isset($_GET['search']) ? $_GET['search'] : '';

// query sesuai filter
if ($keyword != '') {
    if (is_numeric($keyword)) {
        $query = mysqli_query($conn, "SELECT * FROM results WHERE id = '$keyword'");
    } else {
        $query = mysqli_query($conn, "SELECT * FROM results WHERE name LIKE '%$keyword%'");
    }
} else {
    $query = mysqli_query($conn, "SELECT * FROM results");
}

// header excel
header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=data_kuesioner.xls");

// header kolom
echo "ID\tNama\tQ1\tQ2\tQ3\tQ4\tQ5\tQ6\tQ7\tQ8\tQ9\tQ10\tQ11\tQ12\tAI\tSE\tDS\tCN\tTanggal\n";

// isi data
while($row = mysqli_fetch_assoc($query)) {

    echo $row['id']."\t".
         $row['name']."\t".
         $row['q1']."\t".
         $row['q2']."\t".
         $row['q3']."\t".
         $row['q4']."\t".
         $row['q5']."\t".
         $row['q6']."\t".
         $row['q7']."\t".
         $row['q8']."\t".
         $row['q9']."\t".
         $row['q10']."\t".
         $row['q11']."\t".
         $row['q12']."\t".
         round($row['ai_score'],3)."\t".
         round($row['se_score'],3)."\t".
         round($row['ds_score'],3)."\t".
         round($row['cn_score'],3)."\t".
         date("Y-m-d H:i:s", strtotime($row['created_at'])).
         "\n";
}
?>