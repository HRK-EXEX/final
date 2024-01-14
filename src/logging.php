<?php session_start(); ?>
<?php require 'initial/db-connect.php' ?>
<?php
    unset($_SESSION['loginfo']);
    $id = $_POST['id'];
    $pswd = $_POST['pswd'];
    $exp = 0;
    
    // echo 'SELECT * FROM Accounts WHERE account_id=', $id;
    $sql = $db -> prepare('SELECT * FROM Accounts WHERE account_id=?;');
    $sql -> execute([$id]);

    $res = $sql -> fetch(PDO::FETCH_ASSOC);
    if($res) {
        // print_r($res);
        if($res['account_pswd'] == $pswd){
            $_SESSION['loginfo'] = [
                'acc_id' => $id,
                'acc_pswd' => $pswd
            ];
            header('Location: index.php');
        } else {
            header('Location: login.php?err=1', true, 307);
        }
    } else {
        header('Location: login.php?err=1', true, 307);
    }
?>