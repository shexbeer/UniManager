<?php
$seite = "Neue Modulinhalte erstellen";
require_once("main.class.php");

$UM = new UniManager("Modul_IE");
$UM->seite = $seite;

if(!$_SESSION["user_loginname"])
{
	$UM->SessionEnd();
}

if(!$_GET && !$_POST)
{
	$UM->ProcessObject->initForm();
}
?>
