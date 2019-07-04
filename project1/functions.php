<?php
// 共通で使うものを別ファイルにしておきましょう。

// DB接続関数（PDO）
function db_conn()
{
    $dbname = 'gsf_d03_db15';
    $db = 'mysql:dbname=' . $dbname . ';charset=utf8;port=3306;host=localhost';
    $user = 'root';
    $pwd = 'root';
    try {
        return new PDO($db, $user, $pwd);
    } catch (PDOException $e) {
        exit('dbError:' . $e->getMessage());
    }
}

// SQL処理エラー
function errorMsg($stmt)
{
    $error = $stmt->errorInfo();
    exit('ErrorQuery:' . $error[2]);
}

// SESSIONチェック＆リジェネレイト
function chk_ssid()
{
    // ログイン失敗時の処理（ログイン画面に移動）
    if (!isset($_SESSION['chk_ssid']) || $_SESSION['chk_ssid'] != session_id()) {
        header('Location: login.php');
    } else {
        session_regenerate_id(true);
        $_SESSION['chk_ssid'] = session_id();
    }
}
// ログイン成功時の処理（一覧画面に移動）


// menuを決める
function menu()
{
    $menu = '<li class="nav-item"><a class="nav-link" href="index.php">todo登録</a></li><li class="nav-item"><a class="nav-link" href="select.php">todo一覧</a></li>';
    if ($_SESSION['kanri_flg'] == 1) {
        $menu .= '<li class="nav-item"><a class="nav-link" href="user_index.php">user登録</a></li>';
        $menu .= '<li class="nav-item"><a class="nav-link" href="user_select.php">user管理</a></li>';
    }
    $menu .= '<li class="nav-item"><a class="nav-link" href="logout.php">ログアウト</a></li>';
    return $menu;
}
