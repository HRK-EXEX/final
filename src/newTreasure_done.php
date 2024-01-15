<?php session_start(); ?>
<?php require 'initial/db-connect.php' ?>
<!DOCTYPE html>

<?php
    $ranklist = "EDCBAS";
    function showRank(string $rank) {
        global $ranklist;
        if ($rank < mb_strlen($ranklist)) {
            return $ranklist[$rank];
        }
        return $ranklist[4].strval($rank-4);
    }

    $name = $_POST['name'] ?? null;
    $sql = $db -> prepare('SELECT * FROM Treasures WHERE treasure_name=?');
    $sql -> execute([$name]);
    $res = $sql -> fetch(PDO::FETCH_ASSOC);

    $name = $res['name'] ?? null;
    $desc = $res['desc'] ?? null;
    $rank = $res['rank'] ?? null;
    $price = $res['price'] ?? null;
    $ctgr = $res['ctgr'] ?? null;
?>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>トレ「ガ」ヂャー - 宝物一覧</title>
        <link rel="stylesheet" href="css/control.css">
    </head>
    <body>
        <div class="centering">
            <h1>新規財宝登録完了</h1>
            <form action="lineup.php">
                <table>
                    <tbody>
                        <tr><th>宝の名前</th><td><?=$name?></td></tr>
                        <tr><th>説明</th><td><?=$desc?>/td></tr>
                        <tr><th>ランク</th><td><span id="previewZone"></span></td></tr>
                        <tr><th>値段</th><td><?=$price?></td></tr>
                        <tr><th>カテゴリ</th><td><?=$ctgr?></td></tr>
                    </tbody>
                </table><br>
                <br>
                <button class="go">戻る</button>
            </form>
        </div>

        <script src="js/script.js"></script>
    </body>
</html>