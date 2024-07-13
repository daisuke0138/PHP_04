<?php
// DB接続
session_start();
include("functions.php");

// POSTデータ確認
$No = $_POST['No'];
$pass = $_POST['pass'];
$name = $_POST['name'];

$pdo = connect_to_db();

// SQL作成処理
$sql = 'SELECT * FROM menber_list WHERE No=:No AND name=:name AND deleted_at IS NULL';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':No', $No, PDO::PARAM_STR);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  if (password_verify($pass , $user['pass'])) {
    // パスワードが一致する場合、ログイン成功処理
    $_SESSION = array();
    $_SESSION['session_id'] = session_id();
    $_SESSION['No'] = $user['No'];
    $_SESSION['name'] = $user['name'];
    header('Location: menu.php');
    exit();
  } else {
    // パスワードが一致しない場合、エラーメッセージ
    echo 'ログイン情報が正しくありません。';
  }
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
};

// var_dump($stmt);
// exit();