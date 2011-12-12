<?php

class Person_Management
{


	///GETTER///
	
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
	* holt die Personendetails zu der Dekan_ID aus der Dekantabelle 
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
	
	/// SETTER ///
	
	
	/**
	* Erstellt einen Personeneintrag
	  die Personen id wird selbständig kreiert,
	  email ist optional,
	  zugriffsrecht wird nur als seperater Parameter zu gelassen !!sicherheitsrelevant!!
	  alle anderen Daten müssen vorhanden sein sonst ungültig
	* @param mixed $pdetails ein Array mit entsprechenden Schlüsselnamen und Inhalt 
	  array['name']
	  array['vorname']
	  array['gebdat'] string mit der Form "year-month-day" z.B.:"2011-2-26"
	  array['anschrift_plz'] ACHTUNG beachtet den umgang von ints bei php die PLZ muss entweder als string mit '' angegeben werden oder man lässte die führenden nullen weg
	  array['anschrift_stadt']
	  array['anschrift_strasse']
	  array['anschrift_hausnummer']
	  array['loginname']
	  array['kennwort']
	  array['fak']
	  (array['email'] optional)
	  das redundante 'person_' muss wetggelassen werden
	* @param int $seclevel Zugriffsrecht der default-Wert sollte der niedrigst mögliche sein
	* @return false oder neue Personen-ID
	*/
	function createPerson($pdetails, $seclevel=100)
	{
		//überprüfen ob Daten vollständig
		if( !isset( $pdetails['vorname'] ) )
			return false;
		
		if( !isset( $pdetails['name'] ) )
			return false;
		
		if( !isset( $pdetails['gebdat'] ) )
			return false;
		
		if( !isset( $pdetails['anschrift_plz'] ) )
			return false;
		if( !isset( $pdetails['anschrift_stadt'] ) )
			return false;
		
		if( !isset( $pdetails['anschrift_strasse'] ) )
			return false;
		
		if( !isset( $pdetails['anschrift_hausnummer'] ) )
			return false;
		
		if( !isset( $pdetails['loginname'] ) )
			return false;
		
		if( !isset( $pdetails['kennwort'] ) )
			return false;
		
		if( !isset( $pdetails['fak'] ) )
			return false;
		
		if( isset( $pdetails['zugriffsrecht'] ) )
			unset( $pdetails['zugriffsrecht'] );
			
		if( isset( $pdetails['id'] ) )
			unset( $pdetails['id'] );
		
		$keys = array();
		$values = array ();
		foreach($pdetails as $key => $value)
		{
			$keys[]="`person_".$key."`";
			if($key=="kennwort")
				$values[]="MD5('".$value."')";
			else
				$values[]="'".$value."'";
		}
		$keys[]="`person_zugriffsrecht`";
		$values[]="'".$seclevel."'";
		$sql="INSERT INTO `unimanager`.`person` (".join($keys,", ").") VALUES (".join($values,", ").");";
		if( !mysql_query($sql) )
			return false; //Fehler bei mysql-Auswertung
		else
		{
			$sql = "SELECT LAST_INSERT_ID();";
			$res = mysql_query($sql);
			$row = mysql_fetch_row($res);
			return $row[0];
		}
	}
	/**
	* Funktion zum löschen eines Personendatensatz
	  nur der Vollständigkeit halber, sollte in der Praxis nur im äußersten Notfall verwendet werden
	* @param int $pid
	* @return bool ob erfolgreich oder nicht 
	*/
	function deletePerson($pid)
	{
		$sql="DELETE FROM `person` WHERE `person_id`='".$pid."';";
		if( mysql_query($sql) )
			return true;
		else
			return false;
	}
	
	/**
	* Verändert Daten zu einer Person
	  nicht verändert können hier zugriffsrecht, gebdat, id, loginname
	  bis auf zugriffsrecht sollten diese sich nie wieder ändern das Zugriffsrecht wird in einer eigenen Funktion gesetzt aus Sicherheitsgründen
	  diese Felder werden daher ignoriert wenn gesetzt
	* @param int $pid Personen-ID
	* @param array $pdetails Die zu setzenden Details
	  die Arraystruktur ist die selbe wie bei createPerson()
	* @return bool ob gelungen oder nicht
	*/
	function updatePerson($pid, $pdetails)
	{
		//aussieben der unveränderlichen
		if( isset( $pdetails['zugriffsrecht'] ) )
			unset( $pdetails['zugriffsrecht'] );
		if( isset( $pdetails['id'] ) )
			unset( $pdetails['id'] );
		if( isset( $pdetails['gebdat'] ) )
			unset( $pdetails['gebdat'] );
		if( isset( $pdetails['loginname'] ) )
			unset( $pdetails['loginname'] );
		
		$values=array();
		foreach( $pdetails as $key => $value )
		{
			if( $key=="kennwort" )
				$values[]="`person_".$key."`=MD5('".$value."')";
			else
				$values[]="`person_".$key."`='".$value."'";
		}
		$sql = "UPDATE `person` SET ".join($values,", ")." WHERE `person_id`='".$pid."';";
		if( !mysql_query($sql) )
			return false; // Update fehlgeschlagen
		return true;
	}
	
