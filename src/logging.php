<?php session_start(); ?>
<?php require 'initial/db-connect.php' ?>
<?php
    unset($_COOKIE['loginfo']);
    $id = $_POST['id'];
    $pswd = $_POST['pswd'];
    $exp = 0;

    $sql = $db -> prepare("SELECT * FROM Accounts WHERE accounts_id = '?'");
    $sql -> execute([$id]);

    $res = $sql -> fetch(PDO::FETCH_ASSOC);
    if($res['account_pswd'] == $pswd){
        $_COOKIE['loginfo'] = [
            'acc_id' -> $id,
            'pswd' -> $pswd
        ];
        header('Location: index.php');
    } else {
        header('Location: login.php?err=1');
    }
?>