<?php session_start(); ?>
<?php require '../initial/db-connect.php' ?>
<?php require '../initial/unitNumberJP.php' ?>
<?php
    $ranklist = "EDCBAS";
    $id = $_GET['id'] ?? null;

    if($id != null)
        $sql = $db -> query("SELECT * FROM Treasures LEFT JOIN Categories
        ON Treasures.treasure_ctgr = Categories.category_id WHERE treasure_id=$id");
    else
        header("Location: index.php?err=1");

    $res = $sql -> fetch(PDO::FETCH_ASSOC);
    
    function showRank(string $rank) {
        global $ranklist;
        if ($rank < mb_strlen($ranklist)) {
            return $ranklist[$rank];
        }
        return $ranklist[4].strval($rank-4);
    }

    $name = $_POST['name'] ?? $res['treasure_name'] ?? null;
    $desc = $_POST['desc'] ?? $res['treasure_desc'] ?? null;
    $rank = $_POST['rank'] ?? $res['treasure_rank'] ?? null;
    $price = $_POST['price'] ?? $res['treasure_price'] ?? null;
    $ctgr = $_POST['ctgr'] ?? $res['category_name'] ?? null;

    $sql = $db -> query('SELECT * FROM Categories');
    $ctgries = $sql -> fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>トレ「ガ」ヂャー - 財宝情報削除</title>
        <link rel="stylesheet" href="../css/control.css">
    </head>
    <body onload="previewRank()">
        <div class="centering">
            <h1>財宝情報削除確認</h1>
            <form action="delTreasure_process.php?id=<?=$id?>" method="post">
                <input type="hidden" name="id" value="<?=$id?>">
                <input type="hidden" name="name" value="<?=$name?>">
                <input type="hidden" name="desc" value="<?=$desc?>">
                <input type="hidden" name="rank" value="<?=$rank?>" id="rank">
                <input type="hidden" name="price" value="<?=$price?>">
                <input type="hidden" name="ctgr" value="<?=$ctgr?>">

                <table>
                    <tbody>
                        <tr><th>宝の名前</th><td><?=$name?></td></tr>
                        <tr><th>説明</th><td><?=nl2br($desc)?></td></tr>
                        <tr>
                            <th>ランク</th>
                            <td>
                                <span id="previewZone"></span>
                            </td>
                        </tr>
                        <tr><th>値段</th><td><?=unitNumberJP($price, 4)?>円</td></tr>
                        <tr><th>カテゴリ<br></th><td><?=$ctgr?></td>
                        </tr>
                    </tbody>
                </table>
                <p class="warning">
                    <?php
                        $err = $_GET['err'] ?? null;
                        switch ($err) {
                            case '1':
                                echo 'エラー: すでに削除されています。<br><br>';
                                break;
                        }
                    ?>
                    以上の財宝情報を削除します。<br>
                    この操作は取り消すことができません。<br>
                    本当によろしいですか？<br>
                </p>
                <button class="go" type="button" onclick="history.back();">戻る</button>&emsp;
                <button class="go">削除する</button>
            </form>
        </div>

        <script src="js/script.js"></script>
    </body>
</html>