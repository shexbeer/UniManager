<?php
### Bitte auf die Funktionsparameterbeschreibung achten ###
class Modul_Management {
	#Verbindung zur Datenbank einmalig beim erstellen
	function Modul_Management(){
		require_once("db.mysql.php");
	}
	
	#Abrufen aller Module in der Datenbank
	function getModullist(){
		$sql = "SELECT modul_name,modul_id FROM modul ORDER BY modul_name";
		$res = mysql_query($sql);# false wenn Entity oder Attribut nicht existiert
		var_dump($res);
		if(!$res)$rows[result]=false
		else{
			$rows[result]=true
			$rnum=mysql_num_rows($res);# 0 wenn kein Treffer gefunden wurde
			for($i=0;$i<$rnum;$i++){
			// €nderung von shexbeer: Array wird nun nach Modul ID referenziert in unterster Ebene
				$mod_id = mysql_result($res,$i,"modul_id");
				$rows[$mod_id]['name']=mysql_result($res,$i,"modul_name");
				$rows[$mod_id]['id']=$mod_id;
			}
		}
		return $rows; # 2dim array
	}
	
	#Ruft Moduldetails ab
	#getModuldetails() --Deatils für alle Module im Table
 	#getModuldetails($type, $id[,$plansemester]) --liefert die Details entsprechend der id -- type sagt aus ob modul oder SG id 
	#wenn type="sg" dann ist Paramter Plansemester möglich um die richtige Modulaufstellung zu ermitteln
	#liefert false falls Pramater falsch;
	function getModuldetails(){
		if(func_num_args==0){
			$sql = "SELECT * FROM modul ORDER BY modul_name";
			$res = mysql_query($sql);# false wenn Entity oder Attribut nicht existiert
			if(!$res)$rows[result]=false;
			else{
				$rows[result]=true;
				$rnum = mysql_num_rows($res);# 0 wenn kein Treffer gefunden wurde
				$fnum = mysql_num_fields($res);
				#liest alle Attribute dynamisch aus --> Anpassungen der Datenbankstruktur möglich
				for($i=0;$i<$rnum;$i++)
					for($j=0;$j<$fnum;$j++) $rows[$i][$j]=mysql_result($res,$i,$j);
			}
			return $rows; # 2dim array
		}
		else{
			$type=func_get_arg(0);
			$id=func_get_arg(1);
			switch($type){
				case "modul":
					$sql = "SELECT * FROM modul WHERE modul_id=".$id;
					$res = mysql_query($sql);# false wenn Entity oder Attribut nicht existiert
					if(!$res)$rows[result]=false;//Fehlererkennung
					else{
						$rows[result]=true;
						$fnum = mysql_num_fields($res);
						#liest alle Attribute dynamisch aus --> Anpassungen der Datenbankstruktur möglich
						for($j=0;$j<$fnum;$j++) $rows[$j]=mysql_result($res,$id,$j);
					}
					return $rows;
				case "sg":
					return false;
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