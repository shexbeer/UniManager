<?php

### Bitte auf die Funktionsparameterbeschreibung achten ###
class Modul_Management{
	
	/**
	* Ruft Name und ID ab aller passender Module ab getModullist($status[,$type, $id[,$semtype,$sem]])
	  ACHTUNG: status hat keinen default-wert und muss immer mit angegeben werden.
	* @param bool $status ob Änderung(false) oder fertiges Modul(true)
	* @param string $type Art der ID ['sg','modul']
	* @param int $id die Id selbst
	* @param string $semtype ['total'--kalendarisches Semester,'plan'--Plansemester]
	* @param mixed $sem int für Plansemester, string zB 'SS2011' für kalendarisches Semester
	* @return mixed array mit DB-Resultaten, ['result'] enthält false bei DB-Fehler, array[modulID][attribut] das atribut heißt gleich dem DB-namen unsortiert,false wenn Parameter falsch
	*/
	function getModullist($status,$type=false,$id=false,$semtype=false,$sem=false){
		if($status){
			$table="modul";
			$attr[0]="modul_id";
			$attr[1]="modul_id";
			$attr[2]="modul_name";
			$attr[3]="modul_person_id";
			}
		else{
			$table="aenderungen";
			$attr[0]="aenderung_id";
			$attr[1]="aenderung_mid";
			$attr[2]="aenderung_mname";
		}
		return $this->getModul($table,$attr,$type,$id,$semtype,$sem);
	}
	
	/**
	* Ruft alle Modulatributte ab getModuldetails($status[,$type, $id[,$semtype,$sem]]) --bestimmte Module des Tables
	  ACHTUNG: status hat keinen default-wert und muss immer mit angegeben werden.
	* @param bool $status ob Änderung(false) oder fertiges Modul(true)
	* @param string $type Art der ID ['sg','modul']
	* @param int $id die Id selbst
	* @param string $semtype ['total'--kalendarisches Semester,'plan'--kalendarisches Semester]
	* @param mixed $sem int für Plansemester, string zB 'SS2011' für kalendarisches Semester
	* @return mixed array mit DB-Resultaten, ['result'] enthält false bei DB-Fehler, array[modulID][attribut] das atribut heißt gleich dem DB-namen unsortiert,false wenn Parameter falsch
	*/
	function getModuldetails($status,$type=false,$id=false,$semtype=false,$sem=false)
	{
		if($status)
		{
			$table="modul";
			$attr[0]="modul_id";
			$attr[1]="modul_id";
			$attr[2]="modul.*";
		}
		else
	{
			$table="aenderungen";
			$attr[0]="aenderung_id";
			$attr[1]="aenderung_mid";
			$attr[2]="aenderung.*";
		}
		return $this->getModul($table,$attr,$type,$id,$semtype,$sem);
	}
	
