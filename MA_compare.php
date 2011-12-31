<?php
$seite = "Modulangebot vergleichen";
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

if($_GET["compareMA"] && $_GET["forid"] && $_GET["sem"]) 
{
	$UM->ProcessObject->getSG($_GET["forid"], $_GET["sem"]);
}
var_dump($_POST);
?>