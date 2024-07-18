<?php
session_start();
include('functions.php');
check_session_id();

// DB接続
$pdo = connect_to_db();


// セッションからNoを取得
$No = $_SESSION['No'];
$user_id = $_SESSION['id'];



// 最新のfile_idを取得
$sql = 'SELECT MAX(file_id) AS max_file_id FROM file_table';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$max_file_id = $result['max_file_id'];
$file_id = $max_file_id + 1;

// POSTデータの取得
$file = $_FILES['file'];
$filename = $file['name'];
$filetype = $file['type'];
$filetmpname = $file['tmp_name'];
$fileerror = $file['error'];
$filesize = $file['size'];
$filevalue = $_POST['file_value'];


// 名前をURLエンコードする
$encodedName = urlencode($No);

// 画像保存先のパスを設定
 $uploadFile = "data/file/file_{$encodedName}_{$file_id}.pdf";

$file_pass = $uploadFile;

// ファイルのアップロード処理
if (move_uploaded_file($filetmpname,$uploadFile)){
              echo "ファイルが正常にアップロードされました。";
        } else {
          echo "ファイルのアップロードに失敗しました。";
        };

// SQL作成処理
$sql = 'INSERT INTO file_table (user_id, file_id, file_pass, file_value , created_at) VALUES (:user_id, :file_id, :file_pass, :file_value , now())';
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->bindParam(':file_id', $file_id, PDO::PARAM_INT);
$stmt->bindParam(':file_pass', $file_pass, PDO::PARAM_STR);
$stmt->bindParam(':file_value', $filevalue, PDO::PARAM_STR);

try {
  $stmt->execute();
  echo json_encode(["status" => "success"]);
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

header("Location:menberlist.php");
exit();

// echo "<pre>";
// var_dump($record);
// echo "</pre>";
// exit();