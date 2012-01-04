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

if($_GET["editPOSO"] && $_GET["forid"]) {
	$UM->ProcessObject->editPOSO_Template($_GET["forid"]);
}

if($_GET["editPOSO"] && $_POST) {
	//var_dump($_POST);
	//die();
	$sgid = $_POST["sgid"];
	unset($_POST["sgid"]);
	$UM->ProcessObject->createPOSO($sgid, $_POST);
}

if($_GET["editModulaufstellung"] && $_GET["forid"]) {
	$UM->ProcessObject->editModulaufstellung($_GET["forid"]);
}

if($_GET["editModulaufstellung"] && $_POST) {
	$UM->ProcessObject->setModulaufstellung($_POST["sg_id"], $_POST["sg_typ"], $_POST["modulaufstellung"], $_POST["modul_ps"]);
}
if($_GET["editTemplate"] && $_POST["type"] && $_POST) {
	$UM->ProcessObject->setTemplate($_POST["type"], $_POST["content"]);
}
if($_GET["editTemplate"] && $_GET["type"]) {
	$UM->ProcessObject->editTemplate($_GET["type"]);
}



?>