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
					$result[$row->ln_id]["ln_examiner"] = $row->ln_examiner_pid;
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
    
    
    // Noteneintagen
    function editLNA($lna_id, $mark){
        $sql = "UPDATE leistungsnachweisanmeldung SET lna_mark='".$mark."' WHERE lna_id='".$lna_id."'";
        // oder `UniManager`.`leistungsnachweisanmeldung`
    	$res = mysql_query($sql);
    }
    
   /* 
    function getLNA($lna_id)
    {
    	$sql = "SELECT * FROM leistungsnachweisanmeldung WHERE lna_id = '".$lna_id."'";
    	$res = mysql_query($sql);
		return $this->buildResult($res, "lna_id");
    }
    */
    
    //gibt alle LNA eines Studenten aus
    //gibt nur die entscheidenden Daten zurück
    //NEW
     function getMarksByStudent($student_id)
    {
    	$sql = "SELECT ln_name, lna_mark, ln_date FROM leistungsnachweisanmeldung, leistungsnachweis WHERE lna_ln_id = ln_id AND lna_person_id ='".$student_id."'"  ;
    	$res = mysql_query($sql);
		return $this->buildResult($res, "ln_name");
    }
        
    //alle LNAs zu einem LN
    //gibt nur die person_id und die Note (person_id eventuell durch Matrikelnummer ersetzen
    //NEW
    function getMarksByLn($ln_id){
        $sql = "SELECT lna_person_id, lna_mark FROM leistungsnachweisanmeldung WHERE lna_ln_id='".$ln_id."'";
        $res = mysql_query($sql);
		return $this->buildResult($res, "lna_person_id");
    }
    
    
    //alle LNAs zu einem Modul (auch alle vergangenen Semester)
    //gibt nur die person_id und die Note
    //NEW
    function getMarksByModul($modul_id){
        $sql = "SELECT ln_date, lna_person_id, lna_mark FROM leistungsnachweisanmeldung, leistungsnachweis WHERE lna_ln_id=ln_id AND ln_modul_id='".$modul_id."'" ;
        $res = mysql_query($sql);
		return $this->buildResult($res, "ln_date");
    }
    
    
    function getroomplan(){}
    
    function setLN(){}
    
   
    //Holt die Matrikelnummer zum Studenten
    function getStudentDetails($student_personid){}
  
}

?>