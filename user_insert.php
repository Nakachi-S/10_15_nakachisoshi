<?php
//insert.phpは見えない処理ページ

include('user_functions.php');

// 入力チェック
if (
    !isset($_POST['username']) || $_POST['username'] == '' ||
    !isset($_POST['email']) || $_POST['email'] == ''
) {
    exit('ParamError');
}

//POSTデータ取得
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

$pdo = db_conn();


//データ登録SQL作成
$sql = 'INSERT INTO users(user_id, username,email, password)
VALUES(NULL, :a1, :a2, :a3)';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':a1', $username, PDO::PARAM_STR);    //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a2', $email, PDO::PARAM_STR);   //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a3', $password, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)

$status = $stmt->execute();

//データ登録処理後
if ($status == false) {
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    $error = $stmt->errorInfo();
    exit('sqlError:' . $error[2]);
} else {
    //index.phpへリダイレクト
    header('Location: index.php');
}
