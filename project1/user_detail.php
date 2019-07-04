<?php
//detailは更新画面　登録ページ

// var_dump($_GET);
// exit();
// 関数ファイルの読み込み
include('user_functions.php');



// getで送信されたidを取得
$id = $_GET['id'];

//DB接続します
$pdo = db_conn();


//データ登録SQL作成，指定したidのみ表示する
$sql = 'SELECT * FROM user_table WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//データ表示
if ($status==false) {
    // エラーのとき
    errorMsg($stmt);
} else {
    // エラーでないとき
    $rs = $stmt->fetch();
    // fetch()で1レコードを取得して$rsに入れる
    // $rsは配列で返ってくる．$rs["id"], $rs["task"]などで値をとれる
    // var_dump()で見てみよう
    if ($rs['kanri_flg']==0) {
        $kanri0 = 'selected';
        $kanri1 = '';
    } elseif ($rs['kanri_flg']==1) {
        $kanri0 = '';
        $kanri1 = 'selected';
    }

    if ($rs['life_flg']==0) {
        $life0 = 'selected';
        $life1 = '';
    } elseif ($rs['life_flg']==1) {
        $life0 = '';
        $life1 = 'selected';
    }
}
?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>user管理更新ページ</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
        integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>

<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">user管理更新</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="user_index.php">user登録</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="user_select.php">user一覧</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <form method="post" action="user_update.php">
        <div class="form-group">
            <label for="username">name</label>
            <!-- 受け取った値をvaluesに埋め込もう -->
            <input type="text" class="form-control" id="username" name="username"
                value="<?=$rs['username']?>">
        </div>
        <div class="form-group">
            <label for="lid">ログインID</label>
            <!-- 受け取った値をvaluesに埋め込もう -->
            <input type="text" class="form-control" id="lid" name="lid"
                value="<?=$rs['lid']?>">
        </div>
        <div class="form-group">
            <label for="lpw">パスワード</label>
            <!-- 受け取った値をvaluesに埋め込もう -->
            <input type="text" class="form-control" id="lpw" name="lpw"
                value="<?=$rs['lpw']?>">
        </div>

        <div class="form-group">
            <label for="kanri_flg">一般/管理者</label>
            <select class="form-control" id="kanri_flg" name="kanri_flg"
                value="<?=$rs['kanri_flg']?>">
                <option value="" selected>▼下記からお選びください</option>
                <option value="0" name="kanri_flg" <?=$kanri0?>>一般
                </option>
                <option value="1" name="kanri_flg" <?=$kanri1?>>管理者
                </option>
                </option>

            </select>
        </div>

        <div class="form-group">
            <label for="life_flg">アクティブ/非アクティブ</label>
            <select class="form-control" id="life_flg" name="life_flg"
                value="<?=$rs['life_flg']?>">
                <option selected>▼下記からお選びください</option>
                <option value="0" name="life_flg" <?=$life0?>>アクティブ
                </option>
                <option value="1" name="life_flg" <?=$life1?>>非アクティブ
                </option>
                </option>

            </select>
        </div>


        <div class="form-group">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        <!-- idは変えたくない = ユーザーから見えないようにする-->
        <input type="hidden" name="id"
            value="<?=$rs['id']?>">
    </form>

</body>

</html>