<?php
    class PO_Modul_IE {
        function PO_Modul_IE($UM)
        {
            //instanzierte Klasse Unimanager klassenweit verfuegbar machen
            $this->UM= $UM;
        }
        /**
        * Beschafft eine Liste aller existierender Module inklusive Details und ersetzt Personen-IDs durch Namen
        */
        function initform()
        {
            //neue Instanz der Klasse erschaffen
            $MM = new Modul_Management();
            $PM = new Person_Management();
            //Moduldetails beschaffen
            $mDetails = $MM->getModuldetails(true);
            $modDetails = $this->UM->checkManagerResults($mDetails, "modul_id", "Modul Details");
            
            // Es wŠre nur der Verantwortliche noch auszutauschen da da nur eine ID drinsteht
            foreach($modDetails as $var) {
            	$verantwortlicher_id = $var["modul_person_id"];
            	// Abfrage des Richtigen Namens der Verantwortlichen ID und ŸberprŸfen der ManagerDaten auf Fehler
            	$res = $PM->getNameForID($verantwortlicher_id);
            	// GrundsŠtzlich ersteinmal alles was in $modDetails drinsteht wieder nach $results rein
            	$result[$var["modul_id"]] = $var;
            	// Vorsichtshalber wird das ID Feld ausgetauscht mit dem Richtigen Namen aber auch ein Neues Feld erstellt um bei den VO Machern jegliche Dummheiten auszuschlie§en ;)
            	$result[$var["modul_id"]]["verantwortlicher"] = $res["vorname"]." ".$res["name"];
            }
			// Ÿbergebe Ausgabefertige Daten an VO
			$a_list_unchecked=$MM->getModullist(false,'modul');
            $a_list=$this->UM->checkManagerResults($a_list_unchecked,"aenderung_id","Änderungsliste");
            $this->UM->VisualObject->showModulList($result,$a_list);
        }
        /**
        * Ruft Details zu einem speziellen Modul ab und ersetzt PersonenIDs durch Namen, danach schickt sie die Daten an das VO 
        * @param int $modul_id ID des Moduls das aufgerufen werden soll
        */
        function changemodul($modul_id,$typ,$modul_status=false,$fixes=false) 
        {
            $MM = new Modul_Management();
            $PM = new Person_Management();
            if (!$fixes && !$modul_status){
                $lehrende_unchecked = $PM->getLehrende();
                $lehrende = $this->UM->checkManagerResults($lehrende_unchecked,"lehrende_id","Lehrendeabfrage");
                if ($typ){           //Check ob Modul oder Änderung
                    // Moduldetails zum speziellen Modul holen
                    $re = $MM->getModuldetails(true,"modul",$modul_id);
                    $result = $re[$modul_id];
                    $result["verantwortlicher"] = $res["vorname"]." ".$res["name"];
                    // Übergebe ausgabefertige Daten an VO
                    $this->UM->VisualObject->showModulDetails($result,$lehrende);
                    die();
                }
                else{
                    $aend_id=$modul_id;
                    $a_list_unchecked=$MM->getModullist(false,'modul');                //Modul-Id zur Änderung bestimmen    
                    $a_list=$this->UM->checkManagerResults($a_list_unchecked,"aenderung_id","Änderungsliste");
                    foreach($a_list as $var){                              
                            if ( $aend_id==$var['aenderung_id']){
                                $modul_id=$var['aenderung_mid'];
                            }
                    }
                    $re=$MM->getModuldetails(false,'modul',$modul_id);
                    $res=$this->UM->checkManagerResults($re,"aenderung_id","Änderungsdetailabfrage");
                    $result=$res[$aend_id];
                    $this->UM->VisualObject->showChangeDetails($result,$lehrende);
                    die();                    
                }
            }
              else
                {
                    $result=$MM->setModuldetails($modul_id,$fixes);
                    if($result){
                        $this->UM->VisualObject->showResult($result,"Moduldetails erfolgreich als &Aumlnderung abgespeichert.");
                    }
                    else{
                        $this->UM->VisualObject->showResult($result,"Fehler beim Speichern des &Aumlnderungseintrages!"); 
                    }
                }
        
            
            
            
             
        }
        /**
        * Aendert den Status eines bestimmten Moduls
        * @param int $modul_id ID des Moduls dessen Status geaendert werden soll
        * @param string $status zukuenftiger Status des Moduls laut Konventionen: Bearbeitet, Erstellt, Genehmigt
        */
        function setmodulstatus($modul_id,$status)
        {
            $MM = new Modul_Management();
            // Status und ModulID an Modulmanager schicken
            $result = $MM->setModulStatus($modul_id,$status);
            // Erfolg oder Misserfolg im VO melden
            $this->UM->VisualObject->showResult($result); 
        }

 function showCreateModul($error=false)
      {
          //Manager initialisieren
          $PM= new Person_Management();
          $lehrende_unchecked = $PM->getLehrende();
          $lehrende = $this->UM->checkManagerResults($lehrende_unchecked,"lehrende_id","Lehrendeabfrage");
          if ($error==false){
                              $this->UM->VisualObject->ShowCreateModul($lehrende);                     
                              }
          else{
                                $this->UM->VisualObject->ShowCreateModul($lehrende,$error);
          }
          
          
      }                    
       
      
function enterList($list)
      {
        $MM= new Modul_Management();
       
        $failure = false;
        
	
        	$result = $MM->setModuldetails($list.modul_id, $list);
        	if($result = false) {
        		$failure = true;
        	}
        
        //Erfolg oder Misserfolg melden 
        //$this->UM->VisualObject->showResult($failure, "Bitte melden Sie sich bei der Software Hotline: Code 9999");   
	$this->UM->VisualObject->showResult($list); 
	 
      }

function addmodul($modul_name,$pid)

 {
        $MM= new Modul_Management();
	    $result = $MM->addModul($modul_name,$pid);
        if(!$result){
            $this->UM->VisualObject->showaddResult($result,"Es trat ein Fehler bei der Modulerstellung auf!");
        }
        else{
            $this->UM->VisualObject->showaddResult($result,"Die Modulerstellung verlief erfolgreich!");
        } 
 }



}
?>