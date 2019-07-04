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
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css"> -->
	<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
</head>

<body class="text-center">
	<div class="col-xs-6 col-xs-offset-3">

		<form method="post" class="form-signin">
			<img class="mb-4 mt-3" src="./img/book.png" alt="" width="72" height="72">
			<h1 class="h3 mb-3 font-weight-normal">サインイン</h1>
			<div class="form-group">
				<input type="email" class="form-control" name="email" placeholder="メールアドレス" required />
			</div>
			<div class="form-group">
				<input type="password" class="form-control" name="password" placeholder="パスワード" required />
			</div>
			<button type="submit" class="btn btn-primary" name="login">ログインする</button>
			<div class="mt-3"><a href="register.php">会員登録はこちら</a></div>
		</form>

	</div>
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