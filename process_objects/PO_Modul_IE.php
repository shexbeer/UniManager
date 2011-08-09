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
            //Modulliste beschaffen  --> shex: NICHT notwendig, Alle informationen sind bereits im Moduldatails vorhanden
            //$mList = $MM->getModullist();
            //$modList = $this->UM->checkManagerResults($mList, "modul_id", "Module");
            //Moduldetails beschaffen
            $mDetails = $MM->getModuldetails();
            $modDetails = $this->UM->checkManagerResults($mDetails, "modul_id", "Modul Details");
            
            // Es wŠre nur der Verantwortliche noch auszutauschen da da nur eine ID drinsteht
            // DafŸr muesste aber der Personen Manager existieren um diese ID in einen Namen umzuwandeln

			// Ÿbergebe Ausgabefertige Daten an VO Objekt
            $this->UM->VisualObject->showModulList($modDetails);
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