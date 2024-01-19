<?php session_start() ?>
<?php
	if(empty($_SESSION['loginfo']))
		header("Location: https://aso2201185.tonkotsu.jp/php2/final/src/index.php?err=2");
?>