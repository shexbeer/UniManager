<?php
    class PO_Modul_IE {
        function PO_Modul_IE($UM)
        {
            //instanzierte Klasse Unimanager klassenweit verfuegbar machen
            $this->UM= $UM;
        }
        function initform()
        {
            //neue Instanz der Klasse erschaffen
            $MM = new Modul_Management();
            $PM = new Person_Management();
            //Moduldetails beschaffen
            $mDetails = $MM->getModuldetails();
            $modDetails = $this->UM->checkManagerResults($mDetails, "modul_id", "Modul Details");
            
            // Es wŠre nur der Verantwortliche noch auszutauschen da da nur eine ID drinsteht
            foreach($modDetails as $var) {
            	$verantwortlicher_id = $var["modul_person_id"];
            	// Abfrage des Richtigen Namens der Verantwortlichen ID und ŸberprŸfen der ManagerDaten auf Fehler
            	$res = $PM->getNameForID($verantwortlicher_id);
            	$res_cropped = $this->UM->checkManagerResults($res, "id", "Personen");
            	   
            	// GrundsŠtzlich ersteinmal alles was in $modDetails drinsteht wieder nach $results rein
            	$result[$var["modul_id"]] = $var;
            	// Vorsichtshalber wird das ID Feld ausgetauscht mit dem Richtigen Namen aber auch ein Neues Feld erstellt um bei den VO Machern jegliche Dummheiten auszuschlie§en ;)
            	$result[$var["modul_id"]]["verantwortlicher"] = $res_cropped[$verantwortlicher_id]["vorname"]." ".$res_cropped[$verantwortlicher_id]["name"];
            	$result[$var["modul_id"]]["modul_person_id"] = $res_cropped[$verantwortlicher_id]["vorname"]." ".$res_cropped[$verantwortlicher_id]["name"];
            }
			// Ÿbergebe Ausgabefertige Daten an VO
            $this->UM->VisualObject->showModulList($result);
        }
        function changemodul($modul_id)
        {
            $MM = new Modul_Management();
            $PM = new Person_Management();
            // Moduldetails zum speziellen Modul holen
            $re = $MM->setModuldetails($modul_id);
            //Prüfen
            $result = $this->UM->checkManagerResults($re,"modul_id", "Modul Details");
            // Verantwortlichen-ID zu Namen auflösen
            $verantwortlicher_id = $result["modul_person_id"];
            $res = $PM->getNameForID($verantwortlicher_id);
            //Prüfen
            $res_cropped = $this->UM->checkManagerResults($res,"id", "Personen");
            //Namen in result einfügen und ID durch Namen ersetzen (siehe oben)
            $result["verantwortlicher"] = $res_cropped["vorname"]." ".$res_cropped["name"];
            $result["modul_person_id"] = $res_cropped["vorname"]." ".$res_cropped["name"];
            // Übergebe ausgabefertige Daten an VO
            $this->UM->VisualObject->showModulDetails($result);
            
             
        }
        function setmodulstatus($modul_id,$status)
        {
            $MM = new Modul_Management();
            // Status und ModulID an Modulmanager schicken
            $result = $MM->setModulStatus($modul_id,$status);
            // Erfolg oder Misserfolg im VO melden
            $this->UM->VisualObject->showResult($result); 
        }
    }
?>