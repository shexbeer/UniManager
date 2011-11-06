<?php
  class PO_SG_edit{
      
      function PO_SG_edit($UM)
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
              $dekan_unchecked=$PM->getDekanDetails($var["sg_dekan"]);
              $dekan_id = $var["sg_dekan"];
              $dekan=$this->UM->checkManagerResults($dekan_unchecked,"studiendekan_id","Dekanabfrage");
              //var_dump($dekan);
              $result[$var["sg_id"]]["sg_dekan"]=$dekan[$dekan_id]["person_vorname"]." ".$dekan[$dekan_id]["person_name"];
          }
          //var_dump($result);
          $this->UM->VisualObject->showSGList($result);
      }
      
      /**
        * Wandelt Vor und Nachnamen des Dekans in eine Dekan-ID um und schickt saemtliche erhaltenen Daten an den SG-Manager damit sie in die DB eingetragen werden createSG($sgname,$sg_po,$sg_so,$sgmhb,$dekanvn,$dekanname)
        Achtung: Dekanvor- und nachnamen getrennt eingeben!!
        @param string $sgname Name des Studiengangs
        @param string $sg_po Pruefungsordnung des Studienganges
        @param string $sg_so Studienordnung des Studienganges
        @param string $sgmhb Modulhandbuch des Studienganges
        @param string $dekanvn Vorname des Dekans des Studienganges
        @param string $dekanname Nachname des Dekans des Studienganges
        */
        
      function createSG($sgname,$sg_po,$sg_so,$sgmhb,$dekanvn,$dekanname)
      {
          //Manager initialisieren
          $SG=new SG_Management();
          $PM=new Person_Management();
          //Dekannamen und vornamen in ein Array packen
          $person["vorname"]=$dekanvn;
          $person["name"]=$dekanname;
          //Personen-ID zum Namen raussuchen und Ergebnis ueberpruefen
          $pid_unchecked=$PM->getPIDForName($person);
          $pid=$this->UM->checkManagerResults($pid_unchecked,"pid","Personen-ID");
          //Dekan-ID zur Personen-ID raussuchen und Ergebnis ueberpruefen
          $dekan_unchecked=$PM->getDekanID($pid);
          $dekan=$this->UM->checkManagerResults($dekan_unchecked,"dekan_id","Dekan-ID");
          //Daten an den SG-Manager weiterleiten und Ergebnis zum VO schicken
          $result=$SG->createSG($sgname,$sg_po,$sg_so,$sgmhb,$dekan);
          $this->UM->VisualObject->showResult($result);                   
      }
  
      
       /**
        * Ruft Details zu einem speziellen Studiengang ab und ergaenzt die Dekan-ID durch Vor- und Nachname des Dekans getCreateSGForm($sg_id)
        Achtung: Dekanvor- und nachname seperat abgelegt; DekanID ist nur zum vergleichen und kann ignoriert werden.
        * @param int $sg_id ID des Studiengangs dessen Details aufgerufen werden sollen.
        */
      function getCreateSGForm($sg_id)
      {
          //Manager initialisieren
          $SG= new SG_Management();
          $PM= new Person_Management();
          //Studiengangdetails abfragen und ueberpruefen
          $detail_unchecked=$SG->getSGDetails($sg_id);
          $detail=$this->UM->checkManagerResults($detail,"sg_id","Studiengangdetails");
          //Dekan-ID substituieren durch Namen und Vornamen
          $pid_unchecked=$PM->getDekanPID($detail["sg_dekan"]);
          $pid=$this->UM->checkManagerResults($pid_unchecked,"pid","PersonenID");
          $dekan_unchecked=$PM->getNameForID($pid);
          $dekan=$this->UM->checkManagerResults($dekan_unchecked,"id","Namensabfrage");
          $detail["dekanvorname"]=$dekan["vorname"];
          $detail["dekanname"]=$dekan["name"];
          //Details ans VO schicken
          $this->UM->VisualObject->ShowCreateSGForm($detail);                     
      }
      
      /**
        * Ruft Details zu einem bestimmten Studiengang ab, zum Zweck der Editierung, ergaenzt Dekan_ID durch Namen aus der Datenbank
        * @param bool $posoedit Auswahl, welche Daten abgerufen werden muessen true -> siehe Sequenzdiagramm PO SO oder Aenderungsatzung abstimmen false ->   Studiengang beschliessen/Bestaetigen
        Achtung: Bei true werden von der Funktion die Studiengangdetails, Die Modulliste samt Details und die PO und SO an das VO zurueckgegeben
        Achtung: Bei false werden von der Funktion die Studiengangdetails, die PO und die SO zurueckgegeben
        * @param int $sg_id ID des Studiengangs dessen Details aufgerufen werden sollen.
        */
      function editSG($posoedit,$sg_id)
      {
      //print $sg_id;
          //Manager initialisieren
          $MM=new Modul_Management();
          $SG=new SG_Management();
          $PM=new Person_Management();
          //Studiengangdetails abrufen und ueberpruefen
          $sgdetail_unchecked=$SG->getSGDetails("id",$sg_id);
          $sgdetail=$this->UM->checkManagerResults($sgdetail_unchecked,"sg_id","Studiengangdetails");
          //Dekannamen zur DekanID heraussuchen und ueberpruefen
          $dekan_unchecked=$PM->getDekanDetails($sgdetail[$sg_id]["sg_dekan"]);
          $dekan=$this->UM->checkManagerResults($dekan_unchecked,"studiendekan_id","Namensabfrage");
          $dekan_id = $sgdetail[$sg_id]["sg_dekan"];
          $sgdetail = $sgdetail[$sg_id];
          //Dekanname und Vorname zum Array hinzufügen
          $sgdetail["dekanvorname"]=$dekan[$dekan_id]["person_vorname"];
          $sgdetail["dekanname"]=$dekan[$dekan_id]["person_name"];
          /* nicht noetig da PO und SO in den Details enthalten sein sollten
          //Prüfungsordnung und Studienordnung holen und ueberpruefen
          $po_unchecked=$SG->getPO($sg_id);
          $po=$this->UM->checkManagerResults($po_unchecked,"po","Pruefungsordnung");
          $so_unchecked=$SG->getSO($sg_id);
          $so=$this->UM->checkManagerResults($so_unchecked,"so","Studienordnung");
          */
          //Auswahl treffen, welcher UseCase grad vorliegt, siehe Achtung in der Funktionsbeschreibung
          if($posoedit)
          {
              //Liste aller Module dieses SG inklusive Details abrufen
              $modullist_unchecked=$MM->getModuldetails(true,"sg",$sg_id);
              $modullist_unchanged=$this->UM->checkManagerResults($modullist_unchecked,"modul_id","Modulliste+Details");
              //Zaehler für Modulliste auf 0 setzen
              $count=0;#
              //Für jedes Modul die Verantwortlichen-ID um den Vornamen und Namen des Verantwortlichen ergaenzen
              foreach($modullist_unchanged as $var)
              {
                  //Bisherige Moduldetails in das Endarray schieben
                  $modullist[$count]=$var;
                  //Namen und Vornamen zur PID aus der Datenbank suchen und ueberpruefen und dann ins Array schreiben
                  $person_unchecked=$PM->getNameForID($var["modul_person_id"]);
                  $person=$this->UM->checkManagerResults($person_unchecked,"id","Namensabfrage");
                  $modullist[$count]["verantw_vorname"]=$person["vorname"];
                  $modullist[$count]["verantw_name"]=$person["name"];
                  //Zaehler um 1 erhoehen
                  $count=$count+1;              
              }
          //Liste aller Module inklusive Details erstellen
          $list_all_moduls_unchecked=$MM->getModuldetails(true);
          $list_all_moduls_unchanged=$this->UM->checkManagerResults($list_all_moduls_unchecked,"modul_id","Modulliste");
          //Verantwortlichen-ID durch Vorname und Name erweitern
          foreach($list_all_moduls_unchanged as $var)
              {
                  //Bisherige Moduldetails in das Endarray schieben
                  $list_all_moduls[$var["modul_id"]]=$var;
                  //Namen und Vornamen zur PID aus der Datenbank suchen und ueberpruefen und dann ins Array schreiben
                  $person_unchecked=$PM->getNameForID($var["modul_person_id"]);
                  $person=$this->UM->checkManagerResults($person_unchecked,"id","Namensabfrage");
                  $list_all_moduls[$var["modul_id"]]["verantw_vorname"]=$person["vorname"];
                  $list_all_moduls[$var["modul_id"]]["verantw_name"]=$person["name"];
              }
          //Daten an das VO schicken siehe Sequenzdiagramm PO,SO und Aenderungssatzung abstimmen
           $this->UM->VisualObject->showALLSGContent($sgdetail,$modullist,$list_all_moduls);
          }
          else
          {
              //Daten an das VO schicken siehe Sequenzdiagramm Studiengang bestaetigen/beschliessen
              $this->UM->VisualObject->showALLSGContent($sgdetail);
          }                  
      }
      
      /**
      * Sendet neue Studiengangdetails an den SG_Manager und bei Bedarf eine neue Modulliste fuer diesen Studiengang an den Modulmanager
      * @param mixed $sgdetails  Array mit den Studiengangdetails: enthaelt die Felder: sg_id,sg_name,sg_po,sg_so,sg_modulhandbuch,verantw_vorname,verantw_name
      * @param mixed $modul_id_list 2 dim Array das alle Module enthaelt die zu dem Studiengang gehoeren, enthaelt die felder [count],[modul_id,plansemester]
      */
      function setSGStatus($sgdetails,$modul_id_list=false)
      {
          //Manager initialieren
          $MM=new Modul_Management();
          $PM=new Person_Management();
          $SM=new SG_Management();
          //Name und vorname des dekans in eine Dekan_ID umwandeln und ueberpruefen
          $person["vorname"]=$sgdetails["verantw_vorname"];
          $person["name"]=$sgdetails["verantw_name"];
          $pid_unchecked=$PM->getPIDForName($person);
          $pid=$this->UM->checkManagerResults($pid_unchecked,"pid","Personen-ID");
          $dekan_unchecked=$PM->getDekanID($pid);
          $dekan=$this->UM->checkManagerResults($dekan_unchecked,"dekan_id","Dekan_ID");
          //DekanID dem Array hinzufuegen
          $sgdetails["sg_dekan"]=$dekan;
          //Pruefen ob Modulliste auch geaendert wurde
          if(!$modul_id_list)
          {
              $result=$SM->setSGdetails($sgdetails);
          }
          else
          {
              $result=$SM->setSGdetails($sgdetails);
              if ($result)
              {
                  $result=$SM->setModullisteForSG($sgdetails["sg_id"],$modul_id_list);
              }                  
          }
          $this->UM->VisualObject->showResult($result);
      }
  }
?>
