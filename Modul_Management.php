<?php
### Alle Funktionsparameter sind IDs außer bei manueller Text eingabe ###
class Modul_Management {
	#Verbindung zur Datenbank einmalig beim erstellen
	function Modul_Management(){
		require_once("db.mysql.php");
	}
	
	#Abrufen aller Module in der Datenbank
	function getModullist(){
		$sql = "SELECT name, modul_id FROM modul ORDER BY name";
		$res = mysql_query($sql);# false wenn Entity oder Attribut nicht existiert
		if(!$res){
			$rows[0]['name']="Fehlende DB-Struktur";
			$rows[0]['id']="NULL";
			return $rows;
		}
		$rnum=mysql_num_rows($res);# 0 wenn kein Treffer gefunden wurde
		if ($rnum==0){
			$rows[0]['name']="Keine DB-Einträge";
			$rows[0]['id']="NULL";
		}
		else
			for($i=0;$i<$rnum;$i++){
				$rows[$i]['name']=mysql_result($res,$i,"name");
				$rows[$i]['id']=mysql_result($res,$i,"modul_id");
			}
		return $rows; # 2dim array
	}
	
	#Abrufen aller Module in der Datenbank samt Details
	function getModuldetails(){
		$sql = "SELECT * FROM modul ORDER BY name";
		$res = mysql_query($sql);# false wenn Entity oder Attribut nicht existiert
		if(!$res){
			$rows[0][0]="Fehlende DB-Struktur";
			$rows[0][0]="NULL";
			return $rows;
		}
		$rnum = mysql_num_rows($res);# 0 wenn kein Treffer gefunden wurde
		if ($rnum==0){
			$rows[0][0]="Keine DB-Einträge";
			$rows[0][0]="NULL";
		}
		else{
			$fnum = mysql_num_fields($res);
			#liest alle Attribute dynamisch aus --> Anpassungen der Datenbankstruktur möglich
			for($i=0;$i<$rnum;$i++)
				for($j=0;$j<$fnum;$j++) $rows[$i][$j]=mysql_result($res,$i,$j);
		}
		return $rows; # 2dim array
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
	
	#Hinzufügen eines Moduls
	function setModuldetails($dummy){
		#folgt wenn Übergabeinhalt bekannt
	}
}