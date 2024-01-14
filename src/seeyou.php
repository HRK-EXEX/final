<?php session_start(); ?>
<?php
    unset($_SESSION['loginfo']);
    header('Location: login.php');
?>