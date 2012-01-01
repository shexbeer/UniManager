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
            	//var_dump($res);
            	// GrundsŠtzlich ersteinmal alles was in $modDetails drinsteht wieder nach $results rein
            	$result[$var["modul_id"]] = $var;
            	// Vorsichtshalber wird das ID Feld ausgetauscht mit dem Richtigen Namen aber auch ein Neues Feld erstellt um bei den VO Machern jegliche Dummheiten auszuschlie§en ;)
            	$result[$var["modul_id"]]["verantwortlicher"] = $res["vorname"]." ".$res["name"];
            }
			// Ÿbergebe Ausgabefertige Daten an VO
			
            $this->UM->VisualObject->showModulList($result);
        }
        /**
        * Ruft Details zu einem speziellen Modul ab und ersetzt PersonenIDs durch Namen, danach schickt sie die Daten an das VO 
        * @param int $modul_id ID des Moduls das aufgerufen werden soll
        */
        function changemodul($modul_id,$lehrende=false,$modul_status=false,$modul_duration=false,$modul_qualifytarget=false,$modul_content=false, $modul_institute=false, $modul_literature=false,$modul_teachform=false,$modul_required=false,$modul_frequency=false,$modul_usability=false,$modul_lp=false,$modul_conditionforln=false,$modul_effort=false) 
        {
            $MM = new Modul_Management();
            $PM = new Person_Management();
            if (!$lehrende && !$modul_status && !$modul_duration && !$modul_qualifytarget && !$modul_institute && !$modul_content && !$modul_literature && !$modul_teachform && !$modul_required && !$modul_status && !$modul_frequency && !$modul_usability && !$modul_lp && !$modul_conditionforln && !$modul_effort){
                // Moduldetails zum speziellen Modul holen
                $re = $MM->getModuldetails(true,"modul",$modul_id);
                $result = $this->UM->checkManagerResults($re, "modul_id", "Moduldetails");
                // Verantwortlichen-ID zu Namen auflösen
                $res = $PM->getNameForID($result[$modul_id]["modul_person_id"]);
                //Prüfen
                //Namen in result einfügen und ID durch Namen ersetzen (siehe oben)
                $result = $re[$modul_id];
                $result["verantwortlicher"] = $res["vorname"]." ".$res["name"];
                $result["modul_person_id"] = $res["vorname"]." ".$res["name"];
                // Übergebe ausgabefertige Daten an VO
                //var_dump($result);
                $lehrende_unchecked = $PM->getLehrende();
                $lehrende = $this->UM->checkManagerResults($lehrende_unchecked,"lehrende_id","Lehrendeabfrage");
                var_dump($lehrende);
                $this->UM->VisualObject->showModulDetails($result,$lehrende);
                die();
            }
            else{
                $re = $MM->getModuldetails(true,"modul",$modul_id);
                $res = $this->UM->checkManagerResults($re, "modul_id", "Moduldetails");
                    
                    if(strcmp($lehrende,$res[$modul_id]['modul_person_id'])!=0)
                    {
                        $fixes['person_id']=$dekan;
                    }
                    if(strcmp($modul_duration,$res[$modul_id]['modul_duration'])!=0)
                    {
                        $fixes['duration']=$modul_duration;
                        $count=$count+1; 
                    }
                    if(strcmp($modul_qualifytarget,$res[$modul_id]['modul_qualifytarget'])!=0)
                    {
                        $fixes['qualifytarget']=$modul_qualifytarget;
                        $count=$count+1; 
                    }
                    if(strcmp($modul_institute,$res[$modul_id]['modul_institute'])!=0)
                    {
                        $fixes['institut']=$modul_institute;
                        $count=$count+1; 
                    }
                    if(strcmp($modul_content,$res[$modul_id]['modul_content'])!=0)
                    {
                        $fixes['content']=$modul_content;
                        $count=$count+1; 
                    }
                    if(strcmp($modul_literature,$res[$modul_id]['modul_literature'])!=0)
                    {
                        $fixes['literature']=$modul_literature;
                        $count=$count+1; 
                    }
                    if(strcmp($modul_teachform,$res[$modul_id]['modul_teachform'])!=0)
                    {
                        $fixes['teachform']=$modul_teachform;
                        $count=$count+1; 
                    }
                    if(strcmp($modul_required,$res[$modul_id]['modul_required'])!=0)
                    {
                        $fixes['required']=$modul_required;
                        $count=$count+1; 
                    }
                    if(strcmp($modul_frequency,$res[$modul_id]['modul_frequency'])!=0)
                    {
                        $fixes['frequency']=$modul_frequency;
                        $count=$count+1; 
                    }
                    if(strcmp($modul_usability,$res[$modul_id]['modul_usability'])!=0)
                    {
                        $fixes['usability']=$modul_usability;
                        $count=$count+1; 
                    }
                    if(strcmp($modul_lp,$res[$modul_id]['modul_lp'])!=0)
                    {
                        $fixes['lp']=$modul_lp;
                        $count=$count+1; 
                    }
                    if(strcmp($modul_conditionforln,$res[$modul_id]['modul_conditionforln'])!=0)
                    {
                        $fixes['conditionforln']=$modul_conditionforln;
                        $count=$count+1; 
                    }
                    if(strcmp($modul_effort,$res[$modul_id]['modul_effort'])!=0)
                    {
                        $fixes['effort']=$modul_effort;
                        $count=$count+1; 
                    }
                var_dump($count);
                var_dump($fixes);
                if (!$fixes)
                {
                    if($modul_status!="Bearbeitung")
                    {
                        $result=$MM->setModuldetails($modul_id,$fixes,$modul_status);
                    }
                    else
                    {
                        $result=$MM->setModuldetails($modul_id,$fixes);
                    }
                    $this->UM->VisualObject->showResult($result);
                }
                else
                {
                    $this->UM->VisualObject->showResult($false,"Es wurden keine &Aumlnderungen gemacht.");
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

 function showCreateModul()
      {
          //Manager initialisieren
          $SG= new Modul_Management();
          $PM= new Person_Management();
          $this->UM->VisualObject->ShowCreateModul();                     
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

function addmodul($newmodul)

 {
        $MM= new Modul_Management();
        $p_id= (int)$newmodul["v_id"];
	    $result = $MM->addModul($newmodul["modul_name"],$p_id,0);
        $this->UM->VisualObject->showResultadd($result); 
 }



}
?>