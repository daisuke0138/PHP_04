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
    <link rel="stylesheet" href="./css/edit.css">
    <title>社員情報登録・編集</title>
</head>
<body>
<a href="menu.php">menu画面へ</a>

<!-- 社員情報の検索 -->
<div class="editarea">
    <div class="searchForm">
        <form id="searchForm" class="searchForm">
            <label for="searchNo">社員番号検索</label>
            <input type="text" id="searchNo" name="searchNo" required>
            <button type="submit">検索</button>
        </form>
    </div>
    <!-- 社員情報の表示、編集 -->
    <div class="edit_table">
        <form id="editdata"   action="edit_update.php" method="POST" enctype="multipart/form-data">
            <fieldset id="first_login" class="result">
                <legend >情報登録</legend>
                <div id="result"></div>
            </fieldset>
            <div class="selectimg">
                写真選択:<input type="file" id="imgInput" name="photo">
                <div id="imgContainer"></div>
            </div>
            <button type="submit">更新</button>
        </form>
    </div>
    <div class="edit_table">
        <form id="edit_delete" action="edit_delete.php" method="GET">
            <button type="submit">削除</button>
        </form>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#searchForm').on('submit', function(event) {
                event.preventDefault();
                let searchNo = $('#searchNo').val();
                axios.get('edit_search.php', {
                    params: {
                    searchNo: searchNo
                    }
                })
                .then(function(response) {
                    $('#result').html(response.data);
                })
                .catch(function(error) {
                    $('#result').html('データの取得に失敗しました。');
                    console.error(error);
                });
            });
        });

        $('#edit_delete').on('submit', function(event) {
            event.preventDefault();
            let formDelet = $(this);
            let NoValue = $('#result input[name="No"]').val();

            if(NoValue) {
                $('<input>').attr({
                    name: 'No',
                    value: NoValue
                }).appendTo(formDelet);

                this.submit();
                alert('データが削除されました。');
            } else {
                alert('削除するデータが選択されていません。');
            }
        });

// 写真をテーブル内に配置
  $(document).ready(function(){
    $('#imgInput').on('change', function(event){
      let input = event.target;
      if (input.files && input.files[0]) {
        let reader = new FileReader();
        reader.onload = function(e) {
        $('#readimg').attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
      };
    });
  });


    </script>
</body>
</html>