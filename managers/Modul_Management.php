<?php

### Bitte auf die Funktionsparameterbeschreibung achten ###
class Modul_Management{
	
	#Abrufen aller Module in der Datenbank mit Name und ID
	function getModullist(){
		$sql = "SELECT modul_name,modul_id FROM modul ORDER BY modul_name";
		$res = mysql_query($sql);# false wenn Entity oder Attribut nicht existiert
		return buildResult($res);
	}
	
	/**
	* Ruft Moduldetails ab getModuldetails() --alle Module des Tables getModuldetails($type, $id[,$semestertype,$semester]) --bestimmte Module des Tables
	* @param string $type Art der ID ['sg','modul']
	* @param int $id die Id selbst
	* @param string $semestertype ['total'--kalendarisches Semester,'plan'--kalendarisches Semester]
	* @param mixed $semester int für Plansemester, string zB 'SS2011' für kalendarisches Semester
	* @return mixed array mit DB-Resultaten, ['result'] enthält false bei DB-Fehler, array[modulID][attribut] das atribut heißt gleich dem DB-namen geordnet dem attribut Namen nach,false wenn Parameter falsch
	*/
	function getModuldetails(){
		if(func_num_args()==0){
			$sql = "SELECT * FROM modul ORDER BY modul_name";
			$res = mysql_query($sql);# false wenn Entity oder Attribut nicht existiert
			//2dim array array[modulID][attribut] id ist in den attributen ebenfalls vorhanden 
			return buildResult($res);
		}
		else{ //wenn Parameter vorhanden ab hier Auswertung
			$idtype=func_get_arg(0);
			$id=func_get_arg(1);
			switch($idtype){ // Typenunterscheidung (erster Parameter)
				case "modul":
					$sql = "SELECT * FROM modul WHERE modul_id=".$id;
					$res = mysql_query($sql);# false wenn Entity oder Attribut nicht existiert
					//2dim array array[modulID][attribut] id ist in den attributen ebenfalls vorhanden 
					return buildResult($res);
				case "sg":
					if(func_num_args()>2){
						$semtype=func_get_arg(2);
						$sem=func_get_arg(3);
						switch($semtype){
							case "plan":
								$sql = "SELECT modul.* FROM modul INNER JOIN (studiengang INNER JOIN modulaufstellung ON sg_id=".$id." AND mauf_plansemester=".$sem." )ON mauf_modul_id=modul_id";
								$res = mysql_query($sql);
								//2dim array array[modulID][attribut] id ist in den attributen ebenfalls vorhanden 
								return buildResult($res);
							case "total":
								$sql = "SELECT modul.* FROM modul INNER JOIN (studiengang INNER JOIN modulangebot ON sg_id=".$id." AND mang_semester=".$sem." )ON mauf_modul_id=modul_id";
								$res = mysql_query($sql);
								//2dim array array[modulID][attribut] id ist in den attributen ebenfalls vorhanden 
								return buildResult($res);
							default:
								return false;
							}
						}
					else{
						$sql = "SELECT modul.* FROM modul INNER JOIN (studiengang INNER JOIN modulaufstellung ON sg_id=".$id.")ON mauf_modul_id=modul_id";
						$res = mysql_query($sql);
						//2dim array array[modulID][attribut] id ist in den attributen ebenfalls vorhanden 
						return buildResult($res);
					}
				default:
					return false;
			}
		}		
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

function buildResult($res){
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