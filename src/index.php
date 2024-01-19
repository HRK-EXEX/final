<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>トレ「ガ」ヂャー</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <div>
            <?php require 'header.html' ?>
            <div class="contents1">
                <div class="get-treasure">
                    <a href="game/">
                        <img class="bigImg" src="img/go.png" alt="宝箱を開ける(ガチャ)">
                    </a>
                </div>
                <div class="use-items">
                    <a href="items/">
                        <img class="bigImg" src="img/item.png" alt="アイテム使用">
                    </a>
                </div>
            </div>
            <div class="contents2">
                <div class="show-lineup">
                    <a href="lineup/">
                        <img class="smallImg" src="img/lineup.png" alt="宝物一覧を見る">
                    </a>
                </div>
                <div class="show-histories">
                    <a href="history/">
                        <img class="smallImg" src="img/history.png" alt="獲得履歴を見る">
                    </a>
                </div>
                <div class="others">
                    <a href="logout.php">
                        <?php
                            if(rand(0,19) != 0)
                                echo '<img class="smallImg" src="img/logout.png" alt="ログアウト">';
                            else
                                echo '<img class="smallImg" src="img/logeut.png" alt="ログヱウト">';
                        ?>
                    </a>
                </div>
            </div>
        </div>
    </body>
</html>