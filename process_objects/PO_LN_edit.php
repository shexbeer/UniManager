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
          $Mlist_unchecked = $MM->getModullist(true);
          $Mlist= $this->UM->checkManagerResults($Mlist_unchecked,"modul_id","Modulliste");
          //var_dump($Mlist);
          //LN-Liste holen und checken
          $LNList_unchecked = $LM->getLNlist();
          $LNList= $this->UM->checkManagerResults($LNList_unchecked,"ln_id","LN-Liste");
          //var_dump($LNList);
          //Liste zusammensetzen, so das für jeden Leistungsnachweis der existiert das Modul und das Datum ausgegeben wird
          foreach($LNList as $var)
          {
              //Für den aktuellen LN den Modulnamen raussuchen und in Results eintragen
              $result[$var["ln_id"]]["Name"]= $Mlist[$var["ln_modul_id"]]["modul_name"];
              //Das Datum hinzufügen
              $result[$var["ln_id"]]["Datum"]= $var["ln_date"];
              //Verantwortliche aus der Personendatenbank raussuchen und den Resultaten hinzufügen
              $name=$PM->getNameForID($Mlist[$var["ln_modul_id"]]["modul_person_id"]);
              $result[$var["ln_id"]]["Verantwortlicher"]=$name["vorname"]." ".$name["name"];
              $result[$var["ln_id"]]["ModulID"]=$var["ln_id"]; 
          }
          //Übergebe Tabelle an VO
          $this->UM->VisualObject->showModulList($result);          
      }
      /**
        * Ruft eine Liste aller Teilnehmer eines Leistungsnachweises eines bestimmten Moduls ab und ersetzt die StudentenID durch Matrikelnummern
        Achtung: Spaltenreihenfolge: Matrikelnummer, Anmeldedatum, Note   
        * @param int $ln_id ID des Leistungsnachweises fŸr den die Anmelder rausgesucht werden soll
        */
      function getTeilnehmerList($ln_id)
      {
          //Manager initialisiern
          $LM= new LN_Management();
          $PM= new Person_Management();
          //Liste aller Leistungsnachweise zu einem bestimmten modul holen und checken 
          $list_unchecked=$LM->getLNA($ln_id);
          $list= $this->UM->checkManagerResults($list_unchecked,"lna_id","Leistungsnachweise");
          //Liste aller angemeldeten Studenten zu dem entsprechenden Modul zusammenstellen Spaltenreihenfolge: Matrikelnummer, Anmeldedatum, Note
          foreach($list as $var)
          {
              //Matrikelnummer,Anmeldedatum und Note des Studenten zu den Results hinzufügen
              $info = $PM->getStudentDetails($var["lna_person_id"]);
              //$studentInfo = $this->UM->checkManagerResults($info, "student_personenid", "Abfrage von Studenteninfo's");
              //var_dump($info);
              $result[$var["lna_id"]]["Matrikelnummer"]=$info["student_matnr"];
              $result[$var["lna_id"]]["Anmeldedatum"]=$var["lna_registrationdate"];
              $result[$var["lna_id"]]["Note"]=$var["lna_mark"];
              $result[$var["lna_id"]]["lna_id"]=$var["lna_id"];
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
      function enterList($list)
      {
        //Manager initialisiern
        $LM= new LN_Management();
        //var_dump($list);
        $failure = false;
        foreach($list as $key => $var) {
        	$result = $LM->editLNA($key, $var);
        	if($result = false) {
        		$failure = true;
        	}
        } 
        //Erfolg oder Misserfolg melden 
        $this->UM->VisualObject->showResult($failure, "Bitte melden Sie sich bei der Software Hotline: Code 9999");    
      }
  }
?>
