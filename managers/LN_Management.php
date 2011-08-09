<?php

class LN_Management {
	
    /*
    #Fehlerkontrolle
    function buildResult($res){
        if($res)
            $res['result']=true;
        else 
            $res['result']=false;
        return $res;        
    }
    */
    
	#Abrufen eines Leistungsnachweises mit allen Details
    #parameter EINE ln_id
    #Wiedergabe 1dim: ln_id, ln_date, ...  
	function getLNdetail(){
        $ln_id = func_get_arg(0);
		$sql = "SELECT * FROM leistungsnachweis WHERE ln_id=".$ln_id;
		return mysql_query($sql);
   }
	
    #Liste einer Liste von ln_ids zu einem Modul
    #parameter EINE modul_id
    #Wiedergabe 1dim: ln_id[0], ... 
    function getLNlist(){
        $mod_id = func_get_arg(0);
        $sql = "SELECT ln_id FROM leistungsnachweis WHERE ln_modul_id=".$mod_id." ORDER BY ln_id";
        return mysql_query($sql);
    }
    
    
    /* f�r Eingabe verschiedener Parameter, die gleich die gew�nschte Tabelle ausspuckt
    
    parameter: Liste der Modul_ids, welche Spalten sollen �bergeben werden
        (1): nur id, name, datum und modul
        (2): zus�tzlich pr�fer und dauer
        (3): zus�tzlich voraussetzung => alles
    */
    function getLN() {
        $type = func_get_arg(1);
        $mod_id = func_get_arg(0);
        switch ($type){
            case "1": $add = '';
            case "2": $add = ", ln_examiner, ln_duration";
            case "3": $add = ", ln_examiner, ln_duration, ln_requirement";
            default: $add = ", ln_examiner, ln_duration, ln_requirement";
		}	    
        $sql = "SELECT ln_id, ln_name, ln_date, ln_modul_id".$add." FROM leistungsnachweis WHERE ln_modul_id=".$mod_id;
        return mysql_query($sql);
    }
	
    
    #LN m�ssten auch irgendwie erstellt und gel�scht werden k�nnen, bis jetzt in der Dokumentation nicht vorgesehen
    #wird ein Modul gel�scht, sollten die zugeh�rigen LN auch gel�scht werden
    
}

?>