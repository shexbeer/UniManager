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
            
            // Es w�re nur der Verantwortliche noch auszutauschen da da nur eine ID drinsteht
            // Daf�r muesste aber der Personen Manager existieren um diese ID in einen Namen umzuwandeln

			// �bergebe Ausgabefertige Daten an VO Objekt
            $this->UM->VisualObject->showModulList($modDetails);
        }
        function changemodul()
        {
            //Kommt noch �bergabevariablen sind mir noch nicht ganz klar 
        }
        function setmodulstatus($modul_id)
        {
            //Sp�terer USECASE
        }
    }
?>