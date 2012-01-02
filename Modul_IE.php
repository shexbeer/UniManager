<?php
$seite = "Neue Modulinhalte erstellen";
require_once("main.class.php");

$UM = new UniManager("Modul_IE");
$UM->seite = $seite;

if(!$_SESSION["user_loginname"])
{
	$UM->SessionEnd();
}

$UM->checkUserHasRole(array("lehrende","fakultaetsrat","studiendekan"));

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
     $fixes['person_id']=$_POST["lehrende"];
     $fixes['duration']=$_POST["modul_duration"];
     $fixes['qualifytarget']=$_POST["modul_qualifytarget"];
     $fixes['institut']=$_POST["modul_institut"];
     $fixes['content']=$_POST["modul_content"];
     $fixes['literature']=$_POST["modul_literature"];
     $fixes['teachform']=$_POST["modul_teachform"];
     $fixes['required']=$_POST["modul_required"];
     $fixes['frequency']=$_POST["modul_frequency"];
     $fixes['usability']=$_POST["modul_usability"];
     $fixes['lp']=$_POST["modul_lp"];
     $fixes['conditionforln']=$_POST["modul_conditionforln"];
     $fixes['effort']=$_POST["modul_effort"];
    $UM->ProcessObject->changemodul($_GET["forid"],$_POST["modul_status"],$fixes);
}

?>
