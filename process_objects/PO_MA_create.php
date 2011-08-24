<?php
class PO_MA_create
{
	function PO_MA_create($UM)
	{
		// instanzierte UniManager Klasse, klassenweit verfügbar machen
		$this->UM = $UM;
	}
    
    
	function initForm()
	{
		$SG_M = new SG_Management();
		// Hole alle Studiengänge zum anzeigen
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
    * Schickt die Modulaufstellung f�r einen Studiengang an den Manager
    * @param int $sg_id  ID des Studienganges
    * @param mixed $modul_aufstellung Array mit der Modulaufstellung enthaelt die Felder count,modul_id,plansemester
    */
    
	function setMA($sg_id,$modul_aufstellung)
	{
        //Manager initialisieren
        $SG=new SG_Management();
        //Modulaufstellung an Manager senden
        $result=$SG->setModullisteForSG($sg_id,$modul_aufstellung);
        //Erfolg oder Misserfolg an VO melden
        $this->UM->VisualObject->showResult($result);
	}
}
?>