<?php
session_start();
include('functions.php');
check_session_id();

// 検索クエリの取得
$searchNo = $_GET['searchNo'] ?? '';

if ($searchNo === '') {
    echo '検索するNoを入力してください。';
    exit;
}


// DB接続
$pdo = connect_to_db();

// SQL作成処理
$sql = 'SELECT * FROM menber_list WHERE No = :No';
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':No', $searchNo, PDO::PARAM_INT);
$stmt->execute();

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
};

// SQL実行の処理
$record = $stmt->fetch(PDO::FETCH_ASSOC);
$output = "";
if ($record) {
    $output .= "
    <table border='1'>
        <tr>
            <th>社員番号</th>
            <td><input type='text' name='No' value='{$record["No"]}'readonly></td>
        </tr>
        <tr>
            <th>氏名</th>
            <td><input type='text' name='name' value='{$record["name"]}'readonly></td>
        </tr>
        <tr>
            <th>所属</th>
            <td><input type='text' name='department' value='{$record["department"]}'</td>
        </tr>
        <tr>
            <th>職能</th>
            <td><input type='text' name='class' value='{$record["class"]}'</td>
        </tr>
        <tr>
            <th>業務経歴</th>
            <td><textarea name='skill'>{$record["skill"]}</textarea>
        </tr>
        <tr>
            <th>趣味</th>
            <td><input type='text' name='hobby' value='{$record["hobby"]}'</td>
        </tr>
        <tr>
            <th>写真</th>
            <td><img class='readimg' id='readimg' name='photo' src='{$record["photo"]}' alt='no-image'></td>
        </tr>
    </table>
    ";
} else {
    $output .= "一致するデータが見つかりませんでした。";
}
echo $output;

// var_dump($results);
// exit();