<?php require '../initial/login-check.php' ?>
<?php require '../initial/db-connect.php' ?>
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
        <title>トレ「ガ」ヂャー - 財宝情報編集</title>
        <link rel="stylesheet" href="../css/control.css">
    </head>
    <body onload="previewRank(); zone(0)">
        <div class="centering">
            <h1>財宝情報編集</h1>
            <form action="modTreasure_process.php?id=<?=$id?>" method="post">
                <table>
                    <tbody>
                        <tr><th>宝の名前</th><td><input type="text" name="name" value="<?=$name?>"></td></tr>
                        <tr><th>説明</th><td><textarea type="text" name="desc"><?=$desc?></textarea></td></tr>
                        <tr>
                            <th>ランク</th><td>
                                <input type="number" name="rank" value="<?=$rank?>"
                                id="rank" oninput="previewRank()"
                                min='0'><br>
                                プレビュー：<span id="previewZone"></span>
                            </td>
                        </tr>
                        <tr><th>値段</th><td><input type="text" name="price" value="<?=$price?>" oninput="value = value.replace(/[^0-9]+/i,'');"></td></tr>
                        <tr>
                            <th>
                                カテゴリ<br>
                                <?php
                                    echo '<input type="radio" name="sel" value="0" oninput="zone(0)" checked><span>既存選択</span><br>', "\n";
                                    echo '<input type="radio" name="sel" value="1" oninput="zone(1)"><span>新規登録</span>', "\n";
                                ?>
                            </th>
                            
                            <td id="variable">
                            </td>
                        </tr>
                    </tbody>
                </table>
                <p class="warning">
                    <?php
                        $err = $_GET['err'] ?? null;
                        switch ($err) {
                            case '1':
                                echo 'エラー: 既存のカテゴリは新規登録できません。<br><br>';
                                break;
                        }
                    ?>
                    以上の変更を確定します。<br>
                    よろしいですか？<br>
                </p>
                <button class="go" type="button" onclick="history.back();">戻る</button>&emsp;
                <button class="go">登録する</button>
            </form>
        </div>

        <script src="js/script.js"></script>
        <script>
            function zone(type){
                type = parseInt(type);
                var zone = document.getElementById('variable');
                var str = "";
                
                switch(type){
                    case 0:
                        str += '<select name="ctgr" required>';
                        /*  
                            ここだけ複雑なことをしてるので解説。
                            JS側でstr変数に代入する前に、
                            PHPの埋め込み機能を使って値を反映。
                            JS側で反映された値を使って代入という文を、
                            foreachで各値ごとに出力→実行。
                            この処理を実行するのにフレームワークを使うと
                            どれだけ快適になるんでしょうかね？

                            str += '<option value="[PHP側の値]" if()>[PHP側の値]</option>
                        */
                        <?php
                            foreach($ctgries as $contents){
                                echo 'str += \'<option value="',
                                     $contents['category_name'],
                                     '"';
                                if ($contents['category_name'] == $ctgr) {
                                    echo ' selected';
                                }
                                echo '>',
                                     $contents['category_name'],
                                     "';\n";
                            }
                        ?>
                        str += "</select>";
                        break;
                    case 1:
                        str += '<input type="text" name="ctgr" value="<?=$ctgr?>">';
                        break;
                }

                zone.innerHTML = str;
            }
        </script>
    </body>
</html>