<?php
session_start();
include('functions.php');
check_session_id();

// DB接続
$pdo = connect_to_db();

// var_dump($_POST);
// var_dump($_FILES);
// exit();

// データ検証
if (
  !isset($_POST['No']) || $_POST['No'] === '' ||
  !isset($_POST['name']) || $_POST['name'] === '' ||
  !isset($_POST['department']) || $_POST['department'] === '' ||
  !isset($_POST['class']) || $_POST['class'] === '' ||
  !isset($_POST['skill']) || $_POST['skill'] === '' ||
  !isset($_POST['hobby']) || $_POST['hobby'] === '' ||
  !isset($_FILES['photo']) || $_FILES['photo'] === ''
) {
  exit('paramError');
}

// POSTデータの取得
$No = $_POST['No'];
$name = $_POST['name'];
$department = $_POST['department'];
$class = $_POST['class'];
$skill = $_POST['skill'];
$hobby = $_POST['hobby'];
$photo = $_FILES['photo'];

$filename = $photo['name'];
$filetype = $photo['type'];
$filetmpname = $photo['tmp_name'];
$fileerror = $photo['error'];
$filesize = $photo['size'];

// 名前をURLエンコードする
$encodedName = urlencode($No);

// 画像保存先のパスを設定
 $uploadFile = "data/img/img_{$encodedName}.png";

// ファイルのアップロード処理
if (move_uploaded_file($filetmpname,$uploadFile)){
              echo "ファイルが正常にアップロードされました。";
        } else {
          echo "ファイルのアップロードに失敗しました。";
        };


// SQL作成処理
$sql = 'UPDATE menber_list SET name = :name, department = :department, class = :class, skill = :skill, hobby = :hobby, photo= :photo, updated_at=now() WHERE No = :No';
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':No', $No, PDO::PARAM_INT);
$stmt->bindParam(':name', $name, PDO::PARAM_STR);
$stmt->bindParam(':department', $department, PDO::PARAM_STR);
$stmt->bindParam(':class', $class, PDO::PARAM_STR);
$stmt->bindParam(':skill', $skill, PDO::PARAM_STR);
$stmt->bindParam(':hobby', $hobby, PDO::PARAM_STR);
$stmt->bindParam(':photo', $uploadFile, PDO::PARAM_STR);

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