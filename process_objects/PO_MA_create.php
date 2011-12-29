<?php
class PO_MA_create
{
	function PO_MA_create($UM)
	{
		// instanzierte UniManager Klasse, klassenweit verfÃ¼gbar machen
		$this->UM = $UM;
	}
    
    
	function initForm()
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
    * Diese Funktion holt sich vom Manager die Studienordnung und die Modulliste zu einem bestimmten Studiengang und die komplette Modulliste und sendet alles an das VO
    * @param int $sg_id  ID des Studienganges
    */
    
	function createMA($sg_id, $semester)
	{
        /* Modul edit???? 
        //Manager initialisieren
    	$SG=new SG_Management();
        $MM = new Modul_Management();
        $MA = new Modulangebot_Management();
        $PM = new Person_Management();
        
        $so=$SG->getPO($sg_id);
        // Fehlt noch ne Fehlerpruefung
        //Modulliste zum Studiengang holen und ueberpruefen
        $modullist_unchecked=$MM->getModullist(true,"sg",$sg_id);
        $modullist=$this->UM->checkManagerResults($modullist_unchecked,"modul_id","Abrufen der Modulliste");
        
        //Modulangebot derzeitiges Semester
        $modulangebot_unchecked = $MA->getModulangebot($sg_id, $this->UM->getCurrentSemester());
        $modulangebot = $this->UM->checkManagerResults($modulangebot_unchecked,"count", "Abrufen des Modulangebots");
        
        
        foreach($modulangebot as $key => $var) {
        echo $var["lb"];
        	$lb_unchecked = $PM->getLehrbeauftrDetails($var["event"]["lb"]);
        	$lb = $this->UM->checkManagerResults($lb_unchecked, "lehrbeauftr_id", "Abfrage des Lehrbeauftragten");
        	//var_dump($lb);
        	//var_dump($lb[$var["event"]["lb"]]["person_vorname"]);
        	$result[$key]=$var;
        	$result[$key]["lb_name"] = $lb[$var["event"]["lb"]]["person_vorname"]." ".$lb[$var["event"]["lb"]]["person_name"];
        	$result[$key]["modul"] = $modullist[$var["event"]["modul"]]["modul_name"];
        }
        var_dump($result);
        */
		$MM = new Modul_Management();
		$SG=new SG_Management();
         //Modulliste zum Studiengang holen und ueberpruefen
        $modullist_unchecked=$MM->getModullist(true,"sg",$sg_id);
        $modullist=$this->UM->checkManagerResults($modullist_unchecked,"modul_id","Abrufen der Modulliste");
        
        $oddOrEven = $this->UM->checkIfOddOrEvenSemester($semester);
        $result = array();
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
        if($semester == $this->UM->getCurrentSemester()) {
        	$mark_semester = "1";
        } else {
        	$mark_semester = "2";
        }
        
        
        $this->UM->VisualObject->showMAedit($sg_id,$modullist,$po[$sg_id]["sg_po"],$modulhb[$sg_id]["sg_modulhandbuch"], $mark_semester);
    }
    
    /**
    * Schickt die Modulaufstellung für einen Studiengang an den Manager
    * @param int $sg_id  ID des Studienganges
    * @param mixed $modul_aufstellung 2 dim. Array mit der Modulaufstellung enthaelt die Felder [ccunt],[modul_id,plansemester]
    * @param string $typ Art des Studiums z.B. "Bachelor","Master"
    */
    
	function setMA($sg_id,$modul_aufstellung,$typ)
	{
        //Manager initialisieren
        $MA=new Modulaufstellung_Management();
        //zusätzliche spalten hinzufügen damit manager es nur noch eintragen muss in DB
        foreach($modul_aufstellung as $var)
        {
            $var["mauf_sg_id"]=$sg_id;
            $var["mauf_typ"]=$typ;
        }
        //Modulaufstellung an Manager senden
        $result=$MA->setModulaufstellung($sg_id,$modul_aufstellung);
        //Erfolg oder Misserfolg an VO melden
        $this->UM->VisualObject->showResult($result);
	}
}
?>