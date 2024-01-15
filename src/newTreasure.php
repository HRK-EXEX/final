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
        <title>トレ「ガ」ヂャー - 宝物一覧</title>
        <link rel="stylesheet" href="css/control.css">
    </head>
    <body>
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
                                id="rank"  onInput="previewRank()"
                                min='0'><br>
                                &nbsp;プレビュー：<span id="previewZone"></span>
                            </td>
                        </tr>
                        <tr><th>値段</th><td><input type="text" name="price" value="<?=$price?>" onInput="value = value.replace(/[^0-9]+/i,'');"></td></tr>
                        <tr>
                            <th>
                                カテゴリ<br>
                                <?php
                                    echo '<input type="radio" name="sel" value="0" onInput="zone(0)" >既存選択';
                                    echo '<input type="radio" name="sel" value="1" onInput="zone(1)" >新規登録';
                                ?>
                                <span id="variable"><span>
                            </th>
                            <td><input type="text" name="ctgr" value="<?=$ctgr?>"></td>
                        </tr>
                    </tbody>
                </table><br>
                <br>
                <?php
                    $err = $_GET['err'] ?? null;
                    switch ($err) {
                        case '1':
                            echo 'すでに同じ名前の財宝があります。<br>';
                            break;
                        case '2':
                            echo 'すでに同じ名前のカテゴリがあります。<br>';
                            break;
                    }
                ?>
                <button class="go">登録する</button>
            </form>
        </div>

        <script src="js/script.js"></script>
        <script>
            function zone(type){
                type = parseInt(type);
                var zone = document.getElementById('variable');
                var str = "";
                <?php
                    switch(type){
                        case 0:
                            foreach($ctgries as $contents){
                                echo 'str += ', $contents['category_name'];
                            }

                    }
                ?>
            }
        </script>
    </body>
</html>