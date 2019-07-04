<?php
session_start();
if (isset($_SESSION['user']) != "") {
	// ログイン済みの場合はリダイレクト
	header("Location: home.php");
}

// DBとの接続
include_once 'dbconnect.php';
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
	<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="text-center">
	<div class="col-xs-6 col-xs-offset-3">

		<?php
		// signupがPOSTされたときに下記を実行
		if (isset($_POST['signup'])) {

			$username = $mysqli->real_escape_string($_POST['username']);
			$email = $mysqli->real_escape_string($_POST['email']);
			$password = $mysqli->real_escape_string($_POST['password']);
			$password = password_hash($password, PASSWORD_BCRYPT);

			// POSTされた情報をDBに格納する
			$query = "INSERT INTO users(username,email,password) VALUES('$username','$email','$password')";

			if ($mysqli->query($query)) {  ?>
				<div class="alert alert-success" role="alert">登録しました</div>
			<?php } else { ?>
				<div class="alert alert-danger" role="alert">エラーが発生しました。</div>
			<?php
			}
		} ?>

		<form method="post" class="form-signin">
			<img class="mb-4 mt-3" src="./img/book.png" alt="" width="72" height="72">
			<h1 class="h3 mb-3 font-weight-normal">会員登録</h1>
			<div class="form-group">
				<input type="text" class="form-control" name="username" placeholder="ユーザー名" required />
			</div>
			<div class="form-group">
				<input type="email" class="form-control" name="email" placeholder="メールアドレス" required />
			</div>
			<div class="form-group">
				<input type="password" class="form-control" name="password" placeholder="パスワード" required />
			</div>
			<button type="submit" class="btn btn-primary" name="signup">会員登録する</button>
			<div class="mt-3"><a href="login.php">ログインはこちら</a></div>
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