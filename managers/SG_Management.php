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
		$rows[result]=
		if(!$res)$rows[result]=false; //dient aktuell zur Fehlererkennung
		else{
			$rows[result]=true;
			for($i=0;$i<$rnum;$i++){
				$mod_id = mysql_result($res,$i,"sg_id");
				$rows[$mod_id]['name']=mysql_result($res,$i,"sg_name");
				$rows[$mod_id]['id']=$mod_id;
			}
		}
		return $row
	}
	
	//Inhalt ist mir nicht ganz klar --Diskusionsbedarf--
	function getTamplate(){
	}
	
	//
}

?>