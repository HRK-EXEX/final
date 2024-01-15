<?php session_start(); ?>
<?php require 'initial/db-connect.php' ?>
<?php
    $name = $_POST['name'] ?? null;
    $desc = $_POST['desc'] ?? null;
    $rank = $_POST['rank'] ?? null;
    $price = $_POST['price'] ?? null;
    $ctgr = $_POST['ctgr'] ?? null;

    $sql = $db -> prepare('SELECT * FROM Treasures WHERE treasure_name=?');
    $sql -> execute([$name]);

    if ($sql -> fetch(PDO::FETCH_ASSOC) == false) {
        $sql = $db -> prepare('SELECT * FROM Categories WHERE category_name=?');

        if ($sql -> fetch(PDO::FETCH_ASSOC) == false) {
            $sql = $db -> prepare('INSERT INTO Categories VALUE (NULL, ?)');
            $sql -> execute([$ctgr]);
        } else {
            header('Location: newTreasure.php?err=2', true, 307);
        }

        $sql = $db -> prepare('INSERT INTO Treasures VALUE (NULL, ?, ?, ?, ?, ?)');
        $sql -> execute([$name, $desc, $rank, $price, $ctgr]);

        header('Location: newTreasure_done.php');
    } else {
        header('Location: newTreasure.php?err=1', true, 307);
    }
?>