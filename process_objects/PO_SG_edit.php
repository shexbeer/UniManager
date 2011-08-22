<?php
  class PO_SG_edit{
      
      function PO_SG_edit($UM)
      {
          $this->UM=$UM;
      }
      
      
      /**
        * Ruft eine Liste aller Studiengaenge ab und substituiert die Dekan-ID durch den Namen des Dekans initform()
        Achtung: Dekanvor- und nachname zusammengefügt und nur ein Feld
        */
      function initform()
      {
          //SG-Manager initialisiern
          $SG= new SG_Management();
          $PM= new Person_Management();
          //Studiengangliste holen und überprüfen
          $sglist_unchecked=$SG->getSGList();
          $sglist=$this->UM->checkManagerResult($sglist_unchecked,"sg_id","Studiengangliste");
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
          $pid=$this->UM->checkManagerResult($pid_unchecked,"pid","Personen-ID");
          //Dekan-ID zur Personen-ID raussuchen und Ergebnis ueberpruefen
          $dekan_unchecked=$PM->getDekanID($pid);
          $dekan=$this->UM->checkManagerResults($dekan_unchecked,"dekan_id","Dekan-ID");
          //Daten an den SG-Manager weiterleiten und Ergebnis zum VO schicken
          $result=$SG->createSG($sgname,$sg_po,$sg_so,$sgmhb,$dekan);
          $this->UM->VisualObject->showResult($result);                   
      }
  
      
       /**
        * Ruft Details zu einem speziellen Studiengang ab und ergänzt die Dekan-ID durch Vor- und Nachname des Dekans getCreateSGForm($sg_id)
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
          $detail=$this->UM->checkManagerResult($detail,"sg_id","Studiengangdetails");
          //Dekan-ID substituieren durch Namen und Vornamen
          $dekan=$PM->getNameForID($PM->getDekanPID($detail["sg_dekan"]));
          $detail["dekanvorname"]=$dekan["vorname"];
          $detail["dekanname"]=$dekan["name"];
          //Details ans VO schicken
          $this->UM->VisualObject->ShowCreateSGForm($detail);                     
      }
      function editSG()
      {
          
      }
      function setSGStatus()
      {
          
      } 
  }
?>
