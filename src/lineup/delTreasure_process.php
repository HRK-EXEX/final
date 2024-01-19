<?php require '../initial/login-check.php' ?>
<?php require '../initial/db-connect.php' ?>
<?php
    $id = $_GET['id'] ?? null;
    $name = $_POST['name'] ?? null;
    $desc = $_POST['desc'] ?? null;
    $rank = $_POST['rank'] ?? null;
    $price = $_POST['price'] ?? null;
    $ctgr = $_POST['ctgr'] ?? null;

    $sql = $db -> prepare('SELECT * FROM Treasures WHERE treasure_name=?');
    $sql -> execute([$name]);

    if ($sql -> fetch(PDO::FETCH_ASSOC) != false) {
        $sql = $db -> prepare('DELETE FROM Treasures WHERE treasure_id=?');
        $sql -> execute([$id]);
        
        header('Location: delTreasure_done.php', true, 307);
    } else {
        header("Location: delTreasure.php?id=$id&err=1");
    }
?>