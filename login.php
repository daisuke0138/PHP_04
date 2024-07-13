<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
<form action="login_act.php" method="POST">
    <fieldset id="login_area" class="login">
        <legend >Company page login</legend>
        <table class="contact-table">
            <tr>
                <th >社員番号</th>
                <td >
                    <input type="number" id="No" name="No" placeholder="">
                </td>
            </tr>
                        <tr>
                <th >氏名</th>
                <td >
                    <input type="text" id="name" name="name" placeholder="">
                </td>
            </tr>
            <tr>
                <th >Pass</th>
                <td >
                    <input id="inputpass" type="password" name="pass" placeholder="英数小,大文字8～12桁">
                </td>
            </tr>
        </table>
        <div class="submitarea">
            <button class="button1" type="submit" id="tologinbt">login</button>
        </div>
    </fieldset>
</form>

</body>
</html>

<!-- var_dump($result);
exit(); -->
