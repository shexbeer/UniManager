<?php
$seite = "Neue Modulinhalte erstellen";
require_once("main.class.php");

$UM = new UniManager("Modul_IE");
$UM->seite = $seite;

if(!$_SESSION["user_loginname"])
{
	$UM->SessionEnd();
}

if(!$_GET && !$_POST)
{
	$UM->ProcessObject->initForm();
}

if($_GET["forid"])
{//Moduldetails anzeigen
    $UM->ProcessObject->changemodul($_GET["forid"]);
}

if($_GET["forid"]&& $_POST)
{//Moduldetails editieren
    $UM->ProcessObject->changemodul($_GET["forid"],$_POST["modul"]);
}



?>
