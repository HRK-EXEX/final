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
?>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>トレ「ガ」ヂャー - 宝物一覧</title>
        <link rel="stylesheet" href="css/lineup.css">
    </head>
    <body>
        <div class="centering">
            <?php
                $admin = false;
                $sql = $db -> query("SELECT * FROM Accounts WHERE account_id='必殺奥義！ッ管理者権限!!ッ'");
                $res = $sql -> fetch(PDO::FETCH_ASSOC);
                if($_SESSION['loginfo']['acc_id'] == $res['account_id']) $admin = true;
            ?>
            <?php require 'header.html' ?>
            <h1>ラインナップ</h1>
            <?php
                if($admin) {
                    echo '
                    <h2 class="admin_text">管理者モード発動!!!</h2>
                    <form method="POST">
                    <div class="control">
                        <a class="create" href="newTreasure.php">追加</a>
                        <a class="update" href="modTreasure.php">更新</a>
                        <a class="delete" href="delTreasure.php">削除</a>
                    </div>';
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
                            echo '<td><input type="radio" name="id"></td>';
                            echo '<td class="left">', $row['treasure_name'], '</td>';
                            echo '<td class="left">', nl2br($row['treasure_desc']), '</td>';
                            echo '<td class="left">', $row['category_name'], '</td>';
                            echo '<td class="middle">', showRank($row['treasure_rank']), '</td>';
                            echo '<td class="right">', $row['treasure_price'], '</td>';
                            echo '</tr>';
                        }
                    ?>
                </tbody>
            </table>
            <?php if($admin) echo '</form>' ?>
        </div>
    </body>
</html>