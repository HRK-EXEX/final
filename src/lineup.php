<?php require 'initial/db-connect.php' ?>
<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>トレ「ガ」ヂャー - 宝物一覧</title>
    </head>
    <body>
        <?php
            $admin = false;
            if($_COOKIE['loginfo']['pswd'] == '必殺奥義！ッ管理者権限!!ッ') $admin = true;
        ?>
        <h1>ラインナップ</h1>
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
    </body>
</html>