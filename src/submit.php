<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>トレ「ガ」ヂャー - 新規登録</title>
        <link rel="stylesheet" href="css/submit.css">
    </head>
    <body>
        <div class="master-box">
            <div>
                <?php require 'headerNoLink.html' ?>
                <form action="submitting.php" method="post">
                    <img src="img/submit.png" alt="新規登録"><br><br>

                    <?php
                        $id = $_POST['id'] ?? null;
                        $name = $_POST['name'] ?? null;
                        $pswd = $_POST['pswd'] ?? null;

                        $err = $_GET['err'] ?? null;
                        switch ($err) {
                            case 1:
                                echo 'そのアカウントIDはすでに使用されています。<br>';
                                break;
                        }
                    ?>

                    <input class="text" type="text" name="id" placeholder="アカウントID" required><br>
                    <input class="text" type="text" name="name" placeholder="アカウント名" required><br>
                    <input class="text" type="password" name="pswd" placeholder="パスワード" required><br>
                    <button class="go" type="button" onclick="history.back();">戻る</button>&emsp;
                    <button class="go">登録する</button><br>
                </form>
            </div>
        </div>
    </body>
</html>