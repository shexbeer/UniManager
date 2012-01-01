<?php
class PO_MA_create
{
	function PO_MA_create($UM)
	{
		// instanzierte UniManager Klasse, klassenweit verfügbar machen
		$this->UM = $UM;
	}
    
    
	function initForm()
	{
		$SG_M = new SG_Management();
		$PM = new Person_Management();
		$MA = new Modulangebot_Management();
		// Hole alle Studiengänge zum anzeigen
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
    * Diese Funktion holt sich vom Manager die Studienordnung und die Modulliste zu einem bestimmten Studiengang und die komplette Modulliste und sendet alles an das VO
    * @param int $sg_id  ID des Studienganges
    */
    
	function createMA($sg_id, $semester, $MAs)
	{
		$MM = new Modul_Management();
		$SG = new SG_Management();
		$PM = new Person_Management();
         //Modulliste zum Studiengang holen und ueberpruefen
        $modullist_unchecked=$MM->getModullist(true,"sg",$sg_id);
        $modullist=$this->UM->checkManagerResults($modullist_unchecked,"modul_id","Abrufen der Modulliste");
        
        $oddOrEven = $this->UM->checkIfOddOrEvenSemester($semester);
        foreach($modullist as $key => $var) {
        	$result[$key] = $var;
        	if($oddOrEven == "odd") {
        		if(($var["mauf_plansemester"] % 2) == 0) //odd
        		{
        			$result[$key]["plansemester_Mark"] = "true";
        		} else { // even
        			$result[$key]["plansemester_Mark"] = "false";
        		}
        	} else {
        		if(($var["mauf_plansemester"] % 2) == 1) //even
        		{
        			$result[$key]["plansemester_Mark"] = "true";
        		} else { // odd
        			$result[$key]["plansemester_Mark"] = "false";
        		}
        	}
        }
        
        $modullist = $result;
        //var_dump($modullist);
        $po=$SG->getPO($sg_id);
        
        $po = $this->UM->checkManagerResults($po, "sg_id", "Abfrage der PO");
        //var_dump($po);
        $modulhb = $SG->getModulhandbuch($sg_id);
        if($semester == $this->UM->getCurrentSemester()) {
        	$mark_semester = "1";
        } else {
        	$mark_semester = "2";
        }
        $lehrbeauf_unchecked = $PM->getLehrbeauftragte();
        $lehrbeauf = $this->UM->checkManagerResults($lehrbeauf_unchecked, "lehrbeauftr_id", "Abfrage der Lehrbeauftragten");
        
        $this->UM->VisualObject->showMAedit($sg_id,$lehrbeauf, $modullist,$po[$sg_id]["sg_po"],$modulhb[$sg_id]["sg_modulhandbuch"], $mark_semester, $MAs);
    }
    
    /**
    * Schickt die Modulaufstellung f�r einen Studiengang an den Manager
    * @param int $sg_id  ID des Studienganges
    * @param mixed $modul_aufstellung 2 dim. Array mit der Modulaufstellung enthaelt die Felder [ccunt],[modul_id,plansemester]
    * @param string $typ Art des Studiums z.B. "Bachelor","Master"
    */
    
	function setMA($sg_id,$semester,$modulliste, $lb)
	{
        //Manager initialisieren
        $MA=new Modulangebot_Management();
        
        // Events zusammenstellen
        $events = array();
        foreach($modulliste as $key => $var)
        {
			if($var != "") {
				if($semester == 1) $events[$key]["semester"] = $this->UM->getCurrentSemester();
				else $events[$key]["semester"] = $this->UM->getNextSemester();
				
				$events[$key]["time"] = "07:30:00";
				$events[$key]["weekday"] = "Montag";
				$events[$key]["week"] = "jede";
				$events[$key]["lb"] = $lb;
				
				$events[$key]["modul"] = $var;
			}
        }
        //Modulaufstellung an Manager senden
        $result=$MA->setModulangebotPerSG($sg_id,$events);
        //Erfolg oder Misserfolg an VO melden
        $this->UM->VisualObject->showResult($result, "Modulangebot setzen war nicht erfolgreich");
	}
}
?>