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
if($_GET["createMA"] && $_GET["forid"])
{
	//var_dump($_POST);
	$UM->ProcessObject->setMA($_GET["forid"], $_POST["ma_semester"], $_POST["modulangebot"], $_POST["lb"]);
	die();
}
if($_GET["forid"] && $_GET["forSem"]) 
{
	$MAs = array();
	$MAs[0] = $_GET["curr"];
	$MAs[1] = $_GET["next"];
	$UM->ProcessObject->createMA($_GET["forid"], $_GET["forSem"], $MAs);
	die();
}
if($_GET["forid"]) 
{
	$MAs = array();
	$MAs[0] = $_GET["curr"];
	$MAs[1] = $_GET["next"];
	$UM->ProcessObject->createMA($_GET["forid"], $UM->getCurrentSemester(), $MAs);
}
?>