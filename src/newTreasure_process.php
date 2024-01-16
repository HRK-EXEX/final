<?php session_start(); ?>
<?php require 'initial/db-connect.php' ?>
<?php
    $name = $_POST['name'] ?? null;
    $desc = $_POST['desc'] ?? null;
    $rank = $_POST['rank'] ?? null;
    $price = $_POST['price'] ?? null;
    $ctgr = $_POST['ctgr'] ?? null;
    $create = $_POST['sel'] ?? null;

    $sql = $db -> prepare('SELECT * FROM Treasures WHERE treasure_name=?');
    $sql -> execute([$name]);

    if ($sql -> fetch(PDO::FETCH_ASSOC) == false) {
        $sql = $db -> prepare('SELECT * FROM Categories WHERE category_name=?');
        $sql -> execute([$ctgr]);
        $res = $sql -> fetch(PDO::FETCH_ASSOC);
        
        if ($create) {
            if ($sql -> fetch(PDO::FETCH_ASSOC) == false) {
                $sql = $db -> prepare('INSERT INTO Categories VALUE (NULL, ?)');
                $sql -> execute([$ctgr]);
            } else {
                header('Location: newTreasure.php?err=2', true, 307);
            }
        }

        $sql = $db -> prepare('INSERT INTO Treasures VALUE (NULL, ?, ?, ?, ?, ?)');
        $sql -> execute([$name, $desc, $rank, $price, $res['category_id']]);

        header('Location: newTreasure_done.php', true, 307);
    } else {
        header('Location: newTreasure.php?err=1', true, 307);
    }
?>