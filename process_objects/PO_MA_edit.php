<?php
  class PO_MA_edit{
      
      function PO_MA_edit($UM)
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
              $pid_unchecked=$PM->getDekanPID($var["sg_dekan"]);
              $pid=$this->UM->checkManagerResults($pid_unchecked,"pid","PersonenID");
              $dekan_unchecked=$PM->getNameForID($pid);
              $dekan=$this->UM->checkManagerResults($dekan_unchecked,"id","Namensabfrage");
              $result[$var["sg_id"]]["sg_dekan"]=$dekan["vorname"]." ".$dekan["name"];
          }
          $this->UM->VisualObject->showSGList($result);
          
      }
      
      
      /**
      * Diese Funktion ruft den Status des Modulangebotes zu einem Studiengang und die Modulaufstellung ab und ergänzt Modul-IDs durch Modulnamen und SG-IDs durch SG Namen
      * @param int $sg_id  ID des Studienganges
      */
      function getModulangebot($sg_id)
      {
          //Manager initialisieren
          $MA=new Modulaufstellung_Management;
          $MM=new Modul_Management();
          $SG=new SG_Management();
          //Status des Modulangebotes zum Studiengang abrufen
          $status=$MA->getStatus($sg_id);
          //Fehlerueberpruefung fehlt noch
          //Modulaufstellung holen und ueberpruefen
          $modullist_unchecked=$MA->getModulaufstellung($sg_id);
          $modullist_unchanged=$this->UM->checkManagerResults($modullist_unchecked,"mauf_rowid","Modulaufstellung");
          //Studiengangname heraussuchen
          $sgang_unchecked=$SG->getSGlist("id",$sg_id);
          $sgang=$this->UM->checkManagerResults($sgang_unchecked,"sg_id","Studiengang");
          //Modulnamen einfügen (zusätzlich zu den IDs) und Studiengangnamen einfügen
          foreach($modullist_unchanged as $var)
          {
              //Modulnamen abfragen und pruefen
              $modul_unchecked=$MM->getModullist(true,"modul",$var["mauf_modul_id"]);
              $modul=$this->UM->checkManagerResults($modul_unchecked,"modul_id","Modulabfrage");
              //Datensatz ins Zielarray eintragen und Modulname und Studiengangname hinzufügen
              $modullist[$var["mauf_rowid"]]=$var;
              $modullist[$var["mauf_rowid"]]["Modulname"]=$modul["modul_name"];
              $modullist[$var["mauf_rowid"]]["Studiengangname"]=$sgang["sg_name"];              
          }
          //Daten ans VO senden
          $this->UM->VisualObject->showModulaufstellungList($modullist);
      }
      
      /**
      * Diese Funktion setzt den Status einer Modulaufstellung zu einem bestimmten Studiengang
      * @param int $sg_id ID des Studienganges
      * @param string $status 
      */
      
      function setStatus($sg_id,$status)
      {
          //Manager initialieren
          $MA=new Modulaufstellung_Management;
          //Statusänderung an Manager schicken
          $result=$MA->setStatus($sg_id,$status);
          //Ergebnis an VO schicken
          $this->UM->VisualObject->showResult($result);
      }
  }
?>
