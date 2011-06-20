<?php
session_start();
require_once("main.class.php");
$UM = new UniManager();
// Setze 0 damit Status offline angezeigt wird !
/*
	$sql = "UPDATE userinfo SET lastlogin = '0' WHERE user = '" . $_SESSION["loginname"] . "'";
	$res = mysql_query($sql);
*/
session_unset();
session_destroy();
$UM->trigger_error("0", "<a href='index.php'>Hier</a> koennen sie sich neu einloggen.", false, false);

?>
