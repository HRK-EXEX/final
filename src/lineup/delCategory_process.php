<?php require '../initial/login-check.php' ?>
<?php require '../initial/db-connect.php' ?>
<?php
    $ctgr = $_POST['ctgr'] ?? null;

    $sql = $db -> prepare('SELECT * FROM Categories WHERE category_name=?');
    $sql -> execute(["'".$ctgr."'"]);
    $res = $sql -> fetch(PDO::FETCH_ASSOC);
    
    if ($res != false) {
        $sql = $db -> prepare(
            'SELECT * FROM Treasures LEFT JOIN Categories
            ON Treasures.treasure_ctgr = Categories.category_id
            WHERE category_name=?'
        );
        $sql -> execute([$ctgr]);
        $res = $sql -> fetch(PDO::FETCH_ASSOC);

        if ($res != false) {
            $sql = $db -> prepare(
                'UPDATE Treasures LEFT JOIN Categories
                ON Treasures.treasure_ctgr = Categories.category_id
                SET treasure_ctgr = 0
                WHERE category_name=?'
            );
            $sql -> execute([$res['category_name']]);
        }

        $sql = $db -> prepare('DELETE FROM Categories WHERE category_name=?');
        $sql -> execute([$res['category_name']]);
        header('Location: delCategory_done.php', true, 307);
    } else {
        header("Location: delCategory.php?err=1", true, 307);
    }
?>