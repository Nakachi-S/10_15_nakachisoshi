<?php
ob_start();
// ここから、register.phpと同様
session_start();
if (isset($_SESSION['user']) != "") {
    header("Location: home.php");
}
include_once 'dbconnect.php';
// ここまで、register.phpと同様
?>

<?php
if (isset($_POST['login'])) {

    $email = $mysqli->real_escape_string($_POST['email']);
    $password = $mysqli->real_escape_string($_POST['password']);

    // クエリの実行
    $query = "SELECT * FROM users WHERE email='$email'";
    $result = $mysqli->query($query);
    if (!$result) {
        print('クエリーが失敗しました。' . $mysqli->error);
        $mysqli->close();
        exit();
    }

    // パスワード(暗号化済み）とユーザーIDの取り出し
    while ($row = $result->fetch_assoc()) {
        $db_hashed_pwd = $row['password'];
        $user_id = $row['user_id'];
    }

    // データベースの切断
    $result->close();

    // ハッシュ化されたパスワードがマッチするかどうかを確認
    if (password_verify($password, $db_hashed_pwd)) {
        $_SESSION['user'] = $user_id;
        header("Location: home.php");
        exit;
    } else { ?>
        <div class="alert alert-danger" role="alert">メールアドレスとパスワードが一致しません。</div>
    <?php }
} ?>

<!DOCTYPE HTML>
<html lang="ja">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BOOKS</title>
    <link rel="stylesheet" href="./style.css">
    <!-- Bootstrap読み込み（スタイリングのため） -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
</head>

<body class="mx-auto" style="width: 1000px;">
    <div class="text-right">
        <p>ようこそ <strong>ゲスト</strong>さん</p>
        <a href="./login.php">ログイン</a>
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
                        <a class="nav-link" href="#">Home
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="mt-3">お気に入りの本を登録しよう！</h2>
                <p class="mt-3">ログインまたは新規登録を行い、<br>自分が好きな本をブックマークできるサービスです。</p>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.slim.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<style>
    .form-signin {
        width: 100%;
        max-width: 330px;
        padding: 15px;
        margin: auto;
    }
</style>