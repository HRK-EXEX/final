<?php session_start() ?>
<?php
	if(empty($_SESSION['loginfo']))
		header("Location: ../login.php?err=2");
?>