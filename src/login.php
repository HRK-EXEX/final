<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>トレ「ガ」ヂャー - ログイン</title>
        <link rel="stylesheet" href="css/index.css">
    </head>
    <body>
        <div class="master-box">
            <div>
                <form action="logging.php" method="post">
                    <img src="img/title.png" alt="トレ「ガ」ヂャー"><br>
                    
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
                    <button type="submit">入場する</button><br>
                </form>

                <p><br>↓アカウントをお持ちでない方↓</p>
                <button onclick="location.href='submit.html'">入場準備</button>
            </div>
        </div>
    </body>
</html>