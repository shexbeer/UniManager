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

if($_GET["new"] && !$_POST)
{
    $UM->ProcessObject->showCreateModul();
    die();    
}

if($_GET["new"] && $_POST)
{
    $count=0;
    $error;
    if($_POST["lehrende"]=="" || !$_POST["lehrende"]){
        $error[$count]="Sie haben vergessen den Lehrenden auszuwählen!";
        $count=$count+1;
    } 
    if($_POST["modul_name"]=="" || !$_POST["modul_name"]){
        $error[$count]="Sie haben vergessen den Modulnamen anzugeben!";
        $count=$count+1;
    }
    if($count!=0)
    {
       $UM->ProcessObject->showCreateModul($error);
    }
    else{
       $UM->ProcessObject->addModul($_POST["modul_name"],$_POST["lehrende"]); 
    }
}

if($_GET["change"]==false && $_GET["delete"]==false && $_GET["forid"] && !$_POST)
{//Moduldetails anzeigen
    $UM->ProcessObject->changemodul($_GET["forid"],true);
    die();
}

if($_GET["change"] && $_GET["forid"] && !$_POST)
{
    //Änderungsdetails anzeigen
    $UM->ProcessObject->changemodul($_GET["forid"],false);
    die();
    
}
//var_dump($_GET,$_POST);
if($_GET["delete"] && $_GET["forid]"] && !$_POST)
{
    if ($_POST["a_id"]){
        $UM->ProcessObject->deletemodul($_GET["forid"],true);
    }
    else{
       $UM->ProcessObject->deletemodul($_GET["forid"],false);
    }
    die();
}

if($_GET["delete"] && $_GET["forid"] && $_POST)
{
    
}


if($_GET["changemodul"]  &&  $_GET["forid"] && $_POST)
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
     $UM->ProcessObject->changemodul($_GET["forid"],true,$_POST["modul_status"],$fixes);
}
if($_GET["changechange"]  && $_GET["forid"] && $_POST)
{
     $fixes['status']=$_POST["aenderung_status"];
     $fixes['pid']=$_POST["lehrende"];
     $fixes['duration']=$_POST["aenderung_duration"];
     $fixes['qualifytarget']=$_POST["aenderung_qualifytarget"];
     $fixes['institut']=$_POST["aenderung_institut"];
     $fixes['content']=$_POST["aenderung_content"];
     $fixes['literature']=$_POST["aenderung_literature"];
     $fixes['teachform']=$_POST["aenderung_teachform"];
     $fixes['required']=$_POST["aenderung_required"];
     $fixes['frequency']=$_POST["aenderung_frequency"];
     $fixes['usability']=$_POST["aenderung_usability"];
     $fixes['lp']=$_POST["aenderung_lp"];
     $fixes['conditionforln']=$_POST["aenderung_conditionforln"];
     $fixes['effort']=$_POST["aenderung_effort"];
     $UM->ProcessObject->changemodul($_GET["forid"],false,$_POST["aenderung_status"],$fixes);
}


?>
