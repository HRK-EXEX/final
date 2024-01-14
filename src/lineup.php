<?php session_start(); ?>
<?php require 'initial/db-connect.php' ?>
<!DOCTYPE html>

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
                $sql = $db -> query("SELECT * FROM Accounts WHERE account_nick='Administrator'");
                $res = $sql -> fetch(PDO::FETCH_ASSOC);
                if($_SESSION['loginfo']['acc_id'] == $res['account_id']) $admin = true;
            ?>
            <?php require 'header.html' ?>
            <h1>ラインナップ</h1>
            <?php
                if($admin) {
                    echo '
                    <h1 class="admin_text">管理者モード発動!!!</h1>
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
                        <th>宝の名前</th>
                        <th>説明</th>
                        <th>ランク</th>
                        <th>値段</th>
                        <!-- <th>カテゴリ</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = $db -> query("SELECT * FROM Treasures");
                        $res = $sql -> fetchAll(PDO::FETCH_ASSOC);

                        foreach($res as $row) {
                            echo '<tr>';
                            echo '<td>', $row['treasure_name'], '</td>';
                            echo '<td>', $row['treasure_desc'], '</td>';
                            echo '<td>', $row['treasure_rank'], '</td>';
                            echo '<td>', $row['treasure_price'], '</td>';
                            // echo '<td>', $row['treasure_ctgr'], '</td>';
                            echo '</tr>';
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </body>
</html>