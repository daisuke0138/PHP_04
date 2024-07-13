<?php
session_start();
include('functions.php');
check_session_id();

// DB接続
$pdo = connect_to_db();

// セッションからNoを取得
$No = $_SESSION['No'];

// データ検証
if (
  !isset($_FILES['file']) || $_FILES['file'] === ''
) {
  exit('paramError');
}

// POSTデータの取得
$file = $_FILES['file'];
$filename = $file['name'];
$filetype = $file['type'];
$filetmpname = $file['tmp_name'];
$fileerror = $file['error'];
$filesize = $file['size'];
$No = $_SESSION['No'];

// 名前をURLエンコードする
$encodedName = urlencode($No);

// 画像保存先のパスを設定
 $uploadFile = "data/file/file_{$encodedName}.pdf";

// ファイルのアップロード処理
if (move_uploaded_file($filetmpname,$uploadFile)){
              echo "ファイルが正常にアップロードされました。";
        } else {
          echo "ファイルのアップロードに失敗しました。";
        };

// SQL作成処理
// $sql = 'UPDATE menber_list SET name = :name, department = :department, class = :class, skill = :skill, hobby = :hobby, photo= :photo, updated_at=now() WHERE No = :No';
// $stmt = $pdo->prepare($sql);
// $stmt->bindParam(':No', $No, PDO::PARAM_INT);
// $stmt->bindParam(':name', $name, PDO::PARAM_STR);
// $stmt->bindParam(':department', $department, PDO::PARAM_STR);
// $stmt->bindParam(':class', $class, PDO::PARAM_STR);
// $stmt->bindParam(':skill', $skill, PDO::PARAM_STR);
// $stmt->bindParam(':hobby', $hobby, PDO::PARAM_STR);
// $stmt->bindParam(':photo', $uploadFile, PDO::PARAM_STR);

// try {
//   $stmt->execute();
//   echo json_encode(["status" => "success"]);
// } catch (PDOException $e) {
//   echo json_encode(["sql error" => "{$e->getMessage()}"]);
//   exit();
// }

header("Location:menberlist.php");
exit();

// echo "<pre>";
// var_dump($record);
// echo "</pre>";
// exit();