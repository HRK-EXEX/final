<?php require '../initial/login-check.php' ?>
<?php require '../initial/db-connect.php' ?>
<?php
    $sql = $db -> query('SELECT * FROM HasItems');
    $has = $sql -> fetchAll(PDO::FETCH_ASSOC);
    
    $inside = [-1, -1, -1]; $item_cnt = 1;
    $rankLeast = 0; $allopen = false; $xray = false;
    foreach($has as $item) {
        switch($item['item_id'])
        {
            case 1:
                $item_cnt = 2;
                break;
            case 2:
                $item_cnt = 3;
                break;
            case 3:
                $item_cnt = 3;
                $rankLeast = 3;
                break;
            case 4:
                $allopen = true;
                break;
            case 5:
                $xray = true;
                break;
            case 6:
                // header("Location: select.php");
                break;
        }
    }

    for($i=0; $i<$item_cnt; $i++) {
        $sql = $db -> prepare('SELECT * FROM Treasures WHERE treasure_rank > ?');
        $sql -> execute([$rankLeast]);
        $tres = $sql -> fetchAll(PDO::FETCH_ASSOC);

        if($item_cnt != 3) {
            if($i != 1) {
                $rndId = rand(0, 2);
                $inside[$rndId] = $tres[rand(0, count($tres))]['treasure_id'];
                $prev = $i;
            } else {
                do {
                    $rndId = rand(0, 2);
                }
                while($prev == $rndId);
                $inside[$rndId] = $tres[rand(0, count($tres))]['treasure_id'];
            }
        } else {
            $inside[$i] = rand(0, count($tres));
        }
    }
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
        <?php require '../header.html' ?>

        <form action="result.php" name="what" method="post">
            <div class="centering">
                <h1>
                    この中にあたりの宝箱は<br>
                    「<?=$item_cnt?>つ」あります。<br>
                    好きな宝箱を選んでね！
                </h1>

                <div class="guesser">
                    <input type="radio" name="box" id="box1" value="<?=$inside[0]?>">
                    
                    <label for="box1">
                        <img class="box" src="../img/boxClosed.png">
                    </label>
                    
                    <input type="radio" name="box" id="box2" value="<?=$inside[1]?>">
                    
                    <label for="box2">
                        <img class="box" src="../img/boxClosed.png">
                    </label>
                    
                    <input type="radio" name="box" id="box3" value="<?=$inside[2]?>">
                    
                    <label for="box3">
                        <img class="box" src="../img/boxClosed.png">
                    </label>
                </div>

                <button class="go" onclick="javascript:what.submit();">開ける</button>&emsp;
            </div>
        </form>
    </body>
</html>