<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>top</title>
    <link rel="stylesheet" href="./css/top.css">
</head>
<body>
    <form>
        <fieldset id="top_area" class="top_area">
        <legend >Company page login</legend>
        <div>
            <button class="button1" type="button" id="regist">登録画面へ</button>
        </div>
        <div>
            <button class="button1" type="button" id="loginbt1" >login画面へ</button>
            <a id="Tologin" href="login.php"></a>
        </div>
    </fieldset>
    </form>

    <form id="logindata" class="logindata" action="top_create.php" method=POST>
        <fieldset id="first_login" class="first_login" style="display: none;">
        <legend >初回登録</legend>
        <table class="contact-table">
            <tr>
                <th >社員番号</th>
                <td >
                    <input type="number" name="No" placeholder="">
                </td>
            </tr>
            <tr>
                <th >氏名</th>
                <td >
                    <input type="text" name="name">
                </td>
            </tr>
            <tr>
                <th >Pass</th>
                <td >
                    <input id="inputpass" type="text" name="pass" placeholder="英数小,大文字8～12桁">
                </td>
            </tr>
            <tr>
                <th >Pass確認</th>
                <td >
                    <input id="checkpass" type="password"  name="checkpass" placeholder="パスワード入力">
                </td>
            </tr>
        </table>
        <div class="submitarea">
            <button class="button1" type="submit" id="tologinbt2" href="login.php">登録</button>
        </div>
        <div id="errormesseage" style="display: none;" class="errormesseage">
            <p>パスワードが違います！</p>
        </div>
        </fieldset>
    </form>
    <div id="dialog-confirm" style="display: none;" class="dialogarea">
        <p>入力内容を保存しますか？</p>
        <div>
            <button class="sendbt" id="sendbt" type=button >OK</button>
            <button class="sendbt" id="cancelbt" type=button >キャンセル</button>
        </div>
    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
$(document).ready(function () {
    $('#regist').click(function () {
        $("#top_area").hide();
        $("#first_login").show();
    });
});

$(document).ready(function () {
    $("#loginbt1").click(function () {
        window.location.href = $("#Tologin").attr("href");
    });
});

$(document).ready(function () {
    $('#logindata').on('submit', function (event) {
        event.preventDefault(); // Prevent default form submission

        // Fetch input values
        let pass = $('#inputpass').val();
        let checkPass = $('#checkpass').val();
        // Compare the values
        if (pass === checkPass) {
            $("#dialog-confirm").show(); // Show the dialog
            // OK button
            $('#sendbt').click(function () {
                $('#logindata').off('submit').submit(); // Submit the form
            alert("パスワードを登録しました");
            });
            // Cancel button
            $('#cancelbt').click(function () {
                $("#dialog-confirm").hide(); // Hide the dialog
                $('#inputpass').val(''); // Clear the input fields
                $('#checkpass').val('');
            });

        } else {
            // Values don't match
            $('.errormesseage').show();
            setTimeout(function () {
                $('.errormesseage').hide();
            }, 2000); // Show error message div
            return false; // Prevent form submission
        }
    });
});
</script>
</body>
</html>

        <!-- <a href="todo_read.php">一覧画面</a> -->