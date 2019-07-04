<?php
session_start();
include_once 'dbconnect.php';
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
}

////////////////////////////////////////////////////////
// idに基づいて削除
// GETデータ取得
$id   = $_GET['id'];
$query = 'DELETE FROM books WHERE id=' . $id;

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
