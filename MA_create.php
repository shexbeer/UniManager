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

if($_GET["forid"] && $_GET["forSem"]) 
{
	$UM->ProcessObject->createMA($_GET["forid"], $_GET["forSem"]);
	die();
}
if($_GET["forid"]) 
{
	$UM->ProcessObject->createMA($_GET["forid"], $UM->getCurrentSemester());
}

?>