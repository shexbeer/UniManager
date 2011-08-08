<?php
$seite = "Modulangebot erstellen";
require_once("main.class.php");

$UM = new UniManager("MA_create");
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