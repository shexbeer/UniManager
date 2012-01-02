<?php
$seite = "Leistungsnachweise aendern";
require_once("main.class.php");

$UM = new UniManager("LN_edit");
$UM->seite = $seite;

if(!$_SESSION["user_loginname"])
{
	$UM->SessionEnd();
}
$UM->checkUserHasRole(array("lehrende"));

if(!$_GET && !$_POST)
{
	$UM->ProcessObject->initForm();
}
if($_GET["forid"])
{
	$UM->ProcessObject->getTeilnehmerList($_GET["forid"]);
}
if($_POST)
{
	//var_dump($_POST);
	$UM->ProcessObject->enterList($_POST);
}
?>