<?php
include 'config/connection.php';

// ambil input
for ($i = 1; $i <= 12; $i++) {
    ${"q$i"} = $_POST["q$i"];
}

// fungsi utility
function benefit($x) {
    return ($x - 1) / 4;
}

function cost($x) {
    return (5 - $x) / 4;
}

// HITUNG SMART

// AI (Q1, Q9, Q12 - Q12 COST)
$ai_score =
(0.4 * benefit($q1)) +
(0.4 * benefit($q9)) +
(0.2 * cost($q12));

// SE (Q2, Q6, Q11 - Q11 COST)
$se_score =
(0.4 * benefit($q2)) +
(0.4 * benefit($q6)) +
(0.2 * cost($q11));

// DS (Q4, Q7, Q10 - Q10 COST)
$ds_score =
(0.4 * benefit($q4)) +
(0.4 * benefit($q7)) +
(0.2 * cost($q10));

// CN (Q3, Q5, Q8 - Q8 COST)
$cn_score =
(0.4 * benefit($q3)) +
(0.4 * benefit($q5)) +
(0.2 * cost($q8));

// ranking
$results = [
    "Artificial Intelligence" => $ai_score,
    "Software Engineering" => $se_score,
    "Data Science" => $ds_score,
    "Computer Network" => $cn_score
];

arsort($results);

$name = $_POST['name'];

// simpan ke DB
mysqli_query($conn, "INSERT INTO results 
(q1,q2,q3,q4,q5,q6,q7,q8,q9,q10,q11,q12,ai_score,se_score,ds_score,cn_score)
VALUES
('$q1','$q2','$q3','$q4','$q5','$q6','$q7','$q8','$q9','$q10','$q11','$q12','$ai_score','$se_score','$ds_score','$cn_score')
");

// kirim ke hasil
session_start();
$_SESSION['results'] = $results;

header("Location: result.php");
exit;
?>