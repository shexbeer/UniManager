<?php
  class PO_LN_edit{
      function PO_LN_edit ($UM)
      {
          $this->UM= $UM;
      }
      /**
        * Ruft eine Liste aller existierender Leistungsnachweise ab und ersetzt Modul-IDs durch Modulnamen und Personen-IDs durch Personennamen
        ACHTUNG: Das am Ende übergebene Array hat die drei Spalten Modulname; Datum; Verantwortlicher; Modul-ID (nur zur Auswahl nötig, nicht mit anzeigen)
        */
      function initform()
      {
          //Manager initialisieren
          $MM= new Modul_Management();
          $LM= new LN_Management();
          $PM= new Person_Management();
          //Modulliste holen und checken
          $Mlist_unchecked = $MM->getModullist();
          $Mlist= $this->UM->checkManagerResults($Mlist_unchecked,"modul_id","Modulliste");
          //LN-Liste holen und checken
          $LNList_unchecked = $LM->getLNlist();
          $LNList= $this->UM->checkManagerResults($LNList_unchecked,"ln_id","LN-Liste");
          //Liste zusammensetzen, so das für jeden Leistungsnachweis der existiert das Modul und das Datum ausgegeben wird
          foreach($LNList as $var)
          {
              //Für den aktuellen LN den Modulnamen raussuchen und in Results eintragen
              $result[$var["ln_id"]]["Modulname"]= $Mlist[$var["modul_id"]]["modulname"];
              //Das Datum hinzufügen
              $result[$var["ln_id"]]["Datum"]= $var["ln_date"];
              //Verantwortliche aus der Personendatenbank raussuchen und den Resultaten hinzufügen
              $name=$PM->getNameForID($Mlist[$var["modul_id"]]["modul_person_id"]);
              $result[$var["ln_id"]]["Verantwortlicher"]=$name["vorname"]." ".$name["name"];
              $result[$var["ln_id"]]["ModulID"]=$var["modul_id"]; 
          }
          //Übergebe Tabelle an VO
          $this->UM->VisualObject->showModulList($result);          
      }
      /**
        * Ruft eine Liste aller Teilnehmer eines Leistungsnachweises eines bestimmten Moduls ab und ersetzt die StudentenID durch Matrikelnummern
        Achtung: Spaltenreihenfolge: Matrikelnummer, Anmeldedatum, Note   
        * @param int $modul_id ID des Moduls für das die Teilnehmer abgerufen werden sollen
        */
      function getTeilnehmerList($modul_id)
      {
          //Manager initialisiern
          $LM= new LN_Management();
          $PM= new Person_Management();
          //Liste aller Leistungsnachweise zu einem bestimmten modul holen und checken 
          $list_unchecked=$LM->getLNA($modul_id);
          $list= $this->UM->checkManagerResults($list_unchecked,"lna_id","Leistungsnachweise");
          //Liste aller angemeldeten Studenten zu dem entsprechenden Modul zusammenstellen Spaltenreihenfolge: Matrikelnummer, Anmeldedatum, Note
          foreach($list as $var)
          {
              //Matrikelnummer,Anmeldedatum und Note des Studenten zu den Results hinzufügen
              $result[$var["lna_id"]]["Matrikelnummer"]=$LM->getStudentDetails($var["lna_student_id"]);
              $result[$var["lna_id"]]["Anmeldedatum"]=$var["lna_registrationdate"];
              $result[$var["lna_id"]]["Note"]=$var["lna_mark"];
          }
          $this->UM->VisualObject->showLNAList($result);
      }
      /**
        * Ändert eine Note eines Studenten zu einem bestimmten Leistungsnachweis
        ACHTUNG: Alle 3 Parameter muessen angegeben werden, es erfolgt keine Pruefung auf Sinn; muss bei der Eingabe gemacht werden
        * @param int $lna_id ID des Leistungsnachweises zu dem eine Note geaendert werden soll
        * @param int $student_id ID des Studenten dessen Note geaendert werden soll
        * @param float $lna_mark Note die eingetragen werden soll 
        */
      function enterList($lna_id,$student_id,$lna_mark)
      {
        //Manager initialisiern
        $LM= new LN_Management();
        //Daten an Manager weiterleiten
        $result=$LM->setLNAGrade($lna_id,$student_id,$lna_mark); 
        //Erfolg oder Misserfolg melden 
        $this->UM->VisualObject->showResult($result);    
      }
  }
?>
