<?php
  class PO_POSO_edit{
      
      function PO_POSO_edit($UM)
      {
          $this->UM=$UM;                
      }
       /**
        * Ruft eine Liste aller Studiengaenge ab und substituiert die Dekan-ID durch den Namen des Dekans initform()
        Achtung: Dekanvor- und nachname zusammengefuegt und nur ein Feld
        */
      function initform()
      {
          //Manager initialisieren
          $SG= new SG_Management();
          $PM= new Person_Management();
          //Studiengangliste holen und ueberpruefen
          $sglist_unchecked=$SG->getSGList();
          $sglist=$this->UM->checkManagerResults($sglist_unchecked,"sg_id","Studiengangliste");
          //Jeden Studiengang in das Result schieben und die DekanID durch einen Namen substituieren
          $posotemplates = $this->UM->checkPOSOTemplates();
          foreach($sglist as $var)
          {
              $result[$var["sg_id"]]=$var;
              $dekan_unchecked=$PM->getDekanDetails($var["sg_dekan"]);
              $dekan_id = $var["sg_dekan"];
              $dekan=$this->UM->checkManagerResults($dekan_unchecked,"studiendekan_id","Dekanabfrage");
              //var_dump($dekan);
              $result[$var["sg_id"]]["sg_dekan"]=$dekan[$dekan_id]["person_vorname"]." ".$dekan[$dekan_id]["person_name"];
          }
          $this->UM->VisualObject->showSGList($result, $posotemplates);  
      }
      
      /**
      * Holt die Vorlage f�r die PO und SO von dem SG-Manager und sendet diese an das VO (array mit den feldern po und so (ich gehe bis jetzt von 2 pdf dateien aus))
      *       
      */
      function editPOSO_Template($sg_id)
      {
          //Manager initialieren
          $SG= new SG_Management();
          $MM = new Modul_Management();
          //Vorlage von Manager holen und ueberpruefen
          
          $sgtyp_unch = $SG->getSGTypForID($sg_id);
	      $sgtyp = $this->UM->checkManagerResults($sgtyp_unch, "sg_id", "Studiengangtyps");
    	  $sgtyp = $sgtyp[$sg_id]["sg_typ"];
    	  //var_dump($sgtyp_unch);
    	  if(!$this->UM->checkPOSOTemplates($sgtyp)) {
    	  	$this->UM->trigger_error(5, "", true, true);	
    	  }
    	  
    	  $descriptions = $this->UM->getPOSOTemplateFields($sgtyp);
    	  if($descriptions) {
			  foreach($descriptions as $key => $var) {
				foreach($var as $key2 => $var2) {
					if(!is_array($var2)) {
						$descriptions[$key][$key2] = utf8_decode($var2);
					}
				}
			  }
		  } else {
		  	$this->UM->trigger_error(5, "", true, true);
		  }
    	  
    	  //Modulliste zum Studiengang holen und ueberpruefen
          $modullist_unchecked=$MM->getModullist(true,"sg",$sg_id);
          $modullist=$this->UM->checkManagerResults($modullist_unchecked,"modul_id","Abrufen der Modulliste");
    	  
          //$vorlage = $SG->getTemplate($sgtyp, $descriptions["titelseite"], $descriptions["content"], $descriptions["ziele"], $descriptions["footerseite"], $descriptions["modullist"]);
          //vorlage an VO senden
          $this->UM->VisualObject->showPOSOTemplate($sg_id, $vorlage, $descriptions);
      }
      
      /**
      * Schickt die neue PO und SO an den Manager und holt eine Modulliste aus dem Manager die dann an das VO geschickt wird
      * @param int $sg_id  ID des Studienganges fuer den die PO und SO sind
      * @param mixed $poso  Array das die felder po und so enthaelt
      */
      
      function createPOSO($sg_id,$descriptions)
      {
          //Manager initialieren
          $SG=new SG_Management();
          $MM=new Modul_Management();
          
          include_once("pdf/pdf_create.php");
          $pdfc = new PDFCreator($this->UM);
          
          $sgtyp_unch = $SG->getSGTypForID($sg_id);
	      $sgtyp = $this->UM->checkManagerResults($sgtyp_unch, "sg_id", "Studiengangtyps");
    	  $sgtyp = $sgtyp[$sg_id]["sg_typ"];
          
          $MM = new Modul_Management();
		  $modullist_unchecked=$MM->getModullist(true,"sg",$sg_id);
          $modullist=$this->UM->checkManagerResults($modullist_unchecked,"modul_id","Abrufen der Modulliste");
          
   		  $content = $SG->getTemplate($sgtyp,$descriptions["titelseite"], $descriptions["content"], $descriptions["ziele"], $descriptions["footerseite"], $modullist);
        
          $pdfc->POSO($sg_id,$content, false);
          
          $poso_name= "POSO_".$sg_id.".pdf";
          $SG->setPO($sg_id, $poso_name);
          $SG->setSO($sg_id, $poso_name);
          $this->UM->VisualObject->showResult(true,PDF_POSO_DIR.$poso_name);
      }
      
      /**
      * Schickt eine Modulliste f�r einen Studiengang an den Mananger und erstellt ein neues Modulhandbuch
      * @param int $sg_id ID des Studienganges f�r den die Modulliste gesetzt werden soll
      * @param mixed $modullist Array mit den Feldern count,modul_id, plansemester
      */
      function setModullisteForSG($sg_id,$modullist)
      {
          //Manager initialisieren
          $SG=new SG_Management();
          //Modulliste an Manager senden
          $result=$SG->setModullisteForSG($sg_id,$modullist);
          //Erfolg oder Misserfolg an VO melden
          $this->UM->VisualObject->showResult($result);
      }
      function editModulaufstellung($sg_id,$modullist)
      {
          //Manager initialisieren
          $SG=new SG_Management();
          //Modulliste an Manager senden
          $result=$SG->setModullisteForSG($sg_id,$modullist);
          //Erfolg oder Misserfolg an VO melden
          $this->UM->VisualObject->showResult($result);
      }
      function editTemplate($type) 
      {
      	$temp_exists = $this->UM->checkPOSOTemplates($type);
      	if(!$temp_exists) $this->UM->trigger_error(5,"",true, true);
      	
      	$path = $this->UM->getPOSOTemplatePath($type);
      	
      	
      	
      	$content = utf8_decode(file_get_contents($path));
      	$this->UM->VisualObject->showEditTemplate($type, $content);
      }
      function setTemplate($type, $content)
      {
      	//var_dump($content);
      	$temp_exists = $this->UM->checkPOSOTemplates($type);
      	if(!$temp_exists) $this->UM->trigger_error(5,"",true, true);
      	
      	$path = $this->UM->getPOSOTemplatePath($type);
      	file_put_contents($path,utf8_encode($content));
      	$this->UM->VisualObject->showTemplateResult(true, "");
      }
  }
?>
