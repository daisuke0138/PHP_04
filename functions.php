<?php

function connect_to_db()
{
$dbn = 'mysql:dbname=menberlist_database01;charset=utf8mb4;port=3306;host=localhost';
$user = 'root';
$pwd = '';

try {
  return new PDO($dbn, $user, $pwd);
} catch (PDOException $e) {
  echo json_encode(["db error" => "{$e->getMessage()}"]);
  exit();
}
};

// ログイン状態のチェック関数
function check_session_id()
{
  if (!isset($_SESSION["session_id"]) || $_SESSION["session_id"] !== session_id()) {
    header('Location:top_input.php');
    exit();
  } else {
    session_regenerate_id(true);
    $_SESSION["session_id"] = session_id();
  }
}