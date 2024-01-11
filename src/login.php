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
                <?php
                    
                ?>
                <form action="logging.php" method="post">
                    <img src="img/title.png" alt="トレ「ガ」ヂャー"><br><br>
                    <input class="text" name="id" type="text" required placeholder="アカウントID"><br>
                    <input class="text" name="pass" type="password" required placeholder="パスワード"><br>
                    <button>入場する</button><br>
                </form>

                <p><br>↓アカウントをお持ちでない方↓</p>
                <button onclick="location.href='submit.html'">入場準備</button>
            </div>
        </div>
    </body>
</html>