	/**
	* ACHTUNG: sollte nicht direkt aufegrufen werden!! Ruft bestimmte Modulatributte ab getModul($status,$attr[,$type, $id[,$semtype,$sem]]) --bestimmte Module des Tables
	* @param string $table aus welchem table werden die Daten geholt (wegen Änderung oder letztes fertiges Modul)
	* @param string $attr die gesuchten Attribute als array von strings index 0 enthält den Primärschlüsselwertnamen
	  ACHTUNG: die DBnamenskonvention table_attributname sollte eingehalten werden.
	* @param string $type Art der ID ['sg','modul']
	* @param int $id die Id selbst
	* @param string $semtype ['total'--kalendarisches Semester,'plan'--kalendarisches Semester]
	* @param mixed $sem int für Plansemester, string zB 'SS2011' für kalendarisches Semester
	* @return mixed array mit DB-Resultaten, ['result'] enthält false bei DB-Fehler, array[modulID][attribut] das atribut heißt gleich dem DB-namen geordnet dem attribut Namen nach,false wenn Parameter falsch
	*/
	private function getModul($table,$attr,$type=false,$id=false,$semtype=false,$sem=false){
		$str="";
		for($i=1;$i<count($attr)-1;$i++)$str=$str.$attr[$i].",";
		$str=$str.$attr[count($attr)-1];
		if(!$type){
			$sql = "SELECT ".$str." FROM ".$table;
			$res = mysql_query($sql);# false wenn Entity oder Attribut nicht existiert
			//2dim array array[modulID][attribut] id ist in den attributen ebenfalls vorhanden 
			return $this->buildResult($res,$attr[0]);
		}
		else{ //wenn Parameter vorhanden ab hier Auswertung
			$idtype=func_get_arg(2);
			$id=func_get_arg(3);
			switch($idtype){ // Typenunterscheidung (erster Parameter)
				case "modul":
					$sql = "SELECT ".$str." FROM ".$table." WHERE ".$attr[1]."=".$id;
					$res = mysql_query($sql);# false wenn Entity oder Attribut nicht existiert
					//2dim array array[modulID][attribut] id ist in den attributen ebenfalls vorhanden 
					return $this->buildResult($res,$attr[0]);
				case "sg":
					if(!$semtype){
						$sql = "SELECT ".$str.",mauf_plansemester FROM ".$table." INNER JOIN (studiengang INNER JOIN modulaufstellung ON sg_id=mauf_sg_id)ON mauf_modul_id=".$attr[1]." WHERE sg_id=".$id;
						$res = mysql_query($sql);
						//2dim array array[modulID][attribut] id ist in den attributen ebenfalls vorhanden 
						return $this->buildResult($res,$attr[0]);
					}
					else{
						$semtype=func_get_arg(4);
						$sem=func_get_arg(5);
						switch($semtype){
							case "plan":
								$sql = "SELECT ".$str.",mauf_plansemester FROM ".$table." INNER JOIN (studiengang INNER JOIN modulaufstellung ON sg_id=".$id." AND mauf_plansemester=".$sem." AND sg_id=mauf_sg_id)ON mauf_modul_id=".$attr[1];
								$res = mysql_query($sql);
								//2dim array array[modulID][attribut] id ist in den attributen ebenfalls vorhanden 
								return $this->buildResult($res,$attr[0]);
							case "total":
								$sql = "SELECT ".$str.",mauf_plansemester FROM ".$table." INNER JOIN ((studiengang INNER JOIN modulangebot ON sg_id=".$id." AND ma_semester=".$sem." AND sg_id=ma_sg) INNER JOIN modulaufstellung ON sg_id = mauf_sg_id) ON ma_modul=".$attr[1];
								$res = mysql_query($sql);
								//2dim array array[modulID][attribut] id ist in den attributen ebenfalls vorhanden 
								return $this->buildResult($res,$attr[0]);
							default:
								return false;
						}
					}
				default:
					return false;
			}
		}		
	}
	
	/**
	* Nur eine vereinfachung für mich, Füllt die DB-Resultate in eine array um (array[modulID][attribut])
	* @param mySql-Rsourcedatei $res
	* @return  array ['result'] enthält false bei DB-Fehler, array[modulID][attribut] das attribut heißt gleich dem DB-fieldnamen
	*/
	private function buildResult($res,$key){
		if(!$res)$rows['result']=false;//Fehlererkennung
		else{
			$rows['result']=true;
			$rnum=mysql_num_rows($res);# 0 wenn kein Treffer gefunden wurde
			$fnum = mysql_num_fields($res);
			for($i=0;$i<$rnum;$i++){
					$mod_id = mysql_result($res,$i,$key);
					for($j=0;$j<$fnum;$j++) $rows[$mod_id][mysql_field_name($res,$j)]=mysql_result($res,$i,$j);
			}
		}
		return $rows;
	}
	
