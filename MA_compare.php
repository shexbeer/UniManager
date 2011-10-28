<?php
$seite = "Modulaufstellungen vergleichen";
require_once("main.class.php");

$UM = new UniManager("MA_compare");
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