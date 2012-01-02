<?php
$seite = "PO und SO aendern";
require_once("main.class.php");

$UM = new UniManager("POSO_edit");
$UM->seite = $seite;

if(!$_SESSION["user_loginname"])
{
	$UM->SessionEnd();
}

$UM->checkUserHasRole(array("studiendekan"));

if(!$_GET && !$_POST)
{
	$UM->ProcessObject->initForm();
}

?>