	#Löschen eines Moduls nach ID
	function deleteModul($id){
		$sql = "DELETE FROM modul WHERE modul_id=" . $id;
		$res = mysql_query($sql);# false wenn Löschen fehlschlägt
		# weitere DELETE/UPDATE notwendig in anderen Tables 
		# Test ob gelöscht werden darf nötig
		return $res; # bool
	}
	
	
	/**
	* Diese Funktion erstellt ein neues Modul mit Attributen
	* @param string $modulname 
	* @param int $person ID des lehrenden der Verantwortung übernimmt für das Modul (zwingend notwendig)
		ACHTUNG!!! auf existenz prüfen damit keiner ein Modul erstellt mit einem Lehrenden der nicht in der Datenbank steht
	* @param mixed $moduldetails fakultative Attribute die nicht zwingen beim erstellen gesetzt werden müssen (kann weggelassen werden falls keine Attribute vorhanden)
		genau Struktur des array siehe setModuldetails weiterunten
	* @return int die Id des neuen Moduls oder false falls Fehler aufgetretten ist
	*/
	function addModul( $modulname,$person,$moduldetails=array() )
	{
		//Überprüfen ob der Name für das Modul schon verwendet wird
		$sql = "SELECT `modul_id` FROM `modul` WHERE `modul_name` = '".$modulname."';";
		$res = mysql_query($sql);
		if( mysql_fetch_row($res) )
			return false; //false falls der Namen schon vorhanden
		
		//Einfügen einer Zeile mit dem neuen Modul
		$sql = "INSERT INTO  `UniManager`.`modul` (`modul_name` , `modul_last_cha`, `modul_status`, `modul_person_id`) VALUES ('".$modulname."', CURDATE(), 'Erstellt', '".$person."');";
		if(mysql_query($sql))
		{
			$sql = "SELECT LAST_INSERT_ID();"; //Modul-ID für Rückgabe ermitteln
			$res = mysql_query($sql);
			$row = mysql_fetch_row($res);
			$modul_id = $row[0];
		}
		else return false; //Fehler beim Ausführen des INSERT
		return $this->setModuldetails($modul_id, $moduldetails, 'Erstellt');
			return $modul_id;
		//else 
			return false; //Fehler beim setzen der Attribute
	}
	
	/* strg+c Vorlage für alle die sich das tipen sparren wollen 
	$arr['institut']
	$arr['qualifytarget']
	$arr['content']
	$arr['literature']
	$arr['teachform']
	$arr['required']
	$arr['frequency']
	$arr['usability']
	$arr['lp']
	$arr['conditionforln']
	$arr['effort']
	$arr['person_id']
	$arr['note']
	*/
	
