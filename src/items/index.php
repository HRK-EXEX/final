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
        <title>トレ「ガ」ヂャー - アイテム一覧</title>
        <link rel="stylesheet" href="../css/items.css">
    </head>
    <body>
        <div class="centering">
            <?php require '../header.html' ?>
            <h1>アイテム一覧</h1>
            <?php
                $err = $_GET['err'] ?? null;
                switch ($err) {
                    case '1':
                        echo 'エラー: アイテムが指定されていません。<br>';
                        break;
                }
            ?>
            <p>使用したいアイテムを選んでください。</p>
            <p>現在のポイント数：<?=number_format($res['account_point'])?></p>
            <form action="?" method="post">
                <table>
                    <thead>
                        <tr>
                            <th>状態</th>
                            <th>選択</th>
                            <th>アイテム名</th>
                            <th>説明</th>
                            <th>必要ポイント数</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql = $db -> query(
                                "SELECT * FROM Items LEFT JOIN HasItems
                                ON Items.item_id = HasItems.item_id"
                            );
                            $left = $sql -> fetchAll(PDO::FETCH_ASSOC);

                            $sql = $db -> query(
                                "SELECT * FROM Items RIGHT JOIN HasItems
                                ON Items.item_id = HasItems.item_id
                                WHERE account_id='".$_SESSION['loginfo']['acc_id']."'"
                            );
                            $right = $sql -> fetchAll(PDO::FETCH_ASSOC);

                            foreach($left as $row) {
                                $isUsing = false;
                                echo '<tr>';
                                if($right){

                                }

                                echo '<td class="middle">', $isUsing ? '✔' : '', '</td>';
                                echo '<td><input type="radio" name="id" value="', $row['item_id'], '"';
                                if ($row['item_id'] == 1) echo ' checked';
                                echo '></td>';
                                echo '<td class="left">', $row['item_name'], '</td>';
                                echo '<td class="left">', $row['item_desc'], '</td>';
                                echo '<td class="right">', number_format($row['item_point']), ' pts</td>';
                                echo '</tr>';
                            }
                        ?>
                    </tbody>
                </table><br>
                <button class="go" formaction="drop.php">破棄する</button>&emsp;
                <button class="go" formaction="using.php">使用する</button>
            </form>
        </div>
    </body>
</html>