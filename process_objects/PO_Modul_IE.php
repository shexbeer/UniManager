<?php
    class PO_Modul_IE_Controller {
        function PO_Modul_IE_Controller($UM)
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
            $this->UM->tpl->assign("modullist",$mList);
            //Liste zum Template assignen
            $this->UM->tpl->assign("modetails",$mDetails);
            //Details zum Template assignen
            $this->UM->VisualObject->showmodullist($mList);
            $this->UM->VisualObject->showmoduldetails($mDetails);
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