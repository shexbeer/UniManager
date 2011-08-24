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
		// Hole alle StudiengÃ¤nge zum anzeigen
		$sg = $SG_M->getSGList();
		$sg_edited = $this->UM->checkManagerResults($sg, "id", "Studiengaenge");
		$this->UM->VisualObject->showSGList($sg_edited);
	}
    
    /**
    * Diese Funktion holt sich vom Manager die Studienordnung und die Modulliste zu einem bestimmten Studiengang und die komplette Modulliste und sendet alles an das VO
    * @param int $sg_id  ID des Studienganges
    */
    
	function createMA($sg_id)
	{
        //Manager initialisieren
        $SG=new SG_Management();
        $MM=new Modul_Management();
        $so=$SG->getSO($sg_id);
        // Fehlt noch ne Fehlerpruefung
        //Modulliste zum Studiengang holen und ueberpruefen
        $modullist_unchecked=$MM->getModullist(true,"sg",$sg_id);
        $modullist=$this->UM->checkManagerResults($modullist_unchecked,"modul_id","Modulliste");
        //komplette Modulliste holen und ueberpruefen
        $modullist_all_unchecked=$MM->getModullist(true);
        $modullist_all=$this->UM->checkManagerResults($modullist_all_unchecked,"modul_id","Modulliste");
        //SO und Modulliste zum Studiengang und komplette Modulliste an VO senden
        $this->UM->VisualObject->showMAedit($so,$modullist,$modullist_all);
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
        foreach($modul_aufstellung as &$var)
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