<?php
  class PO_POSO_edit{
      
      function PO_POSO_edit($UM)
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
              $dekan=$PM->getNameForID($PM->getDekanPID($var["sg_dekan"]));
              $result[$var["sg_id"]]["sg_dekan"]=$dekan["vorname"]." ".$dekan["name"];
          }
          $this->UM->VisualObject->showSGList($result);  
      }
      
      /**
      * Holt die Vorlage für die PO und SO von dem SG-Manager und sendet diese an das VO (array mit den feldern po und so (ich gehe bis jetzt von 2 pdf dateien aus))
      *       
      */
      function editPOSO_Template()
      {
          //Manager initialieren
          $SG= new SG_Management();
          //Vorlage von Manager holen und ueberpruefen
          $vorlage_unchecked=$SG->getTamplate();
          $vorlage=$this->UM->checkManagerResults($vorlage_unchecked,"po","POSO");
          //vorlage an VO senden
          $this->UM->VisualObject->showPOSOTemplate($vorlage);
      }
      
      /**
      * Schickt die neue PO und SO an den Manager und holt eine Modulliste aus dem Manager die dann an das VO geschickt wird
      * @param int $sg_id  ID des Studienganges fuer den die PO und SO sind
      * @param mixed $poso  Array das die felder po und so enthaelt
      */
      
      function createPOSO($sg_id,$poso)
      {
          //Manager initialieren
          $SG=new SG_Management();
          $MM=new Modul_Management();
          //Falls nur SO existiert; SO auch auf PO kopieren um Datenbankfehler zu vermeiden
          if (!$poso["po"]){
              $poso["po"]=$poso["so"];
          }
          //PO und SO an Manager schicken  
          $result=$SG->setPO($sg_id,$poso["po"]);
          if ($result)
          {
              $result=$SG->setSO($sg_id,$poso["so"]);
          }
          //Modulliste holen und ueberpruefen
          $modullist_unchecked=$MM->getModullist(true);
          $modullist=$this->UM->checkManagerResults($modullist_unchecked,"modul_id","Modulliste");
          //result und liste an vo senden
          $this->UM->VisualObject->showModullistEditor($result,$modullist);
      }
      
      /**
      * Schickt eine Modulliste für einen Studiengang an den Mananger
      * @param int $sg_id ID des Studienganges für den die Modulliste gesetzt werden soll
      * @param mixed $modullist Array mit den Feldern count,modul_id, plansemester
      */
      function setModullisteForSG($sg_id,$modullist)
      {
          //Manager initialisieren
          $SG=new SG_Management();
          //Modulliste an Manager senden
          $result=$SG->setModullisteForSG($sg_id,$modullist);
          //Erfolg oder Misserfolg an VO melden
          $this->UM->VisualObject->showResult($result);
      }
  }
?>
