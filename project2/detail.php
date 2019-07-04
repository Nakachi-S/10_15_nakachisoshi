<?php
session_start();
include_once 'dbconnect.php';
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
}

////////////////////////////////////
//右上のユーザー情報のため
////////////////////////////////////
// ユーザーIDからユーザー名を取り出す
$query = "SELECT * FROM users WHERE user_id=" . $_SESSION['user'] . "";
$result = $mysqli->query($query);


$result = $mysqli->query($query);
if (!$result) {
    print('クエリーが失敗しました。' . $mysqli->error);
    $mysqli->close();
    exit();
}

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
    $user_id = $row['user_id'];
    $username = $row['username'];
    $email = $row['email'];
}

////////////////////////////////////
//以下、編集画面のため
////////////////////////////////////
// GETデータ取得
$id   = $_GET['id'];
// データベースより表示
$query = 'SELECT * FROM books WHERE id=' . $id;
$result = $mysqli->query($query);

if (!$result) {
    print('クエリーが失敗しました。' . $mysqli->error);
    $mysqli->close();
    exit();
}
$rs = $result->fetch_assoc();
// データベースの切断
$result->close();

?>
<!DOCTYPE HTML>
<html lang="ja">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BOOKS</title>
    <link rel="stylesheet" href="style.css">
    <!-- Bootstrap読み込み（スタイリングのため） -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css"> -->

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
</head>

<body class="mx-auto" style="width: 1000px;">
    <div class="text-right">
        <p>ようこそ <strong><?php echo $username; ?></strong>さん</p>
        <a href="logout.php?logout">ログアウト</a>
    </div>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
        <div class="container">
            <a class="navbar-brand" href="#">BOOKS</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="./home.php">Home
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./register_book.php">Register</a>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="mt-3">編集画面</h1>
                    <!-- <p class="lead"><?= $username ?>さんのお気に入り登録した本</p> -->

            </div>
        </div>
        <div class="row">
            <form method="post" action="update.php">
                <div class="form-group">
                    <label for="comment">Comment</label>
                    <!-- 受け取った値挿入しよう -->
                    <textarea class="form-control" id="comment" name="comment" rows="3"><?= $rs['comment'] ?></textarea>
                </div>
                <div class="form-group">
                    <label for="state_read">読書状況</label>
                    <select class="form-control" id="state_read" name="state_read">
                        <?php
                        switch ($rs['state_read']) {
                            case 0:
                                echo ('<option value="0" selected="selected">未読</option><option value="1">読書中</option><option value="2">読了</option>');
                                break;
                            case 1:
                                echo ('<option value="0">未読</option><option value="1" selected="selected">読書中</option><option value="2">読了</option>');
                                break;
                            case 2:
                                echo ('<option value="0">未読</option><option value="1">読書中</option><option value="2" selected="selected">読了</option>');
                                break;
                            default:
                                # code...
                                break;
                        }
                        ?>
                        <!-- <option value="0" selected="selected">未読</option>
                        <option value="1">読書中</option>
                        <option value="2">読了</option> -->
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <!-- idは変えたくない = ユーザーから見えないようにする-->
                <input type="hidden" name="id" value="<?= $rs['id'] ?>">
            </form>
        </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.slim.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>