	/**
    * Mit dieser Funktion werden die Details gestezt oder upgedatet
	  das Datum wird automatisch gesetzt und die ID wie der Status sind zwingend und seperat anzugeben.
	  !!!ACHTUNG!!! zum resten kann man die Moduldaten als moduldetails setzen und den Status auf 'Genehmigt'
	  aber nur wenn vor der zu verwerfenden Änderung ein genehmigtes Modul vorhanden war.
	  Ansonsten Modul einfach löschen.
	* @param int $id Die Id des zu ändernden Moduls
    * @param mixed $moduldetails ein Array mit den Feldern der Werte die gesetzt werden sollen.
	mögliche Namen sind:
		institut
		duration
		qualifytarget
		content
		literature
		teachform
		required
		frequency
		usability
		lp
		conditionforln
		effort
		person_id
		note
	falls ein Feld nicht verändert werden soll darf es nicht gestezt werden
	* @param string $status Mögliche Stadien sind:
		Bearbeitung	--> der Aenderungseintrag zum Modul wird gesetzt
		Genehmigt	--> der Aenderungseintrag wird aktualisiert dann ins modul kopiert und gelöscht
		Erstellt	--> sollte nicht manuell gestezt werden sondern nur von der addModulfunktion
    * @return bool true fuer Erfolg und false fuer Misserfolg beim Eintragen in die Datenbank
    */
   	function setModuldetails ($id, $moduldetails, $status='Bearbeitung')
	{
		$arr=array();
		//Prüfen ob modul_id vorhanden
		if( isset($moduldetails['id']) ) 
			unset($moduldetails['id']);
		if( isset($moduldetails['status']) )
			unset($moduldetails['status']);
		if( isset($moduldetails['last_cha']) )
			unset($moduldetails['last_cha']);
		if( isset($moduldetails['name']) )
			unset($moduldetails['name']);
			
		if( isset($moduldetails['person_id']) )
		{
			$moduldetails['pid']=$moduldetails['person_id'];
			unset( $moduldetails['person_id'] );
		}
		
		foreach($moduldetails as $k => $v)
		{
			$arr[]="`aenderung_".$k."`='".$v."'";
		}
		// Überprüfen ob Änderungseintrag zum Modul vorhanden Anlegen eines neuen wenn nicht;
		$sql = "SELECT `aenderung_id` FROM `aenderungen` WHERE `aenderung_mid` = '".$id."';";
		$res = mysql_query($sql);
		$aenderung_id;
		if($res)
		{
			$aeID = mysql_fetch_row($res);
			if($aeID) 
			{
				$aenderung_id = $aeID[0];
				$sql = "UPDATE `aenderungen` SET `aenderung_status`='".$status."' WHERE `aenderung_id`='".$aenderung_id."';";
				if( !mysql_query($sql) ) return false; //Statusupdate fehlgeschalgen 
			}
			else
			{	
				$result = $this->getModullist(true, 'modul', $id);
				if( !$result['result'] )
					return false; //DB-Fehler oder das Modul zur Id existiert nicht
				$sql = "INSERT INTO  `UniManager`.`aenderungen` (`aenderung_mname` , `aenderung_mid`, `aenderung_last_cha`, `aenderung_status`, `aenderung_pid`) VALUES ('".$result[$id]['modul_name']."', '".$result[$id]['modul_id']."', NOW(), '".$status."', '".$result[$id]['modul_person_id']."');";
				if(mysql_query($sql))
				{
					$sql = "SELECT LAST_INSERT_ID();"; //Aenderungs-ID für Rückgabe ermitteln
					$res = mysql_query($sql);
					$row = mysql_fetch_row($res);
					$aenderung_id = $row[0];
				}
				else
					return false; //DB-Fehler beim erstellen der Veränderung [zum Debuggen sollte in Final nicht passieren können]
				$this->copyModulToChange($aenderung_id, $id, $status);
			}
		
		}
		else return false; // Fehler im query
		
		// Setzen der Änderungen im Änderungseintrag
		if( count($arr)!=0 )
		{
			$sql = "UPDATE `aenderungen` SET ";
			$sql = $sql.join(",",$arr);
			$sql = $sql." WHERE `aenderung_id`='".$aenderung_id."';";
			//return $sql;
			if( !mysql_query($sql) )
				return false; // Fehler beim Update
		}
		
		if($status=='Genehmigt')
		{
			$this->copyChangeToModul( $aenderung_id , 'Genehmigt' );
			$sql = "DELETE FROM `aenderungen` WHERE `aenderung_mid`='".$id."';";
			if( mysql_query($sql) )
				return true;
			else
				return false; //alte Aenderung konnte nicht gelöscht werden
		}
		else
		{
			$sql = "UPDATE `modul` SET `modul_status`='".$status."' WHERE `modul_id`='".$id."';";
			if( !mysql_query($sql) ) return false; //Statusupdate fehlgeschalgen 
			return true;
		}
	}
	
	/**
	* Erleichterung zum schnellen Ändern des Status
	* @param int $id Id des Modul dessen Status gesetzt werden soll
	* @param string $status Status auf den das Modul gesetzt werden soll
	* @return bool erfolgreich durchgeführt oder nicht 
	*/
	function setModulStatus($id, $status)
	{
		return $this->setModuldetails ($id, array(), $status);
	}
	
	//// Helper //// außerhalb der Management-Klassen nur mit vorsicht einsetzen 
	
