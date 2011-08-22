<?php

class Person_Management
{

	///setter/// 

	///getter///
	
	//Holt den Vorname Nachnamen einer Person, es wird die Standart Manager Fehlerausgabe genutzt!
	// vorname ist unter $result[personen_id]["vorname"] zu finden
	// nachname ist unter $result[personen_id]["name"] zu finden
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
				$result[$id]["vorname"] = $row->person_vorname;
				$result[$id]["name"] = $row->person_name;
				$result[$id]["id"] = $row->person_id;
			}
		}
		return $result;
	}
    /**
        * holt die Personen_ID zu der Dekan_ID aus der Dekantabelle getDekanPID($id)
        * @param int $id Dekan-ID des Dekans zu dem die PID gesucht wird
        * @return int Personen-ID des Dekans
        */
    function getDekanPID($id)
    {
        
    }
    /**
        * holt die Personen_ID zu dem Vornamen und Namen der Person oder gibt ein false zurück falls die Person nicht existiert getPIDForName($person)
        * @param string Array mit den Feldern vorname und name
        * @return mixed array mit den Feldern pid (personenId) und dem Feld result mit dem Wert true für Person gefunden oder false für Person nicht gefunden
        */
    function getPIDForName($person)
    {
        
    }
    
    /**
        * holt die Dekan_ID zu der Personen-ID aus der Dekantabelle getDekanID($pid)
        * @param int $pid Personen-ID der Person zu der die Dekan-ID gesucht wird
        * @return mixed array mit den Feldern dekan_id und dem Feld result mit dem Wert true für Person in der Dekantabelle gefunden oder false für Person nicht in der Dekantabelle gefunden
        */
    
    function getDekanID($pid)
    {
        
    }
}

?>