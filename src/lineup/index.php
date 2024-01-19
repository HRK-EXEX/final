<?php require '../initial/login-check.php' ?>
<?php require '../initial/db-connect.php' ?>
<?php require '../initial/unitNumberJP.php' ?>
<?php
    $ranklist = "EDCBAS";
    function showRank(string $rank) {
        global $ranklist;
        if ($rank < mb_strlen($ranklist)) {
            return $ranklist[$rank];
        }
        return $ranklist[5].strval($rank-4);
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>トレ「ガ」ヂャー - 宝物一覧</title>
        <link rel="stylesheet" href="../css/lineup.css">
    </head>
    <body>
        <div class="centering">
            <?php
                $admin = false;
                $sql = $db -> query("SELECT * FROM Accounts WHERE account_id='必殺奥義！ッ管理者権限!!ッ'");
                $res = $sql -> fetch(PDO::FETCH_ASSOC);
                if($_SESSION['loginfo']['acc_id'] == $res['account_id']) $admin = true;
            ?>
            <?php require '../header.html' ?>
            <h1>ラインナップ</h1>
            <?php
                if($admin) {
                    echo '
                    <h2 class="admin_text">管理者モード発動!!!</h2>
                    <form action="?" name="dataform" method="GET">
                    <div class="control">
                    <button class="create" formaction="newTreasure.php">追加</button>
                    <button class="update" formaction="modTreasure.php">更新</button>
                    <button class="delete" formaction="delTreasure.php">削除</button>
                    <a class="deletectgr" href="delCategory.php">カテゴリ削除</a>
                    </div>
                    ';
                }
            ?>
            <?php
                $err = $_GET['err'] ?? null;
                switch ($err) {
                    case '1':
                        echo 'エラー: 財宝が指定されていません。<br>';
                        break;
                }
            ?>
            <table>
                <thead>
                    <tr>
                        <th>選択</th>
                        <th>宝の名前</th>
                        <th>説明</th>
                        <th>カテゴリ</th>
                        <th>ランク</th>
                        <th>値段</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = $db -> query(
                            "SELECT * FROM Treasures LEFT JOIN Categories
                             ON Treasures.treasure_ctgr = Categories.category_id"
                        );
                        $res = $sql -> fetchAll(PDO::FETCH_ASSOC);

                        foreach($res as $row) {
                            echo '<tr>';
                            echo '<td><input type="radio" name="id" value="', $row['treasure_id'], '"';
                            if ($row['treasure_id'] == 1) echo ' checked';
                            echo '></td>';
                            echo '<td class="left">', $row['treasure_name'], '</td>';
                            echo '<td class="left">', nl2br($row['treasure_desc']), '</td>';
                            echo '<td class="left">', $row['category_name'], '</td>';
                            echo '<td class="middle">', showRank($row['treasure_rank']), '</td>';
                            echo '<td class="right">', unitNumberJP($row['treasure_price'], 4), '円</td>';
                            echo '</tr>';
                        }
                    ?>
                </tbody>
            </table>
            <?php if($admin) echo '</form>' ?>
        </div>
    </body>
</html>