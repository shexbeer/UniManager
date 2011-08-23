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
    /**
        * holt die Personen_ID zu der Dekan_ID aus der Dekantabelle 
        * @param int $id Dekan-ID des Dekans zu dem die PID gesucht wird
        * @return mixed array mit den Feldern pid (Personen-ID des Dekans) und result mit dem Wert true fuer alles ok oder false fuer Fehler bei der Abfrage
        */
    function getDekanPID($id)
    {
        
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
}

?>