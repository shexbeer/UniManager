<?php

class Person_Management
{

	///setter/// 

	///getter///
	
	//Holt den Vorname Nachnamen einer Person, es wird die Standart Manager Fehlerausgabe genutzt!
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
			} else {
				$result["result"] = false;
			}
		}
		return $result;
	}
}

?>