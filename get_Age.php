<?php
include 'functions.php';

$pdo = db_conn();

$sql = 'SELECT Age FROM Titanic';
$sql1 = 'SELECT Age, COUNT(*) AS AgeCount FROM Titanic GROUP BY Age HAVING (COUNT(*) > 1) ORDER BY Age';
$stmt = $pdo->prepare($sql1);

$status = $stmt->execute();

//データ表示
if ($status == false) {
    showSqlErrorMsg($stmt);
} else {
    $res = [];
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $res[] = $result;
    }
    echo json_encode($res);
}


// $stmt->execute();
// $res = $stmt->fetchAll();


// echo ($res);
