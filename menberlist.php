<?php
// DB接続
session_start();
include("functions.php");
check_session_id();

$pdo = connect_to_db();

// セッションからNoを取得
$No = $_SESSION['No'];

// 名前をURLエンコードする
$encodedName = urlencode($No);

// pdfファイル保存先のパスを設定
$uploadFile = "data/file/file_{$encodedName}.pdf";

// SQL作成処理
$sql = 'SELECT * FROM menber_list WHERE deleted_at IS NULL ORDER BY No ASC';
$stmt = $pdo->prepare($sql);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
};

// SQL実行の処理
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$output = "";
foreach ($result as $record) {
  $output .= "
    <tr>
      <td><img class='menberimg' src='{$record["photo"]}'></td>
      <td>{$record["No"]}</td>
      <td>{$record["name"]}</td>
      <td>{$record["department"]}</td>
      <td>{$record["class"]}</td>
      <td>{$record["skill"]}</td>
      <td>{$record["hobby"]}</td>
      <td class='output' data-no='{$record["No"]}'>詳細</td>
    </tr>
  ";
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/menberlist.css">
  <title>menberlist</title>
</head>

<body>
  <h2>ようこそ <?= $_SESSION['name'] ?> さん</h2>
  <a href="menu.php">menu画面へ</a>
  <fieldset>
    <legend>menberlist</legend>
    <table class='table' border='2'>
      <thead>
        <tr>
          <th>写真</th>
          <th>社員No.</th>
          <th>氏名</th>
          <th>所属</th>
          <th>職能</th>
          <th>業務経歴</th>
          <th>趣味</th>
          <th>業務報告</th>
        </tr>
      </thead>
      <tbody>
        <?= $output ?>
      </tbody>
    </table>
    <div id="outputarea" class="outputarea" style="display: none;">
      <div class="header-area">
        <p1>業務報告</p1>
        <p2 id="close">閉じる</p2>
      </div>
      <div class="output-body">
        <div class="Document-area">
        </div>
      </div>
    </div>

    <!-- jquery cdn -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.6.347/pdf.min.js"></script>
    <script>
      $(document).ready(function () {
        // 詳細ボタンのクリックイベント
        $(".output").click(function () {
          const No = $(this).data("no");
          $("#outputarea").show();

          // PDFファイルのパス
          const url = `data/file/file_${encodeURIComponent(No)}.pdf`;

          // PDF.jsを使用してPDFを表示する
          pdfjsLib.getDocument(url).promise.then(function (pdf) {
            const container = $('.Document-area');
            container.empty(); // 以前の内容をクリア

            // 全ページを表示
            for (let pageNum = 1; pageNum <= pdf.numPages; pageNum++) {
              pdf.getPage(pageNum).then(function (page) {
                const scale = 1.0;
                const viewport = page.getViewport({ scale: scale });
                const canvas = document.createElement('canvas');
                const context = canvas.getContext('2d');
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                // ページをレンダリング
                page.render({
                  canvasContext: context,
                  viewport: viewport
                }).promise.then(function () {
                  container.append(canvas);
                });
              });
            }
          }).catch(function (error) {
            console.error('PDF読み込みエラー: ', error);
            $('.Document-area').html('<p>PDFを読み込めませんでした。</p>');
          });
        });

        // 閉じるボタンのクリックイベント
        $("#close").click(function () {
          $("#outputarea").hide();
        });
      });
    </script>
</body>
</html>


