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

if($_GET["forid"] && !$_POST)
{//Moduldetails anzeigen
    $UM->ProcessObject->changemodul($_GET["forid"]);
    die();
}

if($_GET["changemodul"] &&  $_GET["forid"] && $_POST)
{
    $UM->ProcessObject->changemodul($_GET["forid"],$_POST["lehrende"],$_POST["modul_status"], $_POST["modul_duration"],$_POST["modul_qualifytarget"], $_POST["modul_content"],$_POST["modul_institut"] , $_POST["modul_literature"], $_POST["modul_teachform"], $_POST["modul_required"], $_POST["modul_frequency"], $_POST["modul_usability"], $_POST["modul_lp"], $_POST["modul_conditionforln"], $_POST["modul_effort"]);
}

?>
