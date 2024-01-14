<?php session_start() ?>
<?php require 'initial/db-connect.php' ?>
<?php
    unset($_SESSION['loginfo']);
    $id = $_POST['id'] ?? null;
    $name = $_POST['name'] ?? null;
    $pswd = $_POST['pswd'] ?? null;
    
    $sql = $db -> prepare('SELECT * FROM Accounts WHERE account_id = ?;');
    $sql -> execute([$id]);

    if($sql -> fetch(PDO::FETCH_ASSOC) == false) {
        $sql = $db -> prepare('INSERT INTO Accounts VALUES (?, ?, ?, 1, 0, 0);');
        $sql -> execute([$id, $name, $pswd]);

        $_SESSION['loginfo'] = [
            'acc_id' => $id,
            'acc_pswd' => $pswd
        ];

        header("Location: submitted.php");
    } else {
        header("Location: submit.php?err=1", true, 307);
    }
?>