<?php
$seite = "Hauptmenue";
require_once("main.class.php");

$UM = new UniManager("main");

if(!$_SESSION["user_loginname"])
{
	$UM->SessionEnd();
}


$UM->showheader($seite);

// Code f�r die diese Seite

$UM->showfooter();
$UM->tpl->display("main.tpl", session_id());
?>