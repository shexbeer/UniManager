<?php

class LN_Management {
	// Daniel's geniale Funktion =)
	// baut die Resultate nach den Tabellennamen in ein 2 Dimensionales Array um
	// der 2. Parameter muss angegeben werden nach welchem Spaltennamen in erster Dimension das Array zusammengebaut wird, es empfielt sich den PRIMARY KEY der Tabelle zu verwenden
	function buildResult($res, $first_index){
		if(!$res)$rows['result']=false;//Fehlererkennung
		else{
			$rows['result']=true;
			$rnum=mysql_num_rows($res);# 0 wenn kein Treffer gefunden wurde
			$fnum = mysql_num_fields($res);
			for($i=0;$i<$rnum;$i++){
					$mod_id = mysql_result($res,$i,$first_index);
					for($j=0;$j<$fnum;$j++) $rows[$mod_id][mysql_field_name($res,$j)]=mysql_result($res,$i,$j);
			}
		}
		return $rows;
	}
	
    #Liste aller LN's
    #return: 2 Dim Array, in 1. Dim. nach ln_id sortiert, danach inhalt der Tabelle mit Spaltennamen als index
    # 	=> ab dem mysql_query wird das gemacht was buildResult (Daniel Funktion) normalerweise tut
    #	=> zum verstŠndniss Marcus!
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
			}
		}
		return $result;
    }
    function getLN($ln_id)
    {
    	$sql = "SELECT * FROM leistungsnachweis WHERE ln_id = '".$ln_id."'";
    	$res = mysql_query($sql);
    	return $this->buildResult($res, "ln_id");
    }
    // Meldet eine Personen_ID an einem Leistungsnachweis an
    // 1. Parameter: Personen ID die zu dem LN angemeldet werden soll
    // 2. Parameter: Leistungsnachweis ID zu der Angemeldet werden soll
    function setLNA($person_id, $ln_id)
    {
    	$sql = "INSERT INTO  `UniManager`.`leistungsnachweisanmeldung` (`lna_person_id` ,`lna_ln_id`) VALUES ('".$person_id."',  '".$ln_id."');";
    	$res = mysql_query($sql);
    }
    // Holt eine Liste aller LN-Anmeldungen zu einer bestimmten Personen-ID
    function getLNA($person_id)
    {
    	$sql = "SELECT * FROM leistungsnachweisanmeldung WHERE lna_person_id = '".$person_id."'";
    	$res = mysql_query($sql);
		return $this->buildResult($res, "lna_ln_id");
    }
    // †berprŸft ob eine bestimmte Person schon eine Anmeldung zu einem Bestimmten Leistungsnachweis hat
    // return: bool
    // NEW FUNCTION ( noch nicht im Klassendiagramm ) 
    function checkLNAforPersonID($person_id, $ln_id) 
    {
    	$sql = "SELECT * FROM leistungsnachweisanmeldung WHERE lna_person_id='".$person_id."' AND lna_ln_id='".$ln_id."'";
    	$res = mysql_query($sql);
    	$rnum = mysql_num_rows($res);
    	if($rnum == 0) {
    		return false;
    	} else {
    		return true;
    	}
    }
    
    
    
    
// Rest vom Marcus's Schuetzenfest .... kein Kommentar
    /* für Eingabe verschiedener Parameter, die gleich die gewünschte Tabelle ausspuckt
    
    parameter: Liste der Modul_ids, welche Spalten sollen übergeben werden
        (1): nur id, name, datum und modul
        (2): zusätzlich prüfer und dauer
        (3): zusätzlich voraussetzung => alles
    
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
*/	
    
    #LN müssten auch irgendwie erstellt und gelöscht werden können, bis jetzt in der Dokumentation nicht vorgesehen
    #wird ein Modul gelöscht, sollten die zugehörigen LN auch gelöscht werden
    // shex: das kann man immer noch spŠter tun, eh wir sachen zum lšschen bauen an die bisher nicht mal der 
    // Prof. Jasper bzw wir gedacht haben, sollten wir erstmal das machen woran wir gedacht haben!
}

?>