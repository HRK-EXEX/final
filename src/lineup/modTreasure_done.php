<?php require '../initial/login-check.php' ?>
<?php require '../initial/db-connect.php' ?>
<?php require '../initial/unitNumberJP.php' ?>
<!DOCTYPE html>
<?php
    $name = $_POST['name'] ?? null;
    $desc = $_POST['desc'] ?? null;
    $rank = $_POST['rank'] ?? null;
    $price = $_POST['price'] ?? null;
    $ctgr = $_POST['ctgr'] ?? null;
?>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>トレ「ガ」ヂャー - 財宝情報変更完了</title>
        <link rel="stylesheet" href="../css/control.css">
    </head>
    <body onload="previewRank()">
        <div class="centering">
            <h1>財宝情報変更完了</h1>
            <form action="index.php">
                <input id="rank" type="hidden" value="<?=$rank?>">
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
                <p class="done">
                    財宝情報が正常に変更されました。<br>
                    ラインナップにてご確認ください。
                </p>
                <button class="go">戻る</button>
            </form>
        </div>

        <script src="js/script.js"></script>
    </body>
</html>