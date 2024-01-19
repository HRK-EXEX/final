<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>トレ「ガ」ヂャー - ログイン</title>
        <link rel="stylesheet" href="css/login.css">
    </head>
    <body>
        <div class="master-box">
            <div>
                <?php require 'headerTitleNoLink.html' ?>
                <form action="logging.php" method="post">
                    
                    <?php
                        $id = $_POST['id'] ?? null;
                        $pswd = $_POST['pswd'] ?? null;

                        $err = $_GET['err'] ?? null;
                        switch ($err) {
                            case '1':
                                echo 'アカウント名またはパスワードが一致しません。<br>';
                                break;
                            case '2':
                                echo '謎のエラーです。<br>';
                                break;
                        }
                    ?>
                    <br>

                    <input class="text" name="id" type="text" required placeholder="アカウントID" value="<?=$id?>"><br>
                    <input class="text" name="pswd" type="password" required placeholder="パスワード" value="<?=$pswd?>"><br>
                    <button class="go" type="submit">入場する</button><br>
                </form>

                <p><br>↓アカウントをお持ちでない方↓</p>
                <button class="go" onclick="location.href='submit.php'">入場準備</button>
            </div>
        </div>
    </body>
</html>