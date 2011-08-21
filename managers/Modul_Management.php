<?php

### Bitte auf die Funktionsparameterbeschreibung achten ###
class Modul_Management{
	
	/**
	* Ruft Name und ID ab aller passender Module ab getModullist($status[,$type, $id[,$semtype,$sem]])
	  ACHTUNG: status hat keinen default-wert und muss immer mit angegeben werden.
	* @param bool $status ob Änderung(false) oder fertiges Modul(true)
	* @param string $type Art der ID ['sg','modul']
	* @param int $id die Id selbst
	* @param string $semtype ['total'--kalendarisches Semester,'plan'--kalendarisches Semester]
	* @param mixed $sem int für Plansemester, string zB 'SS2011' für kalendarisches Semester
	* @return mixed array mit DB-Resultaten, ['result'] enthält false bei DB-Fehler, array[modulID][attribut] das atribut heißt gleich dem DB-namen unsortiert,false wenn Parameter falsch
	*/
	function getModullist($status,$type=false,$id=false,$semtype=false,$sem=false){
		if($status){
			$table="modul";
			$attr[0]="modul_id";
			$attr[1]="modul_id";
			$attr[2]="modul_name";
			}
		else{
			$table="aenderung";
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
	function getModuldetails($status,$type=false,$id=false,$semtype=false,$sem=false){
		if($status){
			$table="modul";
			$attr[0]="modul_id";
			$attr[1]="modul.*";
		}
		else{
			$table="aenderung";
			$attr[0]="aenderung_id";
			$attr[1]="aenderung.*";
		}
		return $this->getModul($table,$attr,$type,$id,$semtype,$sem);
	}
	
	/**
	* ACHTUNG: sollte nicht direkt aufegrufen werden!! Ruft bestimmte Modulatributte ab getModul($status,$attr[,$type, $id[,$semtype,$sem]]) --bestimmte Module des Tables
	* @param string $table aus welchem table werden die Daten geholt (wegen Änderung oder fertiges Modul)
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
					$sql = "SELECT ".$str." FROM ".$table." WHERE ".$attr[0]."=".$id;
					$res = mysql_query($sql);# false wenn Entity oder Attribut nicht existiert
					//2dim array array[modulID][attribut] id ist in den attributen ebenfalls vorhanden 
					return $this->buildResult($res,$attr[0]);
				case "sg":
					if(!$semtype){
						$sql = "SELECT ".$str." FROM ".$table." INNER JOIN (studiengang INNER JOIN modulaufstellung ON sg_id=".$id.")ON mauf_modul_id=".$attr[0];
						$res = mysql_query($sql);
						//2dim array array[modulID][attribut] id ist in den attributen ebenfalls vorhanden 
						return $this->buildResult($res,$attr[0]);
					}
					else{
						$semtype=func_get_arg(4);
						$sem=func_get_arg(5);
						switch($semtype){
							case "plan":
								$sql = "SELECT ".$str." FROM ".$table." INNER JOIN (studiengang INNER JOIN modulaufstellung ON sg_id=".$id." AND mauf_plansemester=".$sem." )ON mauf_modul_id=".$attr[0];
								$res = mysql_query($sql);
								//2dim array array[modulID][attribut] id ist in den attributen ebenfalls vorhanden 
								return $this->buildResult($res,$attr[0]);
							case "total":
								$sql = "SELECT ".$str." FROM ".$table." INNER JOIN (studiengang INNER JOIN modulangebot ON sg_id=".$id." AND ma_semester=".$sem." )ON mauf_modul_id=".$attr[0];
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
		# folgen wenn Abhängigkeiten klarer
		return $res; # bool
	}
	
	#Hinzufügen eines Moduls
	function addModul($dummy){
		#folgt wenn Übergabeinhalt bekannt
	}
	
	#Hinzufügen eines Moduls mit Details
	function setModuldetails($dummy){
		#folgt wenn Übergabeinhalt bekannt
	}
	
	
}