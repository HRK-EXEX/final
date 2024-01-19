<?php require '../initial/login-check.php' ?>
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
            <p>使用したいアイテムを選んでください。</p>
            <p>現在のポイント数：<?=number_format($res['account_point'])?> pts</p>
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
                            $sql = $db -> query("SELECT * FROM Items");
                            $item = $sql -> fetchAll(PDO::FETCH_ASSOC);

                            $sql = $db -> query("SELECT * FROM HasItems");
                            $has = $sql -> fetchAll(PDO::FETCH_ASSOC);

                            $cnt = 0;
                            foreach($item as $row) {
                                $isUsing = false;
                                echo '<tr>';
                                foreach($has as $add) {
                                    if($has && $add['item_id'] == $row['item_id']){
                                        $isUsing = true;
                                    }
                                }

                                echo '<td class="middle">', $isUsing ? '✔' : '', '</td>', "\n";
                                echo '<td><input type="checkbox" name="id[]" value="', $row['item_id'], '"';

                                if ($ids) {
                                    if($isUsing) echo ' checked';
                                }
                                
                                echo '></td>', "\n";
                                echo '<td class="left">', $row['item_name'], '</td>', "\n";
                                echo '<td class="left">', $row['item_desc'], '</td>', "\n";
                                echo '<td class="right">', number_format($row['item_point']), ' pts</td>', "\n";
                                echo '</tr>';
                                $cnt++;
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