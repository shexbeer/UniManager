<?php

class SG_Management {

	///setter/// ohne Funktion weil noch keine Übergaben bekannt
	function createSG (){
	}
	
	function setSGdetails (){
	}
	
	function setPO (){
	}
	
	function setSO (){
	}
	
	function setDateForSG(){
	}
	
	function setModullisteForSG(){
	}
	
	function setSGstatus(){
	}
	
	///getter///
	
	//Liste aller Studiengaenge
	function getSGlist(){
		$sql = "SELECT sg_name, sg_id FROM studiengang ORDER BY sg_name";
		$res = mysql_query($sql);# false wenn Entity oder Attribut nicht existiert
		if(!$res)$rows['result']=false; //dient aktuell zur Fehlererkennung
		else{
			$rows['result']=true;
			$rnum=mysql_num_rows($res);# 0 wenn kein Treffer gefunden wurde
			for($i=0;$i<$rnum;$i++){
				$mod_id = mysql_result($res,$i,"sg_id");
				$rows[$mod_id]['name']=mysql_result($res,$i,"sg_name");
				$rows[$mod_id]['id']=$mod_id;
			}
		}
		return $rows;
	}
	
	//Inhalt ist mir nicht ganz klar --Diskusionsbedarf--
	function getTamplate(){
	}
	
	//
}

?>