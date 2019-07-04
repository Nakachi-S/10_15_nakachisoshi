<?php
session_start();
include_once 'dbconnect.php';
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
}

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
                    <li class="nav-item">
                        <a class="nav-link" href="./home.php">Home
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Register</a>
                        <span class="sr-only">(current)</span>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <form method="post">
                    <h2 class="mt-3">Register</h2>
                    <h5 class="mt-5">キーワードを入力してください</h5>
                    <div class="form-group">
                        <input type="text" class="form-control" name="keyword" placeholder="キーワード" required />
                    </div>
                    <button type="submit" class="btn btn-info" name="serch">検索</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-xs-6 col-xs-offset-3">
        <?php
        if (isset($_POST['serch'])) {
            // google books apiを使いますよー
            $data = "https://www.googleapis.com/books/v1/volumes?q=" . $_POST['keyword'];
            $json = file_get_contents($data);
            $json_decode = json_decode($json);

            $str = '<div class="container">';
            // jsonデータ内の『entry』部分を複数取得して、postsに格納
            foreach ($json_decode->items as $posts) {

                $str .= '<div class="row mt-5"><div class="col-md-2"><img src="' . $posts->volumeInfo->imageLinks->thumbnail . '" class="img-thumbnail"></div>';
                $str .= '<div class="col-md-8">【タイトル】' . $posts->volumeInfo->title . '<br>' . $posts->volumeInfo->description . '</div>';
                $str .= '<div class="col-md-2 pt-3"><a class="btn btn-primary" href="' . $posts->volumeInfo->infoLink . '" role="button" target=_blank>URL</a><br>';
                $str .= '<form method="POST"><input type="hidden" name="img_URL" value="' . $posts->volumeInfo->imageLinks->thumbnail . '"><input type="hidden" name="title" value="' . $posts->volumeInfo->title . '"><input type="hidden" name="description" value="' . $posts->volumeInfo->description . '"><input type="hidden" name="infoLink" value="' . $posts->volumeInfo->infoLink . '"><input type="submit" class="btn btn-primary mt-3" value="登録" name="register"></form></div>';
                $str .= '</div>';
            }
            $str .= '</div>';
            echo ($str);
        }

        if (isset($_POST['register'])) {
            $img_URL = $mysqli->real_escape_string($_POST['img_URL']);
            $title = $mysqli->real_escape_string($_POST['title']);
            $description = $mysqli->real_escape_string($_POST['description']);
            $infoLink = $mysqli->real_escape_string($_POST['infoLink']);

            // POSTされた情報をDBに格納する
            $query = "INSERT INTO books(user_id,img_URL,title,description,infoLink,comment,state_read) VALUES('$user_id','$img_URL','$title','$description','$infoLink','','0')";

            if ($mysqli->query($query)) {
                echo ('<div class="alert alert-success" role="alert">登録しました<br>ホームで一覧が確認できます。</div>');
            } else {
                echo ('<div class="alert alert-danger" role="alert">エラーが発生しました。</div>');
            }
        }
        ?>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.slim.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>