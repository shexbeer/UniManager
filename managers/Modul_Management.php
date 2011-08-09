<?php

### Bitte auf die Funktionsparameterbeschreibung achten ###
class Modul_Management{
	
	/**
	* Ruft Name und ID ab aller passender Module ab getModullist([$type, $id[,$semtype,$sem]])
	* @param string $type Art der ID ['sg','modul']
	* @param int $id die Id selbst
	* @param string $semtype ['total'--kalendarisches Semester,'plan'--kalendarisches Semester]
	* @param mixed $sem int für Plansemester, string zB 'SS2011' für kalendarisches Semester
	* @return mixed array mit DB-Resultaten, ['result'] enthält false bei DB-Fehler, array[modulID][attribut] das atribut heißt gleich dem DB-namen geordnet dem attribut Namen nach,false wenn Parameter falsch
	*/
	function getModullist(){
		switch(func_num_args()){
			case 0: return $this->getModul("modul_name,modul_id");
			case 2: return $this->getModul("modul_name,modul_id",func_get_arg(0),func_get_arg(1));
			case 4: return $this->getModul("modul_name,modul_id",func_get_arg(0),func_get_arg(1),func_get_arg(2),func_get_arg(3));
			default: return false;
		}
	}
	
	/**
	* Ruft alle Modulatributte ab getModuldetails([$type, $id[,$semtype,$sem]]) --bestimmte Module des Tables
	* @param string $type Art der ID ['sg','modul']
	* @param int $id die Id selbst
	* @param string $semtype ['total'--kalendarisches Semester,'plan'--kalendarisches Semester]
	* @param mixed $sem int für Plansemester, string zB 'SS2011' für kalendarisches Semester
	* @return mixed array mit DB-Resultaten, ['result'] enthält false bei DB-Fehler, array[modulID][attribut] das atribut heißt gleich dem DB-namen geordnet dem attribut Namen nach,false wenn Parameter falsch
	*/
	function getModuldetails(){
		switch(func_num_args()){
			case 0: return $this->getModul("modul.*");
			case 2: return $this->getModul("modul.*",func_get_arg(0),func_get_arg(1));
			case 4: return $this->getModul("modul.*",func_get_arg(0),func_get_arg(1),func_get_arg(2),func_get_arg(3));
			default: return false;
		}
	}
	
	/**
	* Achtung sollte nicht direkt aufegrufen werden!! Ruft bestimmte Modulatributte ab getModul($attr,$type, $id[,$semtype,$sem]) --bestimmte Module des Tables
	* @param string $attr die gesuchten Attribute als String mit Komma getrennt
	* @param string $type Art der ID ['sg','modul']
	* @param int $id die Id selbst
	* @param string $semtype ['total'--kalendarisches Semester,'plan'--kalendarisches Semester]
	* @param mixed $sem int für Plansemester, string zB 'SS2011' für kalendarisches Semester
	* @return mixed array mit DB-Resultaten, ['result'] enthält false bei DB-Fehler, array[modulID][attribut] das atribut heißt gleich dem DB-namen geordnet dem attribut Namen nach,false wenn Parameter falsch
	*/
	private function getModul($attr){
		if(func_num_args()==1){
			$sql = "SELECT ".$attr." FROM modul ORDER BY modul_name";
			$res = mysql_query($sql);# false wenn Entity oder Attribut nicht existiert
			//2dim array array[modulID][attribut] id ist in den attributen ebenfalls vorhanden 
			return $this->buildResult($res);
		}
		else{ //wenn Parameter vorhanden ab hier Auswertung
			$idtype=func_get_arg(1);
			$id=func_get_arg(2);
			switch($idtype){ // Typenunterscheidung (erster Parameter)
				case "modul":
					$sql = "SELECT ".$attr." FROM modul WHERE modul_id=".$id;
					$res = mysql_query($sql);# false wenn Entity oder Attribut nicht existiert
					//2dim array array[modulID][attribut] id ist in den attributen ebenfalls vorhanden 
					return $this->buildResult($res);
				case "sg":
					if(func_num_args()>3){
						$semtype=func_get_arg(3);
						$sem=func_get_arg(4);
						switch($semtype){
							case "plan":
								$sql = "SELECT ".$attr." FROM modul INNER JOIN (studiengang INNER JOIN modulaufstellung ON sg_id=".$id." AND mauf_plansemester=".$sem." )ON mauf_modul_id=modul_id";
								$res = mysql_query($sql);
								//2dim array array[modulID][attribut] id ist in den attributen ebenfalls vorhanden 
								return $this->buildResult($res);
							case "total":
								$sql = "SELECT ".$attr." FROM modul INNER JOIN (studiengang INNER JOIN modulangebot ON sg_id=".$id." AND ma_semester=".$sem." )ON mauf_modul_id=modul_id";
								$res = mysql_query($sql);
								//2dim array array[modulID][attribut] id ist in den attributen ebenfalls vorhanden 
								return $this->buildResult($res);
							default:
								return false;
							}
						}
					else{
						$sql = "SELECT ".$attr." FROM modul INNER JOIN (studiengang INNER JOIN modulaufstellung ON sg_id=".$id.")ON mauf_modul_id=modul_id";
						$res = mysql_query($sql);
						//2dim array array[modulID][attribut] id ist in den attributen ebenfalls vorhanden 
						return $this->buildResult($res);
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
	private function buildResult($res){
		if(!$res)$rows['result']=false;//Fehlererkennung
		else{
			$rows['result']=true;
			$rnum=mysql_num_rows($res);# 0 wenn kein Treffer gefunden wurde
			$fnum = mysql_num_fields($res);
			for($i=0;$i<$rnum;$i++){
					$mod_id = mysql_result($res,$i,"modul_id");
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