	/**
	* Erstellt einen neuen Studenten aus einer Person
	* @param int $pid Personen-ID aus dem Personentable
	* @param int $sgid Studiengang-ID des SG in dem der Student studiert
	* @param int $matnr Matrikelnummer zur eindeutigen Identifizierung des Studenten an der Uni (und in der DB)
	* @param bool $fakrat ob Mitglied im Fakrat oder nicht
	* @return bool ob erfolgreich oder nicht
	*/
	function addStudent($pid, $sgid, $matnr, $fakrat=false)
	{
		$bool;
		if($fakrat)
			$bool=1;
		else
			$bool=0;
		$sql="SELECT `student_matnr` FROM `unimanager`.`student` WHERE `student_personenid`='".$pid."';";
		$res = mysql_query($sql);
		if(!$res)
			return false;
		if( mysql_fetch_row($res) )
			return false;
		$sql="INSERT INTO `unimanager`.`student` (`student_personenid`, `student_matnr`, `student_sg_id`, `student_fakrat`) VALUE( '".$pid."', '".$matnr."', '".$sgid."', b'".$bool."' );";
		if( !mysql_query($sql) )
			return false;
		return true;
	}
	
	/**
	* Ändert den Sg eines Studenten
	* @param int $matnr Matrikelnummer des Studenten
	* @param int $sgid Studiengang-ID des neuen SG's
	* @return bool ob erfolgreich oder nicht
	*/
	function updateStudentSG($matnr, $sgid)
	{
		$sql="UPDATE `student` SET `student_sg_id`='".$sgid."' WHERE `student_matnr`='".$matnr."';";
		if( !mysql_query($sql) )
			return false;
		return true;
	}
	
	/**
	* Setzt ob der Student Mitglied im Fakrat ist oder nicht
	* @param int $matnr Matrikelnummer des Studenten
	* @param bool $fakrat 
	* @return bool ob erfolgreich oder nicht
	*/
	function updateStudentFakrat($matnr, $fakrat)
	{
		$bool;
		if($fakrat)
			$bool=1;
		else
			$bool=0;
		$sql="UPDATE `student` SET `student_fakrat`=b'".$bool."' WHERE `student_matnr`='".$matnr."';";
		if( !mysql_query($sql) )
			return false;
		return true;
	}
	
	/**
	* Löscht einen Studenteneintrag (nicht die Person)
	* @param int $matnr die Matrikelnummer des zu löschenden Studenten.
	* @return bool ob erfolgreich oder nicht
	*/
	function removeStudent($matnr)
    {
		$sql="DELETE FROM `student` WHERE `student_matnr`='".$matnr."';";
		if( mysql_query($sql) )
			return true;
		else
			return false;
	}
	
	/**
	* Setzt eine Person als Lehrenden
	* @param int $pid Die Personen-ID die als Lehrender gestzt werden soll
	* @return bool ob erfolgreich oder nicht
	*/
	function addLehrender($pid)
	{
		// Prüfen ob Person schon gestzt als Lehrender
		$sql="SELECT `lehrende_id` FROM `unimanager`.`lehrende` WHERE `lehrende_personenid`='".$pid."';";
		$res = mysql_query($sql);
		if(!$res)
			return false;
		if( mysql_fetch_row($res) )
			return false;
		// Erstellen eines neuen Eintrags im Lehrender-Table
		$sql="INSERT INTO `unimanager`.`lehrende` (`lehrende_personenid`) VALUE ('".$pid."');";
		if( !mysql_query($sql) )
			return false;
		return true;
	}
	
	/**
	* Degradiert einen Lehrenden (löscht Lehrendeneintrag)
	* @param int $lid Lehrende-ID des zu löschenden Eintrags
	* @return bool ob erfolgreich oder nicht
	*/
	function removeLehrender($lid)
	{
		$sql="DELETE FROM `lehrende` WHERE `lehrende_id`='".$lid."';";
		if( mysql_query($sql) )
			return true;
		else
			return false;
	}
	
	
    /// HELPER ///
    
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