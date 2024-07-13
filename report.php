<?php
session_start();
include('functions.php');
check_session_id();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/report.css">
    <title>社員情報登録・編集</title>

</head>
<body>
<a href="menberlist.php">一覧画面へ</a>

<!-- 社員情報の検索 -->
<div class="editarea">
    <!-- 社員情報の表示、編集 -->
    <div class="edit_table">
        <form id="editdata"   action="edit_update.php" method="POST" enctype="multipart/form-data">
            <fieldset id="first_login" class="result">
                <legend >report提出</legend>
                <div id="result"></div>
            </fieldset>
            <div class="selectfile">
                file選択:<input type="file" id="fileInput" name="file" accept=".pdf,.ppt,.pptx">
                <div id="fileContainer"></div>
            </div>
            <button type="submit">提出</button>
        </form>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.6.347/pdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pptxgenjs/3.4.0/pptxgen.bundle.js"></script>

<script>
  $(document).ready(function(){
    $('#fileInput').on('change', function(event){
      let input = event.target;
      if (input.files && input.files[0]) {
        let file = input.files[0];
        let fileType = file.type;
        let fileName = file.name;
        let fileSize = (file.size / 1024).toFixed(2) + ' KB';

        // ファイル情報を表示
        let fileInfo = `
          <p>ファイル名: ${fileName}</p>
          <p>ファイルタイプ: ${fileType}</p>
          <p>ファイルサイズ: ${fileSize}</p>
        `;
        $('#result').html(fileInfo);

        // PDFファイルのプレビュー表示
        if (fileType === 'application/pdf') {
          let reader = new FileReader();
          reader.onload = function(e) {
            let pdfData = new Uint8Array(e.target.result);
            let loadingTask = pdfjsLib.getDocument({data: pdfData});
            loadingTask.promise.then(function(pdf) {
              pdf.getPage(1).then(function(page) {
                let scale = 1.5;
                let viewport = page.getViewport({scale: scale});

                let canvas = document.createElement('canvas');
                let context = canvas.getContext('2d');
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                page.render({canvasContext: context, viewport: viewport}).promise.then(function() {
                  $('#result').append(canvas);
                });
              });
            }, function(reason) {
              console.error(reason);
            });
          };
          reader.readAsArrayBuffer(file);
        }
        // PPTXファイルのプレビュー表示
        else if (fileType === 'application/vnd.openxmlformats-officedocument.presentationml.presentation') {
          let reader = new FileReader();
          reader.onload = function(e) {
            let arrayBuffer = e.target.result;
            let pptx = new PptxGenJS();
            pptx.load(arrayBuffer, function(pptxFile) {
              pptxFile.getSlides().forEach(function(slide, index) {
                let slideElement = document.createElement('div');
                slideElement.innerHTML = `スライド ${index + 1}`;
                $('#result').append(slideElement);

                slide.getElements().forEach(function(element) {
                  let elementText = document.createElement('p');
                  elementText.textContent = element.text;
                  slideElement.appendChild(elementText);
                });
              });
            });
          };
          reader.readAsArrayBuffer(file);
        } else {
          $('#result').append('<p>プレビューはPDFおよびPPTXファイルのみ対応しています。</p>');
        }
      }
    });
  });
</script>
</body>
</html>