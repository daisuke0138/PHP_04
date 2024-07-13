<?php

if (
  !isset($_POST['No']) || $_POST['No'] === '' ||
  !isset($_POST['name']) || $_POST['name'] === '' ||
  !isset($_POST['pass']) || $_POST['pass'] === '' 
) {
  exit('paramError');
}

// POSTデータ確認
$No = $_POST['No'];
$name = $_POST['name'];
$pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);

// DB接続
include('functions.php');
$pdo = connect_to_db();

// SQL作成&実行
$sql = 'INSERT INTO menber_list (id, No , name , pass) VALUES (NULL, :No, :name, :pass)';

$stmt = $pdo->prepare($sql);

// バインド変数を設定
$stmt->bindValue(':No', $No, PDO::PARAM_INT);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':pass', $pass, PDO::PARAM_STR);

// SQL実行（実行に失敗すると `sql error ...` が出力される）
try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

// SQL実行の処理
header('Location:top_input.php');
exit();
?>

<!-- var_dump($sql);
exit(); -->