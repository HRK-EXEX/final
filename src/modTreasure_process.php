<?php session_start(); ?>
<?php require 'initial/db-connect.php' ?>
<?php
    $id = $_GET['id'] ?? null;
    $name = $_POST['name'] ?? null;
    $desc = $_POST['desc'] ?? null;
    $rank = $_POST['rank'] ?? null;
    $price = $_POST['price'] ?? null;
    $ctgr = $_POST['ctgr'] ?? null;
    $create = $_POST['sel'] ?? null;

    $sql = $db -> prepare('SELECT * FROM Treasures WHERE treasure_name=?');
    $sql -> execute([$name]);
    $treasures = $sql -> fetch(PDO::FETCH_ASSOC);

    $sql = $db -> prepare('SELECT * FROM Categories WHERE category_name=?');
    $sql -> execute([$ctgr]);
    $res = $sql -> fetch(PDO::FETCH_ASSOC);
    
    if ($create) {
        if ($sql -> fetch(PDO::FETCH_ASSOC) == false) {
            $sql = $db -> prepare('INSERT INTO Categories VALUE (NULL, ?)');
            $sql -> execute([$ctgr]);
        } else {
            header('Location: modTreasure.php?err=2', true, 307);
        }
    }

    $sql = $db -> prepare(
        'UPDATE Treasures SET treasure_name = ?, treasure_desc = ?, treasure_rank = ?,
            treasure_price = ?, treasure_ctgr = ? WHERE treasure_id = ?'
    );

    $sql -> execute([$name, $desc, $rank, $price, $res['category_id'], $treasures['treasure_id']]);

    header("Location: modTreasure_done.php?id=$id", true, 307);
?>