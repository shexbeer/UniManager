<?php
$seite = "Anmeldung zum Leistungsnachweis";
require_once("main.class.php");

$UM = new UniManager("LN_create");
$UM->seite = $seite;

if(!$_SESSION["user_loginname"])
{
	$UM->SessionEnd();
}
$UM->checkUserHasRole(array("student"));

if(!$_GET && !$_POST)
{
	$UM->ProcessObject->initForm();
}
if($_GET["forid"]) {
	$UM->ProcessObject->createLNA($_GET["forid"]);
}
?>