	/**
	* Kopiert die Daten einer Änderung in des dazugehörende Modul und setzt den Modulstatus neu
		!!!ACHTUNG ausserhalb des Modul_Management nur verwenden wenn ihr genau wisst was ihr tut
	* @param $changeId Id der zu Kopierenden Veränderung (ModulId wird aus der Veränderung ermittelt)
	* @param $status der neue Status des Moduls nach der Kopie 
	* @return bool zeigt an ob erfolgreich verlaufen oder nicht
	*/
	function copyChangeToModul($changeId, $status)
	{
		$sql = "SELECT `aenderung_mid`, `aenderung_pid`, `aenderung_institut`, `aenderung_duration`,  `aenderung_qualifytarget`, `aenderung_content`, `aenderung_literature`, `aenderung_teachform`, `aenderung_required`, `aenderung_usability`, `aenderung_frequency`, `aenderung_lp`, `aenderung_conditionforln`, `aenderung_effort`, `aenderung_note` FROM `aenderungen` WHERE `aenderung_id`='".$changeId."';";
		$res = mysql_query($sql);
		if( !$res ) return false; //Fehler beim lesen der Änderung
		$row = mysql_fetch_row($res);
		if( !$row ) return false; //keine Änderung zum Kopieren vorhanden
		$sql = "UPDATE `modul` SET `modul_person_id`='".$row[1]."', `modul_institut`='".$row[2]."', `modul_duration`='".$row[3]."', `modul_qualifytarget`='".$row[4]."', `modul_content`='".$row[5]."', `modul_literature`='".$row[6]."', `modul_teachform`='".$row[7]."', `modul_required`='".$row[8]."', `modul_usability`='".$row[9]."', `modul_frequency`='".$row[10]."', `modul_lp`='".$row[11]."', `modul_conditionforln`='".$row[12]."', `modul_effort`='".$row[13]."', `modul_note`='".$row[14]."', `modul_status`='".$status."', `modul_last_cha`=CURDATE() WHERE `modul_id`='".$row[0]."';";
		if( !mysql_query($sql) ) return false; //Fehler beim updaten
		else return true;
	}
	
	/**
	* Kopiert die Daten einer Änderung in des dazugehörende Modul und setzt den Modulstatus neu
		!!!ACHTUNG ausserhalb des Modul_Management nur verwenden wenn ihr genau wisst was ihr tut
	* @param $changeId Id der Veränderung in die kopiert wird
	* @param $modulId Id des moduls aus dem die Daten geholt werden
	* @param $status der neue Status der Veränderung nach der Kopie 
	* @return bool zeigt an ob erfolgreich verlaufen oder nicht
	*/
	function copyModulToChange($changedId, $modulId, $status)
	{
		$sql = "SELECT `modul_person_id`, `modul_institut`, `modul_duration`,  `modul_qualifytarget`, `modul_content`, `modul_literature`, `modul_teachform`, `modul_required`, `modul_usability`, `modul_frequency`, `modul_lp`, `modul_conditionforln`, `modul_effort`, `modul_note` FROM `modul` WHERE `modul_id`='".$modulId."';";
		$res = mysql_query($sql);
		if( !$res ) return false; //Fehler beim lesen des Moduls
		$row = mysql_fetch_row($res);
		if( !$row ) return false; //keine Änderung zum Kopieren vorhanden
		$sql = "UPDATE `aenderungen` SET `aenderung_pid`='".$row[0]."', `aenderung_institut`='".$row[1]."', `aenderung_duration`='".$row[2]."', `aenderung_qualifytarget`='".$row[3]."', `aenderung_content`='".$row[6]."', `aenderung_literature`='".$row[5]."', `aenderung_teachform`='".$row[6]."', `aenderung_required`='".$row[7]."', `aenderung_usability`='".$row[8]."', `aenderung_frequency`='".$row[9]."', `aenderung_lp`='".$row[10]."', `aenderung_conditionforln`='".$row[11]."', `aenderung_effort`='".$row[12]."', `aenderung_note`='".$row[13]."', `aenderung_status`='".$status."', `aenderung_last_cha`=CURDATE() WHERE `aenderung_id`='".$changedId."';";
		if( !mysql_query($sql) ) return false; //Fehler beim updaten
		else return true;
	}
}