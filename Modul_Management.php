<?php
### Alle Funktionsparameter sind IDs au�er bei manueller Text eingabe ###
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
			$rows[0]['name']="Keine DB-Eintr�ge";
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
			$rows[0][0]="Keine DB-Eintr�ge";
			$rows[0][0]="NULL";
		}
		else{
			$fnum = mysql_num_fields($res);
			#liest alle Attribute dynamisch aus --> Anpassungen der Datenbankstruktur m�glich
			for($i=0;$i<$rnum;$i++)
				for($j=0;$j<$fnum;$j++) $rows[$i][$j]=mysql_result($res,$i,$j);
		}
		return $rows; # 2dim array
	}
	
	
	#L�schen eines Moduls nach ID
	function deleteModul($id){
		$sql = "DELETE FROM modul WHERE modul_id=" . $id;
		$res = mysql_query($sql);# false wenn L�schen fehlschl�gt
		# weitere DELETE/UPDATE notwendig in anderen Tables 
		# folgen wenn Abh�ngigkeiten klarer
		return $res; # bool
	}
	
	#Hinzuf�gen eines Moduls
	function addModul($dummy){
		#folgt wenn �bergabeinhalt bekannt
	}
	
	#Hinzuf�gen eines Moduls
	function setModuldetails($dummy){
		#folgt wenn �bergabeinhalt bekannt
	}
}