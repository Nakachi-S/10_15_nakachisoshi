<?php
//update.php 処理の画面

// 関数ファイル読み込み
include('user_functions.php');
// var_dump($_POST);
// exit();

//入力チェック(受信確認処理追加)
if (
    !isset($_POST['username']) || $_POST['username']=='' ||
    !isset($_POST['lid']) || $_POST['lid']==''
) {
    exit('ParamError');
}

     

//POSTデータ取得
$username = $_POST['username'];
$lid = $_POST['lid'];
$lpw = $_POST['lpw'];
$kanri_flg = $_POST['kanri_flg'];
$life_flg = $_POST['life_flg'];



//DB接続します(エラー処理追加)
$pdo = db_conn();



//データ登録SQL作成
$sql = 'UPDATE user_table SET username=:a1, lid=:a2, lpw=:a3, kanri_flg=:a4, life_flg=:a5 WHERE id=:id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':a1', $username, PDO::PARAM_STR);    //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a2', $lid, PDO::PARAM_STR);   //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a3', $lpw, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a4', $kanri_flg, PDO::PARAM_STR);   //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a5', $life_flg, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)

$status = $stmt->execute();




//4．データ登録処理後
if ($status==false) {
    errorMsg($stmt);
} else {
    //処理が終わったらselect.phpに移動する

    header('Location:user_select.php');
    exit;
}

var_dump($lid);

//htmlが入っていなければ画面表示はしない。データ処理のページ！
