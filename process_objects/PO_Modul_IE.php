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
            //Modulliste beschaffen  --> shex: NICHT notwendig, Alle informationen sind bereits im Moduldatails vorhanden
            //$mList = $MM->getModullist();
            //$modList = $this->UM->checkManagerResults($mList, "modul_id", "Module");
            //Moduldetails beschaffen
            $mDetails = $MM->getModuldetails();
            $modDetails = $this->UM->checkManagerResults($mDetails, "modul_id", "Modul Details");
            
            // Es wŠre nur der Verantwortliche noch auszutauschen da da nur eine ID drinsteht
            foreach($modDetails as $var) {
            	$verantwortlicher_id = $var["modul_person_id"];
            	// Abfrage des Richtigen Namens der Verantwortlichen ID und ŸberprŸfen der ManagerDaten auf Fehler
            	$res = $PM->getNameForID($verantwortlicher_id);
            	$res_cropped = $this->UM->checkManagerResults($res, "id", "Personen Abfrage");
            	
            	// GrundsŠtzlich ersteinmal alles was in $modDetails drinsteht wieder nach $results rein
            	$result[$var["modul_id"]] = $var;
            	// Vorsichtshalber wird das ID Feld ausgetauscht mit dem Richtigen Namen aber auch ein Neues Feld erstellt um bei den VO Machern jegliche Dummheiten auszuschlie§en ;)
            	$result[$var["modul_id"]]["verantwortlicher"] = $res_cropped[$verantwortlicher_id]["vorname"]." ".$res_cropped[$verantwortlicher_id]["name"];
            	$result[$var["modul_id"]]["modul_person_id"] = $res_cropped[$verantwortlicher_id]["vorname"]." ".$res_cropped[$verantwortlicher_id]["name"];
            }
			// Ÿbergebe Ausgabefertige Daten an VO Objekt
            $this->UM->VisualObject->showModulList($result);
        }
        function changemodul()
        {
            //Kommt noch Übergabevariablen sind mir noch nicht ganz klar 
        }
        function setmodulstatus($modul_id)
        {
            //Späterer USECASE
        }
    }
?>