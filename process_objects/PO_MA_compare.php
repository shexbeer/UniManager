<?php
  class PO_MA_compare {
      function PO_MA_compare ($UM)
      {
          $this->UM= $UM;
      }
      function initform()
      {
			$SG_M = new SG_Management();
			$PM = new Person_Management();
			$MA = new Modulangebot_Management();
			// Hole alle Studieng√§nge zum anzeigen
			$sg = $SG_M->getSGList();
			$sglist = $this->UM->checkManagerResults($sg, "sg_id", "Studiengaenge");
			
			$currentSemester = $this->UM->getCurrentSemester();
			$nextSemester = $this->UM->getNextSemester();
			foreach($sglist as $var)
			{
				  $result[$var["sg_id"]]=$var;
				  $dekan_unchecked=$PM->getDekanDetails($var["sg_dekan"]);
				  $dekan_id = $var["sg_dekan"];
				  $dekan=$this->UM->checkManagerResults($dekan_unchecked,"studiendekan_id","Dekanabfrage");
				  $result[$var["sg_id"]]["sg_dekan"]=$dekan[$dekan_id]["person_vorname"]." ".$dekan[$dekan_id]["person_name"];
	
				  //var_dump($dekan);
				  if($MA->checkModulangebotForSG($var["sg_id"], $currentSemester) != false) 
					$result[$var["sg_id"]]["MA_curr"] = true;
				  else
					$result[$var["sg_id"]]["MA_curr"] = false;
					
				  if($MA->checkModulangebotForSG($var["sg_id"], $nextSemester) != false) 
					$result[$var["sg_id"]]["MA_next"] = true;
				  else
					$result[$var["sg_id"]]["MA_next"] = false;
					
				
			}
			
			$this->UM->VisualObject->showSGList($result);        
      }
      function getSG($sg_id, $semesterShort)
      {
      		$MM = new Modul_Management();
			$SG = new SG_Management();
			$PM = new Person_Management();
			$MA = new Modulangebot_Management();
			
			if($semesterShort == 1) {
        		$semester = $this->UM->getCurrentSemester();
        	} else {
        		$semester = $this->UM->getNextSemester();
       		}
       		$sgtyp_unch = $SG->getSGTypForID($sg_id);
	        $sgtyp = $this->UM->checkManagerResults($sgtyp_unch, "sg_id", "Studiengangtyps");
    	    $sgtyp = $sgtyp[$sg_id]["sg_typ"];
    	    
			$sgname_unch = $SG->getSGNameforID($sg_id);
			$sgname = $this->UM->checkManagerResults($sgname_unch, "sg_id", "Studiengangnames");
			$sgname = $sgname[$sg_id]["sg_name"];
			//Modulangebot derzeitiges Semester  	
			$modulangebot_unchecked = $MA->getModulangebot($sg_id, $semester, $sgtyp);
			$modulangebot = $this->UM->checkManagerResults($modulangebot_unchecked,"modul_id", "Modulangebots");
			
			//Modulliste zum Studiengang holen und ueberpruefen
			//$modullist_unchecked=$MM->getModullist(true,"sg",$sg_id);
			//$modullist=$this->UM->checkManagerResults($modullist_unchecked,"modul_id","Modulliste");
			
			$bedarf = $MA->getBedarf($sg_id, $semester);
			
			if(!$bedarf) $modullist = array();
			if(!$modulangebot) $modulangebot = array();
			$key1 = array_keys($modulangebot);
			$key2 = array_keys($bedarf);
			$both = array_merge($key2, $key1);
			//sort($both);
			foreach($both as $var) {
				$compareList[$var]["modulangebot"] = $modulangebot[$var];
				$compareList[$var]["bedarf"] = $bedarf[$var];
				if(!in_array($var, $key2)) 
					$compareList[$var]["modulangebot"]["onlyInMA"] = "true";
			}
			$lehrbeauf_unchecked = $PM->getLehrbeauftragte();
	        $lehrbeauf = $this->UM->checkManagerResults($lehrbeauf_unchecked, "lehrbeauftr_id", "Lehrbeauftragten");
	        // Lehrbeauftragter für Modulangebot
			$ma_id = $MA->checkModulangebotForSG($sg_id, $semester);
			$lb_unchecked = $MA->getLehrbeauftragterForMA($ma_id);
			$lb_ma = $this->UM->checkManagerResults($lb_unchecked, "ma_count", "Lehrbeauftragten für diese Modulaufstellung");
	        $lb_ma = $lb_ma[$ma_id];

			$sg["id"] = $sg_id;
			$sg["name"] = $sgname;
			$sg["typ"] = $sgtyp;
			
			reset($modulangebot);
			$firstKey = key($modulangebot);
			$sg["ma_status"] = utf8_encode($modulangebot[$firstKey]["ma_status"]);
			//echo $sg["ma_status"];
			$this->UM->VisualObject->showCompareList($sg, $semester, $compareList, $lehrbeauf, $lb_ma);
      }
      function changeSGModulA($sg_id,$semester,$modulliste, $lb, $ma_status)
      {
			//Manager initialisieren
			$MA=new Modulangebot_Management();
			// Events zusammenstellen
			$events = array();
			foreach($modulliste as $key => $var)
			{
				if($var != "") {
					$events[$key]["semester"] = $semester;
					
					$events[$key]["time"] = "07:30:00";
					$events[$key]["weekday"] = "Montag";
					$events[$key]["week"] = "jede";
					$events[$key]["lb"] = $lb;
					
					$events[$key]["modul"] = $var;
				}
			}
			//Modulaufstellung an Manager senden
			$result=$MA->setModulangebotPerSG($sg_id,$events);
			if($result) {
				$MA->setModulangebotStatus($ma_status, $semester, $sg_id);
			}
			//Erfolg oder Misserfolg an VO melden
			$this->UM->VisualObject->showResult($result, "Modulangebot setzen war nicht erfolgreich");
		  }
      function checkWholeModulA()
      {
      
      }
  }
?>
