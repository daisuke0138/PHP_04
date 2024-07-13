<?php
session_start();
include("functions.php");
check_session_id();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/menu.css">
    <title>menu</title>
</head>
<body>
    <h2>ようこそ <?= $_SESSION['name'] ?> さん</h2>
    <button class="button" type="button" id="logoutbt" onclick="window.location.href='menberlist.php'">登録一覧</button>
    <button class="button" type="button" id="logoutbt" onclick="window.location.href='edit.php'">登録情報編集</button>
    <button class="button" type="button" id="logoutbt" onclick="window.location.href='Report.php'">Report</button>
    <button class="button" type="button" id="logoutbt" onclick="window.location.href='logout.php'">logout</button>
</body>
</html>
