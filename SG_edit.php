<?php
$seite = "Aenderung eines Studienganges";
require_once("main.class.php");

$UM = new UniManager("SG_edit");
$UM->seite = $seite;

if(!$_SESSION["user_loginname"])
{
	$UM->SessionEnd();
}

if(!$_GET && !$_POST)
{	// Startformular zeigen
	$UM->ProcessObject->initForm();
}

if($_GET["createnew"] == "yes" && !$_POST)
{	// Neuen SG kreieren Formular anzeigen
	// DEGUG: SICHERHEITSÜBERPRÜFUNG auf BERECHTIGUNG NOTWENDIG
	$UM->ProcessObject->getCreateSGForm();
}
if($_GET["createnew"] == "yes" && $_POST) 
{	// Studiengang kreieren
	$UM->ProcessObject->createSG($_POST["sg_name"], $_POST["dekan"], $_POST["sg_typ"]);
}
if($_GET["setStatus"] && $_GET["forid"]) 
{	// SG Status setzen
	$UM->ProcessObject->setSGStatus($_GET["forid"], $_GET["setStatus"]);
}
if($_GET["deleteid"])
{	// SG löschen
	$UM->ProcessObject->deleteSG($_GET["deleteid"]);
}
if($_GET["showEdit"] && $_GET["forid"])
{	// SG Edit Form
	$UM->ProcessObject->showEditSG(false, $_GET["forid"]);
}
if($_GET["editSG"] && $_GET["forid"] && $_POST)
{	// Edit SG
	if($_FILES['poso_file']['tmp_name'] != ""){
		$path = $UM->cwd["Path"] . PDF_POSO_DIR;
		$name = "POSO_".$_GET["forid"].".pdf";
		$uri = $path . $name;
  		if(!move_uploaded_file($_FILES['poso_file']['tmp_name'],$uri)){
   			// Ups, es passierte ein Fehler beim Kopieren
   			$UM->VisualObject->showResult(false, "Fehler beim kopieren der Upload-Datei");
   			die();
   		}
   		$UM->ProcessObject->editSG($_GET["forid"], $_POST["sg_name"], $_POST["dekan"],$_POST["sg_typ"],$_POST["modulaufstellung"],$_POST["modul_ps"], $_POST["sg_status"], $name);
	}else{
 		$UM->ProcessObject->editSG($_GET["forid"], $_POST["sg_name"], $_POST["dekan"],$_POST["sg_typ"],$_POST["modulaufstellung"],$_POST["modul_ps"], $_POST["sg_status"]);
	}
}

?>