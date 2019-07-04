<?php
session_start();
include_once 'dbconnect.php';
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
}

//POSTデータ取得
$id = $_POST['id'];
$comment = $_POST['comment'];
$state_read = $_POST['state_read'];

// $stmt = $mysqli->prepare("UPDATE books SET comment='test' state=1 WHERE id=11");
// $stmt->bind_param('sii', $comment, $state, $id);
// $stmt->execute();

// //データ登録SQL作成
$query = 'UPDATE books SET comment="' . $comment . '", state_read=' . $state_read . ' WHERE id=' . $id;
$result = $mysqli->query($query);
if (!$result) {
    print('クエリーが失敗しました。' . $mysqli->error);
    $result->close();
    exit();
}

//home.phpへリダイレクト
header('Location: home.php');
$result->close();
exit;
