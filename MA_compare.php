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
if($_GET["setMA"] && $_POST) {
	$UM->ProcessObject->changeSGModulA($_POST["forid"], $_POST["forSemester"], $_POST["modulangebot"], $_POST["lb"], $_POST["ma_status"]);
}
?>