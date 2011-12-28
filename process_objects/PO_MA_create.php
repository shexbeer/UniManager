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
		$PM = new Person_Management();
		// Hole alle StudiengÃ¤nge zum anzeigen
		$sg = $SG_M->getSGList();
		$sglist = $this->UM->checkManagerResults($sg, "sg_id", "Abfrage der Studiengaenge");
		
		foreach($sglist as $var)
        {
              $result[$var["sg_id"]]=$var;
              $dekan_unchecked=$PM->getDekanDetails($var["sg_dekan"]);
              $dekan_id = $var["sg_dekan"];
              $dekan=$this->UM->checkManagerResults($dekan_unchecked,"studiendekan_id","Dekanabfrage");
              //var_dump($dekan);
              $result[$var["sg_id"]]["sg_dekan"]=$dekan[$dekan_id]["person_vorname"]." ".$dekan[$dekan_id]["person_name"];
        }
        $semester = $this->UM->getNextSemester();
		$this->UM->VisualObject->showSGList($result,$semester);
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
        foreach($modul_aufstellung as $var)
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