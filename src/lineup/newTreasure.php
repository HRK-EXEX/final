<?php require '../initial/login-check.php' ?>
<?php require '../initial/db-connect.php' ?>
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
    $desc = $_POST['desc'] ?? null;
    $rank = $_POST['rank'] ?? null;
    $price = $_POST['price'] ?? null;
    $ctgr = $_POST['ctgr'] ?? null;

    $sql = $db -> query('SELECT * FROM Categories');
    $ctgries = $sql -> fetchAll(PDO::FETCH_ASSOC);
?>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>トレ「ガ」ヂャー - 新規財宝登録</title>
        <link rel="stylesheet" href="../css/control.css">
    </head>
    <body onload="zone(0)">
        <div class="centering">
            <h1>新規財宝登録</h1>
            <form action="newTreasure_process.php" method="post">
                <table>
                    <tbody>
                        <tr><th>宝の名前</th><td><input type="text" name="name" value="<?=$name?>"></td></tr>
                        <tr><th>説明</th><td><textarea type="text" name="desc"><?=$desc?></textarea></td></tr>
                        <tr>
                            <th>ランク</th><td>
                                <input type="number" name="rank" value="<?=$rank?>"
                                id="rank" onInput="previewRank()"
                                min='0'><br>
                                プレビュー：<span id="previewZone"></span>
                            </td>
                        </tr>
                        <tr><th>値段</th><td><input type="text" name="price" value="<?=$price?>" onInput="value = value.replace(/[^0-9]+/i,'');"></td></tr>
                        <tr>
                            <th>
                                カテゴリ<br>
                                <?php
                                    echo '<input type="radio" name="sel" value="0" onInput="zone(0)" checked><span>既存選択</span><br>', "\n";
                                    echo '<input type="radio" name="sel" value="1" onInput="zone(1)"><span>新規登録</span>', "\n";
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
                                echo 'エラー: 既存の財宝は新規登録できません。<br><br>';
                                break;
                            case '2':
                                echo 'エラー: 既存のカテゴリは新規登録できません。<br><br>';
                                break;
                        }
                    ?>
                    以上の財宝情報を登録します。<br>
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
                            反映された値を使って代入という流れを、
                            foreachで各値ごとに実行。
                            この処理を実行するのにフレームワークを使うと
                            どれだけ快適になるんでしょうかね？

                            str += '<option value="[PHP側の値]" >[PHP側の値]</option>
                        */
                        <?php
                            foreach($ctgries as $contents){
                                echo 'str += \'<option value="',
                                     $contents['category_name'],
                                     '" >', $contents['category_name'],
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