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
		// Hole alle Studiengänge zum anzeigen
		$sg = $SG_M->getSGList();
		$sglist = $this->UM->checkManagerResults($sg, "sg_id", "Studiengaenge");
		
		foreach($sglist as $var)
        {
              $result[$var["sg_id"]]=$var;
              $dekan_unchecked=$PM->getDekanDetails($var["sg_dekan"]);
              $dekan_id = $var["sg_dekan"];
              $dekan=$this->UM->checkManagerResults($dekan_unchecked,"studiendekan_id","Dekanabfrage");
              $result[$var["sg_id"]]["sg_dekan"]=$dekan[$dekan_id]["person_vorname"]." ".$dekan[$dekan_id]["person_name"];

              //var_dump($dekan);
              if($MA->checkModulangebotForSG($var["sg_id"], $this->UM->getCurrentSemester()) != false) 
              	$result[$var["sg_id"]]["MA_curr"] = true;
              else
                $result[$var["sg_id"]]["MA_curr"] = false;
                
              if($MA->checkModulangebotForSG($var["sg_id"], $this->UM->getNextSemester()) != false) 
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
      	// Manager 
      	$MM = new Modul_Management();
		$SG = new SG_Management();
		$PM = new Person_Management();
		$MA = new Modulangebot_Management();
		  
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
        $lehrbeauf = $this->UM->checkManagerResults($lehrbeauf_unchecked, "lehrbeauftr_id", "Lehrbeauftragten");
        
        $sgname_unch = $SG->getSGNameforID($sg_id);
        $sgname = $this->UM->checkManagerResults($sgname_unch, "sg_id", "Studiengangnames");
        $sgname = $sgname[$sg_id]["sg_name"];
        
        $sgtyp_unch = $SG->getSGTypForID($sg_id);
        $sgtyp = $this->UM->checkManagerResults($sgtyp_unch, "sg_id", "Studiengangtyps");
        $sgtyp = $sgtyp[$sg_id]["sg_typ"];
        
		//Modulangebot derzeitiges Semester  	
		$modulangebot_unchecked = $MA->getModulangebot($sg_id, $semester, $sgtyp);
		$modulangebot = $this->UM->checkManagerResults($modulangebot_unchecked,"modul_id", "Modulangebots");
		
         //Modulliste zum Studiengang holen und ueberpruefen
        $modullist_unchecked=$MM->getModullist(true,"sg",$sg_id);
        $modullist=$this->UM->checkManagerResults($modullist_unchecked,"modul_id","Modulliste");
        $oddOrEven = $this->UM->checkIfOddOrEvenSemester($semester);
        foreach($modullist as $key => $var) 
        {
        	if($modulangebot[$var["modul_id"]]["modul_id"] == "") // Nur wenn Modul noch nicht im Modulangebot
        	{
        		if($oddOrEven == "odd") 
        		{
        			if(($var["mauf_plansemester"] % 2) == 0) //odd
        			{
        				$result[$key] = $var;
        			}
        		} else {
        			if(($var["mauf_plansemester"] % 2) == 1) //even
        			{
        				$result[$key] = $var;
        			}
        		}
        	}
        }
        
        $modullist = $result;
		
		// Lehrbeauftragter f�r Modulangebot
		$ma_id = $MA->checkModulangebotForSG($sg_id, $semester);
		$lb_unchecked = $MA->getLehrbeauftragterForMA($ma_id);
		$lb_ma = $this->UM->checkManagerResults($lb_unchecked, "ma_count", "Lehrbeauftragten f�r diese Modulaufstellung");
        $lb_ma = $lb_ma[$ma_id];
        
        reset($modulangebot);
		$firstKey = key($modulangebot);
		$ma_status = $modulangebot[$firstKey]["ma_status"];
        
        $this->UM->VisualObject->showModulaufstellung($sg_id,$sgname,$sgtyp,$lehrbeauf,$lb_ma, $modullist,$modulangebot,$po[$sg_id]["sg_po"],$modulhb[$sg_id]["sg_modulhandbuch"], $semester,$ma_status);
      }
      
      /**
    * Schickt die Modulaufstellung f�r einen Studiengang an den Manager
    * @param int $sg_id  ID des Studienganges
    * @param mixed $modul_aufstellung 2 dim. Array mit der Modulaufstellung enthaelt die Felder [ccunt],[modul_id,plansemester]
    * @param string $typ Art des Studiums z.B. "Bachelor","Master"
    */
    
	function setMA($sg_id,$semester,$modulliste, $lb, $ma_status)
	{
        //Manager initialisieren
        $MA=new Modulangebot_Management();
        // Events zusammenstellen
        $events = array();
        foreach($modulliste as $key => $var)
        {
        	$events[$key]["semester"] = $semester;
        	
            $events[$key]["time"] = "07:30:00";
            $events[$key]["weekday"] = "Montag";
			$events[$key]["week"] = "jede";
            $events[$key]["lb"] = $lb;
            
            $events[$key]["modul"] = $var;
        }
        //Modulaufstellung an Manager senden
        $result=$MA->setModulangebotPerSG($sg_id,$events);
        if($result) {
	        $MA->setModulangebotStatus($ma_status, $semester, $sg_id);
	    }
        //Erfolg oder Misserfolg an VO melden
        $this->UM->VisualObject->showResult($result, "Modulangebot setzen war nicht erfolgreich");
	}
  }
?>
