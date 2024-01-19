<?php require '../initial/login-check.php' ?>
<?php require '../initial/db-connect.php' ?>
<?php require '../initial/unitNumberJP.php' ?>

<?php
    $resultId = $_POST['box'] ?? -2;
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>トレ「ガ」ヂャー - 結果発表！！</title>
        <link rel="stylesheet" href="../css/main.css">
    </head>
    <body>
        <?php require '../header.html' ?>
        
        <div class="centering">
        <?php
            if($resultId == -1) {
                $message = "残念！はずれ！";
            } else if($resultId >= 0) {
                $sql = $db -> prepare("SELECT * FROM Treasures WHERE treasure_id = ?");
                $sql -> execute([$resultId]);
                $res = $sql -> fetch(PDO::FETCH_ASSOC);
                
                $message = "あたり！おめでとう！<br>獲得したお宝は「".$res['treasure_name']."」<br>（ランク".showRank($res['treasure_rank'])."）だよ！";

                $sql = $db -> prepare("INSERT INTO Histories VALUE (?, ?)");
                $sql -> execute([$_SESSION['loginfo']['acc_id'], $resultId]);
            } else {
                $message = "謎のエラーです。";
            }
        ?>
        <div>

        <h1><?=$message?></h1>
        <button class="go" onclick="location.href='../index.php'">トップ画面へ戻る</button>
    </body>
</html>