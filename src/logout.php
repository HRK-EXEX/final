<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>トレ「ガ」ヂャー - ログイン</title>
        <link rel="stylesheet" href="css/logout.css">
    </head>
    <body>
        <div class="master-box">
            <?php require 'header.html' ?>
            <div>
                <p class="text">ログアウトしますか？</p>

                <div class="buttons">
                    <button class="go" onclick="history.back();">戻る</button>&emsp;
                    <button class="go" onclick="location.href='seeyou.php'">退場する</button>
                </div>
            </div>
        </div>
    </body>
</html>