<?php
  class PO_MA_edit{
      
      function PO_MA_edit($UM)
      {
          $this->UM=$UM;
      }
       /**
        * Ruft eine Liste aller Studiengaenge ab und substituiert die Dekan-ID durch den Namen des Dekans initform()
        Achtung: Dekanvor- und nachname zusammengefuegt und nur ein Feld
        */
      function initform()
      {
        $SG_M = new SG_Management();
		$PM = new Person_Management();
		$MA = new Modulangebot_Management();
		// Hole alle StudiengÃ¤nge zum anzeigen
		$sg = $SG_M->getSGList();
		$sglist = $this->UM->checkManagerResults($sg, "sg_id", "Abfrage der Studiengaenge");
		
		foreach($sglist as $var)
        {
              $result[$var["sg_id"]]=$var;
              $dekan_unchecked=$PM->getDekanDetails($var["sg_dekan"]);
              $dekan_id = $var["sg_dekan"];
              $dekan=$this->UM->checkManagerResults($dekan_unchecked,"studiendekan_id","Dekanabfrage");
              $result[$var["sg_id"]]["sg_dekan"]=$dekan[$dekan_id]["person_vorname"]." ".$dekan[$dekan_id]["person_name"];

              //var_dump($dekan);
              if($MA->checkModulangebotForSG($var["sg_id"], $this->UM->getCurrentSemester())) 
              	$result[$var["sg_id"]]["MA_curr"] = true;
              else
                $result[$var["sg_id"]]["MA_curr"] = false;
                
              if($MA->checkModulangebotForSG($var["sg_id"], $this->UM->getNextSemester())) 
              	$result[$var["sg_id"]]["MA_next"] = true;
              else
                $result[$var["sg_id"]]["MA_next"] = false;
                
            
        }
        
		$this->UM->VisualObject->showSGList($result);    
      }
      
      
      /**
      * Diese Funktion ruft den Status des Modulangebotes zu einem Studiengang und die Modulaufstellung ab
      * @param int $sg_id  ID des Studienganges
      * @param int $semesterShort  1=currentSemester 2=nextSemester
      */
      function getModulangebot($sg_id, $semesterShort)
      {
      	$MM = new Modul_Management();
		$SG = new SG_Management();
		$PM = new Person_Management();
         //Modulliste zum Studiengang holen und ueberpruefen
        $modullist_unchecked=$MM->getModullist(true,"sg",$sg_id);
        $modullist=$this->UM->checkManagerResults($modullist_unchecked,"modul_id","Abrufen der Modulliste");
        $oddOrEven = $this->UM->checkIfOddOrEvenSemester($semester);
        foreach($modullist as $key => $var) {
        	if($oddOrEven == "odd") {
        		if(($var["mauf_plansemester"] % 2) == 0) //odd
        		{
        			$result[$key] = $var;
        		} else { // even
        		}
        	} else {
        		if(($var["mauf_plansemester"] % 2) == 1) //even
        		{
        			$result[$key] = $var;
        		} else { // odd
        		}
        	}
        }
        $modullist = $result;
        
        $po=$SG->getPO($sg_id);
        
        $po = $this->UM->checkManagerResults($po, "sg_id", "Abfrage der PO");
        //var_dump($po);
        $modulhb = $SG->getModulhandbuch($sg_id);
        if($semesterShort == 1) {
        	$semester = $this->UM->getCurrentSemester();
        } else {
        	$semester = $this->UM->getNextSemester();
        }
        $lehrbeauf_unchecked = $PM->getLehrbeauftragte();
        $lehrbeauf = $this->UM->checkManagerResults($lehrbeauf_unchecked, "lehrbeauftr_id", "Abfrage der Lehrbeauftragten");
        
        $sgname_unch = $SG->getSGNameforID($sg_id);
        $sgname = $this->UM->checkManagerResults($sgname_unch, "sg_id", "Abfrage des Studiengangnames");
        $sgname = $sgname[$sg_id]["sg_name"];
        $this->UM->VisualObject->showModulaufstellung($sg_id,$sgname,$lehrbeauf, $modullist,$po[$sg_id]["sg_po"],$modulhb[$sg_id]["sg_modulhandbuch"], $semester);
      }
      
      /**
      * Diese Funktion setzt den Status einer Modulaufstellung zu einem bestimmten Studiengang
      * @param int $sg_id ID des Studienganges
      * @param string $status 
      */
      
      function setStatus($sg_id,$status)
      {
          //Manager initialieren
          $MA=new Modulaufstellung_Management;
          //Statusänderung an Manager schicken
          $result=$MA->setStatus($sg_id,$status);
          //Ergebnis an VO schicken
          $this->UM->VisualObject->showResult($result);
      }
  }
?>
