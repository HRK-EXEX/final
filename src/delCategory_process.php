<?php session_start(); ?>
<?php require 'initial/db-connect.php' ?>
<?php
    $ctgr = $_POST['ctgr'] ?? null;

    $sql = $db -> prepare('SELECT * FROM Categories WHERE category_name=?');
    $sql -> execute([$ctgr]);
    $res = $sql -> fetch(PDO::FETCH_ASSOC);

    if ($res) {
        $sql = $db -> prepare('DELETE FROM Categories WHERE category_name=?');
        $sql -> execute([$res['category_name']]);
        
        header('Location: delCategory_done.php', true, 307);
    } else {
        header("Location: delCategory.php?err=1", true, 307);
    }
?>