<?php
$seite = "Anmeldung zum Leistungsnachweis";
require_once("main.class.php");

$UM = new UniManager("LN_create");
$UM->seite = $seite;

if(!$_SESSION["user_loginname"])
{
	$UM->SessionEnd();
}

if(!$_GET && !$_POST)
{
	//$UM->showheader($seite);
	$UM->ProcessObject->initForm();
}
?>