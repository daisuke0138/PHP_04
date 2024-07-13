<?php
session_start();
include('functions.php');
check_session_id();

// データ受け取り
$No = $_GET['No'];
// GETの検証
// var_dump($_GET);
// exit();


// データベースに接続
$pdo = connect_to_db();

// SQL文
$sql = 'UPDATE menber_list SET deleted_at=now() WHERE No=:No';
$stmt = $pdo->prepare($sql);

// 変数をバインドする
$stmt->bindValue(':No', $No, PDO::PARAM_STR);

// SQL実行
try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

header("Location:menberlist.php");
exit();