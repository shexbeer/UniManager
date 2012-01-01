<?php
  class PO_SG_edit{
      
      function PO_SG_edit($UM)
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
          
          foreach($sglist as $var)
          {
              $result[$var["sg_id"]]=$var;
              $dekan_unchecked=$PM->getDekanDetails($var["sg_dekan"]);
              $dekan_id = $var["sg_dekan"];
              $dekan=$this->UM->checkManagerResults($dekan_unchecked,"studiendekan_id","Dekanabfrage");
              //var_dump($dekan);
              $result[$var["sg_id"]]["sg_dekan"]=$dekan[$dekan_id]["person_vorname"]." ".$dekan[$dekan_id]["person_name"];
          }
          //var_dump($result);
          $this->UM->VisualObject->showSGList($result);
      }
      
      /**
        * Erstellung eines Studiengangs
        @param string $sgname Name des Studiengangs
        @param string $dekan_id Dekan ID des SG
        */
        
      function createSG($sgname,$dekan_id, $sg_typ)
      {
          //Manager initialisieren
          $SG=new SG_Management();
          
          $result=$SG->createSG($sgname, $dekan_id, $sg_typ);
          // Evtl. hier nochmal FehlerŸberprŸfung
          $this->UM->VisualObject->showResult($result, "Fehler beim Erstellen des Studiengangs");                   
      }
  
      
       /**
        * Ruft Details zu einem speziellen Studiengang ab und ergaenzt die Dekan-ID durch Vor- und Nachname des Dekans getCreateSGForm($sg_id)
        * Achtung: Dekanvor- und nachname seperat abgelegt; DekanID ist nur zum vergleichen und kann ignoriert werden.
        */
      
      function getCreateSGForm()
      {
          //Manager initialisieren
          $PM= new Person_Management();
          
          // Es werden nur die mšglichen Dekane benštigt
          $dekan_unchecked = $PM->getDekans();
          $dekans = $this->UM->checkManagerResults($dekan_unchecked,"studiendekan_id","Dekanabfrage");
          
          $this->UM->VisualObject->ShowCreateSGForm($dekans);                     
      }
      /*
      function getCreateSGForm()
      {
      	$this->UM->VisualObject->ShowCreateSGForm($detail); 
      
      }
      */
      /**
        * Ruft Details zu einem bestimmten Studiengang ab, zum Zweck der Editierung, ergaenzt Dekan_ID durch Namen aus der Datenbank
        * @param bool $posoedit Auswahl, welche Daten abgerufen werden muessen true -> siehe Sequenzdiagramm PO SO oder Aenderungsatzung abstimmen false ->   Studiengang beschliessen/Bestaetigen
        Achtung: Bei true werden von der Funktion die Studiengangdetails, Die Modulliste samt Details und die PO und SO an das VO zurueckgegeben
        Achtung: Bei false werden von der Funktion die Studiengangdetails, die PO und die SO zurueckgegeben
        * @param int $sg_id ID des Studiengangs dessen Details aufgerufen werden sollen.
        */
      function showEditSG($posoedit,$sg_id)
      {
      //print $sg_id;
          //Manager initialisieren
          $MM=new Modul_Management();
          $SG=new SG_Management();
          $PM=new Person_Management();
          //Studiengangdetails abrufen und ueberpruefen
          $sgdetail_unchecked=$SG->getSGDetails("id",$sg_id);
          $sgdetail=$this->UM->checkManagerResults($sgdetail_unchecked,"sg_id","Studiengangdetails");
          //Dekannamen zur DekanID heraussuchen und ueberpruefen
          $dekan_unchecked=$PM->getDekanDetails($sgdetail[$sg_id]["sg_dekan"]);
          $dekan=$this->UM->checkManagerResults($dekan_unchecked,"studiendekan_id","Namensabfrage");
          $dekan_id = $sgdetail[$sg_id]["sg_dekan"];
          $sgdetail = $sgdetail[$sg_id];
          //Dekanname und Vorname zum Array hinzufügen
          $sgdetail["dekanvorname"]=$dekan[$dekan_id]["person_vorname"];
          $sgdetail["dekanname"]=$dekan[$dekan_id]["person_name"];
          
          $dekan_unchecked = $PM->getDekans();
          $dekans = $this->UM->checkManagerResults($dekan_unchecked,"studiendekan_id","Dekanabfrage");
          
          // Modulliste (alle Module)
          $modul_u = $MM->getModullist(true);
          $modullist = $this->UM->checkManagerResults($modul_u,"modul_id","Modulabfrage");

		  // Moduliste (Module des SG)
		  $modul_u = $MM->getModullist(true, "sg", $sg_id);
		  $modullist_sg = $this->UM->checkManagerResults($modul_u,"modul_id","Modulabfrage");
		  //var_dump($modullist_sg);
		  if($modullist_sg) {
			  foreach($modullist_sg as $var) { // Wenn Modul im SG setze in Modulliste eine Flag
				$modullist[$var["modul_id"]]["in_SG"] = true;
				$modullist[$var["modul_id"]]["mauf_plansemester"] = $var["mauf_plansemester"];
			  }
		  }
          $this->UM->VisualObject->showALLSGContent($sgdetail, $dekans, $modullist);                 
      }
      function editSG($sgid, $sgname, $sgdekan, $sgtyp, $modulaufstellung, $modul_ps, $sgstatus, $name=false)
      {
    		$SG=new SG_Management();
    		$var = array();
    		$var["sg_id"] = $sgid;
    		$var["sg_name"] = $sgname;
    		
    		if($name) {
	    		$var["sg_po"] = $name;
    			$var["sg_so"] = $name;
    		}
    		
    		$var["sg_modulhandbuch"] = "Modul_".$sgid.".pdf";
    		$var["sg_dekan"] = $sgdekan;
    		$var["sg_status"] = $sgstatus;
    		$var["sg_typ"] = $sgtyp;
    		//var_dump($var);
    		$result = $SG->setSGDetails($var);
    
    		$new_mods = array();
    		
    		if($modulaufstellung) {
				foreach($modulaufstellung as $key => $var) {
					$new_mods[$var]["modul_id"] = $var;
					if($modul_ps[$var]) {
						$new_mods[$var]["plansemester"] = $modul_ps[$var];
					} else {
						$new_mods[$var]["plansemester"] = "1";
					}
					$new_mods[$var]["typ"] = $sgtyp;
				}
    		}
    		// Modulliste Aktualisieren
    		$result2 = $SG->setModullisteForSG($sgid, $sgtyp, $new_mods);
    		
        	$this->UM->VisualObject->showResult($result&&$result2,"&Auml;nderung des Studiengangs nicht erfolgreich.");
      }
      /**
      * Sendet neue Studiengangdetails an den SG_Manager 
      * @param int Studiengang ID
      * @param int status 1=beschlossen 2=abgestimmt 3=bestaetigt
      */
      function setSGStatus($sgid,$status)
      {
       // DEBUG: SicherheitsŸberprŸfung
          //Manager initialieren
          $SG=new SG_Management();
          switch($status) {
          	case "1":	$status="beschlossen"; break;
          	case "2":	$status="abgestimmt"; break;
          	case "3":	$status="bestaetigt"; break;
          }
          $SG->setSGStatus($sgid,$status);
          $this->UM->VisualObject->showResult(!$result,"Status&auml;nderung nicht erfolgreich");
      }
      function deleteSG($sgid) {	
         // DEBUG: SicherheitsŸberprŸfung
         
         //Manager initialisieren
          $SG=new SG_Management();
          
          $result=$SG->deleteSG($sgid);
          // Evtl. hier nochmal FehlerŸberprŸfung
          //var_dump($result);
          $this->UM->VisualObject->showResult($result, ""); 
         
      }
  }
?>
