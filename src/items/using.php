<?php session_start(); ?>
<?php require '../initial/db-connect.php' ?>
<?php
    // 初期化
    $ids = $_POST['id'] ?? null;
    // var_dump($ids);

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

    $cnt = 0; $needPoints = 0;
    foreach($ids as $id) { 
        $needPoints += intval($item[$id-1]['item_point']);
    }

    // echo $acc['account_point'], ", ",$needPoints, ", ", $acc['account_point'] < $needPoints;
    // ポイントが足りないとき、エラー表示
    if($acc['account_point'] < $needPoints) {
        header('Location: index.php?err=2', true, 307);
        exit();
    }

    foreach($ids as $id)
    {
        $current = intval($acc['account_point']);
        $target = intval($item[$id-1]['item_point']);

        // ポイント処理
        $dont = false;
        foreach($has as $as) {
            if($as['item_id'] == $id) $dont = true;
            if($dont) break;
        }

        if(!$dont) {
            $sql = $db -> prepare('UPDATE Accounts SET account_point=? WHERE account_id=?');
            $sql -> execute([$current - $target, $_SESSION['loginfo']['acc_id']]);
        }

        // アイテム追加
        $sql = $db -> prepare('INSERT IGNORE INTO HasItems VALUE (?, ?)');
        $sql -> execute([$_SESSION['loginfo']['acc_id'], $id]);
    }
    
    header('Location: index.php', true, 307);
?>