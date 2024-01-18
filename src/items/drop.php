<?php session_start(); ?>
<?php require '../initial/db-connect.php' ?>
<?php
    // 初期化
    $ids = $_POST['id'] ?? null;

    $sql = $db -> prepare('SELECT * FROM Accounts WHERE account_id=?');
    $sql -> execute([$_SESSION['loginfo']['acc_id']]);
    $acc = $sql -> fetch(PDO::FETCH_ASSOC);

    $sql = $db -> query('SELECT * FROM Items');
    $item = $sql -> fetchAll(PDO::FETCH_ASSOC);

    $sql = $db -> prepare('SELECT * FROM HasItems WHERE account_id=?');
    $sql -> execute([$_SESSION['loginfo']['acc_id']]);
    $has = $sql -> fetchAll(PDO::FETCH_ASSOC);

    if(empty($ids)) { // 選択されていないとき、エラー表示
        header('Location: index.php?err=1', true, 307);
        exit();
    }

    // アイテムを1つも持っていないとき、エラー表示
    if(empty($has)) {
        header('Location: index.php?err=3', true, 307);
        exit();
    }

    $cnt = 0;
    foreach($ids as $id) {

        $current = intval($acc['account_point']);
        $target = intval($item[$id-1]['item_point']);

        // ポイント処理
        $do = false;
        foreach($has as $as) {
            if($as['item_id'] == $id) $do = true;
            if($do) {
                $sql = $db -> prepare('UPDATE Accounts SET account_point=? WHERE account_id=?');
                $sql -> execute([$current + $target, $_SESSION['loginfo']['acc_id']]);
                break; 
            }
        }

        // アイテム削除
        $sql = $db -> prepare('DELETE FROM HasItems WHERE account_id=? AND item_id=?');
        $sql -> execute([$_SESSION['loginfo']['acc_id'], $id]);

        header('Location: index.php', true, 307);
    }
?>