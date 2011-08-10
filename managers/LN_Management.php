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
/*        $ln_id = func_get_arg(0);
		$sql = "SELECT * FROM leistungsnachweis WHERE ln_id=".$ln_id;
		return mysql_query($sql);
*/  
  	}
	
    #Liste der LN's
    #return: 2 Dim Array, in 1. Dim. nach ln_id sortiert, danach inhalt der Tabelle mit Spaltennamen als index
    function getLNlist(){
        //$mod_id = func_get_arg(0);
        $sql = "SELECT * FROM leistungsnachweis ORDER BY ln_modul_id";
        $res = mysql_query($sql);
        if(!$res)		// Falls ein Fehler im SQL Query aufgetreten ist
		{	
			$result["result"] = false;
		} else {
			$rnum=mysql_num_rows($res);
			if($rnum != 0)		// Wenn Daten gefunden worden sind
			{
				$result["result"] = true;		// Setze Zeichen das alles OK ist
				while($row = mysql_fetch_object($res))		// Lies solange Zeilen aus den Result bis es leer ist
				{
					// Baue Antworten sinnvoll zusammen in einem 2dim Array
					$result[$row->ln_id]["ln_modul_id"] = $row->ln_modul_id;
					$result[$row->ln_id]["ln_date"] = $row->ln_date;
					$result[$row->ln_id]["ln_id"] = $row->ln_id;
					$result[$row->ln_id]["ln_examiner"] = $row->ln_examiner;
					$result[$row->ln_id]["ln_requirement"] = $row->ln_requirement;
				}
			} else {		// Wenn keine Daten gefunden worden sind
				$result["result"] = false;
			}
		}
		return $result;
    }
    
    
    /* für Eingabe verschiedener Parameter, die gleich die gewünschte Tabelle ausspuckt
    
    parameter: Liste der Modul_ids, welche Spalten sollen übergeben werden
        (1): nur id, name, datum und modul
        (2): zusätzlich prüfer und dauer
        (3): zusätzlich voraussetzung => alles
    */
    function getLN() {
/*        $type = func_get_arg(1);
        $mod_id = func_get_arg(0);
        switch ($type){
            case "1": $add = '';
            case "2": $add = ", ln_examiner, ln_duration";
            case "3": $add = ", ln_examiner, ln_duration, ln_requirement";
            default: $add = ", ln_examiner, ln_duration, ln_requirement";
		}	    
        $sql = "SELECT ln_id, ln_name, ln_date, ln_modul_id".$add." FROM leistungsnachweis WHERE ln_modul_id=".$mod_id;
        return mysql_query($sql);
*/
    }
	
    
    #LN müssten auch irgendwie erstellt und gelöscht werden können, bis jetzt in der Dokumentation nicht vorgesehen
    #wird ein Modul gelöscht, sollten die zugehörigen LN auch gelöscht werden
    
}

?>