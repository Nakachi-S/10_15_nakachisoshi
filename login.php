<?php
session_start();
if (isset($_SESSION['user']) != "") {
    // ログイン済みの場合はリダイレクト
    header("Location: home.php");
}
?>

<!DOCTYPE HTML>
<html lang="ja">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pre-Rental</title>
    <!-- <link rel="stylesheet" href="./style.css"> -->
    <!-- Bootstrap読み込み（スタイリングのため） -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
</head>

<body class="mx-auto">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary static-top">
        <div class="container">
            <img src="./img/icon.png" width="40">
            <a class="navbar-brand ml-3" href="index.php">Pre-Rental</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active border">
                        <a class="nav-link" href='register.php'>アカウント作成</a>
                    </li>
            </div>
        </div>
    </nav>

    <!-- Page Content -->

    <form method="post" class="form-signin" action="login_act.php">
        <h1 class="h3 mb-3 font-weight-normal">ログイン</h1>
        <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="メールアドレス" required />
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="パスワード" required />
        </div>
        <button type="submit" class="btn btn-primary" name="login">ログインする</button>
        <div class="mt-3"><a href="register.php">アカウント登録はこちら</a></div>
    </form>

    <footer class="container-fluid" style="text-align:center;padding:10px;background: #101010;">
        <small><a href="/">Copyright (C) 2019 Pre-Rental All Rights Reserved.</a></small>
    </footer>
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