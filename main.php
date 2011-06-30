<?php
$seite = "Hauptmenue";
require_once("main.class.php");

$UM = new UniManager("main");

if(!$_SESSION["user_loginname"])
{
	$UM->SessionEnd();
}


$UM->showheader($seite);

// sonstiger Code

$UM->showfooter();
$UM->tpl->display("main.tpl", session_id());
?>