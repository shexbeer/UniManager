<?php
$seite = "Noten einsehen";
require_once("main.class.php");

$UM = new UniManager("LNA_show");
$UM->seite = $seite;

if(!$_SESSION["user_loginname"])
{
	$UM->SessionEnd();
}

$UM->ProcessObject->initForm();

?>