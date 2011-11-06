<?php
$seite = "Aenderung eines Studienganges";
require_once("main.class.php");

$UM = new UniManager("SG_edit");
$UM->seite = $seite;

if(!$_SESSION["user_loginname"])
{
	$UM->SessionEnd();
}

if(!$_GET && !$_POST)
{
	$UM->ProcessObject->initForm();
}

if($_GET["createnew"] == "yes")
{
	// DEGUG: SICHERHEITSÜBERPRÜFUNG auf BERECHTIGUNG NOTWENDIG
	
	$UM->ProcessObject->getCreateSGForm();
}
if($_GET["setStatus"] && $_GET["forid"] && $_GET["status"]) {
	$UM->ProcessObject->setSGStatus($_GET["forid"], $_GET["setStatus"]);
}

if($_GET["forid"])
{
	$UM->ProcessObject->editSG(false, $_GET["forid"]);
}
?>