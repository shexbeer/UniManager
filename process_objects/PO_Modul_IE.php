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
            	//$res_cropped = $this->UM->checkManagerResults($res, "id", "Personen");
            	   
            	// GrundsŠtzlich ersteinmal alles was in $modDetails drinsteht wieder nach $results rein
            	$result[$var["modul_id"]] = $var;
            	// Vorsichtshalber wird das ID Feld ausgetauscht mit dem Richtigen Namen aber auch ein Neues Feld erstellt um bei den VO Machern jegliche Dummheiten auszuschlie§en ;)
            	$result[$var["modul_id"]]["verantwortlicher"] = $res["vorname"]." ".$res["name"];
            	//$result[$var["modul_id"]]["modul_person_id"] = $res_cropped[$verantwortlicher_id]["vorname"]." ".$res_cropped[$verantwortlicher_id]["name"];
            }
			// Ÿbergebe Ausgabefertige Daten an VO
			
            $this->UM->VisualObject->showModulList($result);
        }
        /**
        * Ruft Details zu einem speziellen Modul ab und ersetzt PersonenIDs durch Namen, danach schickt sie die Daten an das VO 
        * @param int $modul_id ID des Moduls das aufgerufen werden soll
        */
        function changemodul($modul_id,$modul_name=false,$dekan=false,$modul_status=false,$modul_duration=false,$modul_qualifytarget=false,$modul_content=false,$modul_literature=false,$modul_teachform=false,$modul_required=false,$modul_frequency=false,$modul_usability=false,$modul_lp=false,$modul_conditionforln=false,$modul_effort=false) 
        {
            $MM = new Modul_Management();
            $PM = new Person_Management();
            if (!$modul_name && !$dekan && !$modul_status && !$modul_duration && !$modul_qualifytarget && !$modul_content && !$modul_literature && !$modul_teachform && !$modul_required && !$modul_status && !$modul_frequency && !$modul_usability && !$modul_lp && !$modul_conditionforln && !$modul_effort){
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
                $dekan_unchecked = $PM->getDekans();
                $dekans = $this->UM->checkManagerResults($dekan_unchecked,"studiendekan_id","Dekanabfrage");
                $this->UM->VisualObject->showModulDetails($result,$dekans);
                die();
            }
            else{
                $re = $MM->getModuldetails(true,"modul",$modul_id);
                $res = $this->UM->checkManagerResults($re, "modul_id", "Moduldetails");
                var_dump($modul_name,$modul_content,$dekan,$modul_duration,$modul_effort,$modul_frequency,$modul_id,$modul_literature,$modul_lp,$modul_qualifytarget,$modul_required,$modul_required,$modul_status,$modul_teachform,$modul_usability);
                if(modul_name!=false)
                {
                    if(modul_name!=$res[$modul_id][modul_name])
                    {
                        $fixes[modul_name]=$modul_name;
                    }
                }
                if(dekan!=false)
                {
                    if(dekan!=$res[$modul_id][modul_person_id])
                    {
                        $fixes[modul_person_id]=$dekan;
                    }
                }
                if(modul_duration!=false)
                {
                    if(modul_duration!=$res[$modul_id][modul_duration])
                    {
                        $fixes[modul_duration]=$modul_duration;
                    }
                }
                if(modul_qualifytarget!=false)
                {
                    if(modul_qualifytarget!=$res[$modul_id][modul_qualifytarget])
                    {
                        $fixes[modul_qualifytarget]=$modul_qualifytarget;
                    }
                }
                if(modul_content!=false)
                {
                    if(modul_content!=$res[$modul_id][modul_content])
                    {
                        $fixes[modul_content]=$modul_content;
                    }
                }
                if(modul_literature!=false)
                {
                    if(modul_literature!=$res[$modul_id][modul_literature])
                    {
                        $fixes[modul_literature]=$modul_literature;
                    }
                }
                if(modul_teachform!=false)
                {
                    if(modul_teachform!=$res[$modul_id][modul_teachform])
                    {
                        $fixes[modul_teachform]=$modul_teachform;
                    }
                }
                if(modul_required!=false)
                {
                    if(modul_required!=$res[$modul_id][modul_required])
                    {
                        $fixes[modul_required]=$modul_required;
                    }
                }
                if(modul_frequency!=false)
                {
                    if(modul_frequency!=$res[$modul_id][modul_frequency])
                    {
                        $fixes[modul_frequency]=$modul_frequency;
                    }
                }
                if(modul_usability!=false)
                {
                    if(modul_usability!=$res[$modul_id][modul_usability])
                    {
                        $fixes[modul_usability]=$modul_usability;
                    }
                }
                if(modul_lp!=false)
                {
                    if(modul_lp!=$res[$modul_id][modul_lp])
                    {
                        $fixes[modul_lp]=$modul_lp;
                    }
                }
                if(modul_conditionforln!=false)
                {
                    if(modul_conditionforln!=$res[$modul_id][modul_conditionforln])
                    {
                        $fixes[modul_conditionforln]=$modul_conditionforln;
                    }
                }
                if(modul_effort!=false)
                {
                    if(modul_effort!=$res[$modul_id][modul_effort])
                    {
                        $fixes[modul_effort]=$modul_effort;
                    }
                }
                if (!$fixes)
                {
                    if($modul_status!="Bearbeitung")
                    {
                        $result=$MM->setModuldetails($modul_id,$res,$modul_status);
                    }
                    else
                    {
                        $result=$MM->setModuldetails($modul_id,$res);
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