<?php
$seite = "Modulangebot &auml;ndern";
require_once("main.class.php");

$UM = new UniManager("MA_edit");
$UM->seite = $seite;

if(!$_SESSION["user_loginname"])
{
	$UM->SessionEnd();
}

if(!$_GET && !$_POST)
{
	$UM->ProcessObject->initForm();
}

if($_GET["setMA"] && $_POST) {
	$UM->ProcessObject->setMA($_POST["forid"], $_POST["forSemester"], $_POST["modulangebot"], $_POST["lb"], $_POST["ma_status"]);
}
if($_GET["editMA"] && $_GET["forid"] && $_GET["sem"]) 
{
	$UM->ProcessObject->getModulangebot($_GET["forid"], $_GET["sem"]);
}

?>