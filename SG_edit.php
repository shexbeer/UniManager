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
{	// Startformular zeigen
	$UM->ProcessObject->initForm();
}

if($_GET["createnew"] == "yes" && !$_POST)
{	// Neuen SG kreieren Formular anzeigen
	// DEGUG: SICHERHEITSÜBERPRÜFUNG auf BERECHTIGUNG NOTWENDIG
	$UM->ProcessObject->getCreateSGForm();
}
if($_GET["createnew"] == "yes" && $_POST) 
{	// Studiengang kreieren
	$UM->ProcessObject->createSG($_POST["sg_name"], $_POST["dekan"]);
}
if($_GET["setStatus"] && $_GET["forid"] && $_GET["status"]) 
{	// SG Status setzen
	$UM->ProcessObject->setSGStatus($_GET["forid"], $_GET["setStatus"]);
}
if($_GET["deleteid"])
{	// SG löschen
	$UM->ProcessObject->deleteSG($_GET["deleteid"]);
}
if($_GET["forid"])
{	// SG editieren
	$UM->ProcessObject->editSG(false, $_GET["forid"]);
}

?>