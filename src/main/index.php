<?php require '../initial/login-check.php' ?>
<?php require '../initial/db-connect.php' ?>
<?php
    $sql = $db -> prepare('SELECT * FROM Items');
    $sql -> execute([$_SESSION['loginfo']['acc_id']]);
    $items = $sql -> fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>トレ「ガ」ヂャー - 宝箱を選べ！！</title>
        <link rel="stylesheet" href="../css/main.css">
    </head>
    <body>
        <link rel="stylesheet" href="https://aso2201185.tonkotsu.jp/php2/final/src/css/titlebar.css">
        <div class="titlebar">
            <a href="https://aso2201185.tonkotsu.jp/php2/final/src/index.php">
                <img src="https://aso2201185.tonkotsu.jp/php2/final/src/img/title.png" alt="トレ「ガ」ヂャー" style="width: auto; height: 15vh;">
            </a>
        </div>
        <?php

        ?>
        <form action="judge.php" name="what" method="post">
            <div class="centering">
                <h1>
                    この中にあたりの宝箱は<br>
                    「１つ」あります。<br>
                    好きな宝箱を選んでね！
                </h1>
                <div class="guesser">
                    <input type="radio" name="box" id="box1" value="1">
                    
                    <label for="box1">
                        <img class="box" src="../img/boxClosed.png" onclick="javascript:what.submit();">
                    </label>
                    
                    <input type="radio" name="box" id="box2" value="2">
                    
                    <label for="box2">
                        <img class="box" src="../img/boxClosed.png" onclick="javascript:what.submit();">
                    </label>
                    
                    <input type="radio" name="box" id="box3" value="3">
                    
                    <label for="box3">
                        <img class="box" src="../img/boxClosed.png" onclick="javascript:what.submit();">
                    </label>
                </div>
                
                <p class="text">クリック・タップすると自動的に推移します。</p>
            </div>
        </form>
    </body>
</html>