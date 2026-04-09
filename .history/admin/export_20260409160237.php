<?php
include '../config/connection.php';

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=data_kuesioner.xls");

$query = mysqli_query($conn, "SELECT * FROM results");

echo "ID\tNama\tQ1\tQ2\tQ3\tQ4\tQ5\tQ6\tQ7\tQ8\tQ9\tQ10\tQ11\tQ12\tAI\tSE\tDS\tCN\tTanggal\n";

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
         $row['ai_score']."\t".
         $row['se_score']."\t".
         $row['ds_score']."\t".
         $row['cn_score']."\t".
         $row['created_at']."\n";
}
?>