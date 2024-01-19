<?php session_start(); ?>
<?php require '../initial/db-connect.php' ?>
<?php
    $sql = $db -> prepare('SELECT * FROM Accounts WHERE account_id=?');
    $sql -> execute([$_SESSION['loginfo']['acc_id']]);
    $res = $sql -> fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>トレ「ガ」ヂャー - 獲得履歴</title>
        <link rel="stylesheet" href="../css/items.css">
    </head>
    <body>
        <div class="centering">
            <?php require '../header.html' ?>
            <h1>獲得履歴</h1>
            <?php
                $ids = $_POST['id'] ?? null;
                $err = $_GET['err'] ?? 0;
                const ERR_TXT = [
                    null,
                    'エラー: アイテムが指定されていません。',
                    'エラー: ポイント不足です。',
                    'エラー: アイテムを持っていないので、破棄することができません。',
                ];
                echo '<p>', ERR_TXT[$err], '</p>';
            ?>
            <?php
                $sql = $db -> query("SELECT * FROM Treasures");
                $tres = $sql -> fetchAll(PDO::FETCH_ASSOC);

                $sql = $db -> query("SELECT * FROM Histories");
                $his = $sql -> fetchAll(PDO::FETCH_ASSOC);

                $variation = [2];
                $variation[0] = []; // It's for name
                $variation[1] = []; // It's for counter

                if($his) {
                    echo '<table>
                    <thead>
                        <tr>
                            <th>獲得した宝</th>
                            <th>回数</th>
                        </tr>
                    </thead>
                    <tbody>';
                    foreach($his as $row) {
                        $name = $tres[$row['treasure_id']]['treasure_name'];
                        $cnt = 0;
                        foreach($tres as $treasure) {
                            if($name == $treasure['treasure_name']) {
                                $cnt++;
                            }
                        }

                        echo '<tr>';
                        echo '<td class="left">', $name, '</td>', "\n";
                        echo '<td class="right">', $cnt, ' 回</td>', "\n";
                        echo '</tr>';
                    }
                    echo '</tbody>
                    </table><br>';
                } else {
                    echo '獲得履歴がありません。';
                }
            ?> 
        </div>
    </body>
</html>