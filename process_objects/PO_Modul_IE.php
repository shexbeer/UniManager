<?php
    class PO_Modul_IE {
        function PO_Modul_IE($UM)
        {
            $this->UM= $UM;
            //instanzierte Klasse Unimanager klassenweit verfuegbar machen
        }
        function initform()
        {
            $MM = new Modul_Management();
            //neue Instanz der Klasse erschaffen
            $mList = $MM->getModullist();
            //Modulliste beschaffen
            $mDetails = $MM->getModuldetails();
            //Moduldetails beschaffen

            $this->UM->VisualObject->showModulList($mList, $mDetails);
            //VO zur Abfrage aufrufen
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