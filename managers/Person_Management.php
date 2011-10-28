<?php

class Person_Management
{

	///setter/// 

	///getter///
	
	/**
    * holt den Vor- und Nachnamen einer Person zu einer bestimmten Personen-ID aus der Datenbank
    * @param int $id Personen-ID zu der Person dessen Namen gesucht wird
    * @return mixed array mit den Feldern vorname, name, id und result mit dem Wert true fuer Abfrage erfolgreich und false fuer Abfrage fehlgeschlagen
    */
	function getNameForID($id)
	{
		$sql = "SELECT person_name, person_vorname, person_id FROM person WHERE person_id = '".$id."'";
		$res = mysql_query($sql);
		if(!$res)
		{	
			$result["result"] = false;
		} else {
			$rnum=mysql_num_rows($res);
			if($rnum != 0)
			{
				$result["result"] = true;
				$row = mysql_fetch_object($res);
				$result["vorname"] = $row->person_vorname;
				$result["name"] = $row->person_name;
				$result["id"] = $row->person_id;
			}
		}
		return $result;
	}
	
    //Holt die Matrikelnummer zum Studenten
    function getStudentDetails($student_personid){
    	$sql = "SELECT * FROM student WHERE student_personenid = '".$student_personid."'";
    	//echo $sql;
    	$res = mysql_query($sql);
    	if(!$res)
		{	
			$result["result"] = false;
		} else {
			$rnum=mysql_num_rows($res);
			if($rnum != 0)
			{
				$result["result"] = true;
				$row = mysql_fetch_object($res);
				$result["student_personenid"] = $row->student_personenid;
				$result["student_matnr"] = $row->student_matnr;
				$result["student_sg_id"] = $row->student_sg_id;
				$result["student_fakrat"] = $row->student_fakrat;
			}
		}
		return $result;
    }
    /**
        * holt die Personen_ID zu der Dekan_ID aus der Dekantabelle 
        * @param int $id Dekan-ID des Dekans zu dem die PID gesucht wird
        * @return mixed array mit den Feldern pid (Personen-ID des Dekans) und result mit dem Wert true fuer alles ok oder false fuer Fehler bei der Abfrage
        */
    function getDekanDetails($dekan_id)
    {
        $sql = "SELECT * FROM studiendekan AS s INNER JOIN person as p ON p.person_id=s.studiendekan_persid WHERE s.studiendekan_id = '".$dekan_id."'";
        $res = mysql_query($sql);
        return $this->buildResult($res, "studiendekan_id");
    }
    /**
        * holt die Personen_ID zu dem Vornamen und Namen der Person oder gibt ein false zurück, falls die Person nicht existiert
        * @param string Array mit den Feldern vorname und name
        * @return mixed array mit den Feldern pid (personenId) und dem Feld result mit dem Wert true fuer Person gefunden oder false fuer Person nicht gefunden
        */
    function getPIDForName($person)
    {
        
    }
    
    /**
        * holt die Dekan_ID zu der Personen-ID aus der Dekantabelle
        * @param int $pid Personen-ID der Person zu der die Dekan-ID gesucht wird
        * @return mixed array mit den Feldern dekan_id und dem Feld result mit dem Wert true fuer Person in der Dekantabelle gefunden oder false fuer Person nicht in der Dekantabelle gefunden
        */
    
    function getDekanID($pid)
    {
        
    }
    
    // HELPER
    
    /**
	* Erneut die buildResult aus Modul_Management, Füllt die DB-Resultate in eine array um (array[modulID][attribut])
	  setzt Eintrag "sg_so" auf false falls SO und PO in ein un der selben Datei liegen kann rausgenommen werden falls wir nur die Strings speichern
	* @param mySql-Rsourcedatei $res
	* @return array ['result'] enthält false bei DB-Fehler, array[modulID][attribut] das attribut heißt gleich dem DB-fieldnamen
	*/
	// Daniel's geniale Funktion =)
	// baut die Resultate nach den Tabellennamen in ein 2 Dimensionales Array um
	// der 2. Parameter muss angegeben werden nach welchem Spaltennamen in erster Dimension das Array zusammengebaut wird, es empfielt sich den PRIMARY KEY der Tabelle zu verwenden
	private function buildResult($res, $first_index){
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
}

?>