<?php
session_start();
include_once 'dbconnect.php';
if (!isset($_SESSION['user'])) {
	header("Location: index.php");
}


// tableはusers
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
	$username = $row['username'];
	$email = $row['email'];
}
// データベースの切断
$result->close();

////////////////////////////////////////////////////////
// tableはbooks
// ユーザーIDから本の情報を取り出す
$query = "SELECT * FROM books WHERE user_id=" . $_SESSION['user'] . "";
$result = $mysqli->query($query);

if (!$result) {
	print('クエリーが失敗しました。' . $mysqli->error);
	$mysqli->close();
	exit();
}

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
	$img_URL = $row['img_URL'];
	$title = $row['title'];
	$description = $row['description'];
	$infoLink = $row['infoLink'];
	$id = $row['id'];
	$comment = $row['comment'];
	$state_read = '';
	switch ($row['state_read']) {
		case 0:
			// 未読の場合
			$state_read = '未読';
			break;
		case 1:
			// 読書中の場合
			$state_read = '読書中';
			break;
		case 2:
			//読了の場合
			$state_read = '読了';
			break;
	}

	// jsonデータ内の『entry』部分を複数取得して、postsに格納
	$str .= '<div class="row mt-5"><div class="col-md-2"><img src="' . $img_URL . '" class="img-thumbnail"></div>';
	$str .= '<div class="col-md-8"><div class="top">【タイトル】' . $title . '<br>' . $description . '<br></div>';
	$str .= '<p class="mt-2"><span class="dokusyo">読書状態</span><br><strong>コメント</strong><br>' . $comment . '<br><strong>読書状態</strong><br>' . $state_read . '</p></div>';
	$str .= '<div class="col-md-2 pt-3"><a class="btn btn-primary" href="' . $infoLink . '" role="button" target=_blank>URL</a><br>';
	$str .= '<a href="detail.php?id=' . $id . '" class="btn btn-info mt-3">編集</a><br>';
	$str .= '<a href="delete.php?id=' . $id . '" class="btn btn-danger mt-3">削除</a><br>';
	$str .= '</div> </div>';
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
						<a class="nav-link" href="#">Home
							<span class="sr-only">(current)</span>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="./register_book.php">Register</a>
					</li>
			</div>
		</div>
	</nav>

	<!-- Page Content -->
	<div class="container">
		<div class="row">
			<div class="col-lg-12 text-center">
				<h2 class="mt-3">Favorite Books!</h1>
					<!-- <p class="lead"><?= $username ?>さんのお気に入り登録した本</p> -->

			</div>
		</div>
		<?php echo ($str); ?>
	</div>

	<!-- Bootstrap core JavaScript -->
	<script src="vendor/jquery/jquery.slim.min.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>