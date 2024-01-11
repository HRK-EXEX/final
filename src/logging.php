<?php require 'initial/db-connect.php' ?>
<?php
    $id = $_POST['id'];
    $pass = $_POST['id'];

    $sql = $db -> prepare("SELECT * FROM Accounts WHERE accounts_id = '?'");
    $sql -> execute([$id]);

    $res = $sql -> fetch(PDO::FETCH_ASSOC);
    if($res['account_pswd'] == $pass){
        header('Location: index.php');
    } else {
        header('Location: login.php');
    }
?>