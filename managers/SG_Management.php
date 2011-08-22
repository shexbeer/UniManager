<?php

class SG_Management {

	///setter/// ohne Funktion weil noch keine Übergaben bekannt
	function createSG ($sgname,$sg_po,$sg_so,$sgmhb,$sgdekan){
        //hab mal die Übergabevariablen eingefügt Sebastian
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
	
	/**
	* Achtung sollte nicht direkt aufegrufen werden!! Ruft bestimmte atributte eines SG ab (Vorlage aus Modul_Management) getSG($attr,$id)
	  stark vereinfacht, da nach Sequenzdiagramm immer nur die allgemeine Liste oder ein bestimmter SG abgerufen wird --> keine JOINTS nötig
	* @param string $attr die gesuchten Attribute als String mit Komma getrennt
	* @param string $id 
	* @return mixed array mit DB-Resultaten, ['result'] enthält false bei DB-Fehler, array[modulID][attribut] das atribut heißt gleich dem DB-namen geordnet dem Attributnamen nach,false wenn Parameter falsch
	*/
	private function getSG($attr){
		if(func_num_args()==1){
			$sql = "SELECT ".$attr." FROM studiengang ORDER BY sg_name";
			$res = mysql_query($sql);# false wenn Entity oder Attribut nicht existiert
			//2dim array array[sg_id][attribut] id ist in den attributen ebenfalls vorhanden 
			return $this->buildResult($res,"sg_id");
		}
		else{ //wenn Parameter vorhanden ab hier Auswertung
			$id=func_get_arg(1);
			$sql = "SELECT ".$attr." FROM modul WHERE sg_id=".$id;
			$res = mysql_query($sql);# false wenn Entity oder Attribut nicht existiert
			
			//2dim array array[modulID][attribut] id ist in den attributen ebenfalls vorhanden 
			return $this->buildResult($res,"sg_id");
		}
	}		
	

	function getSO(){
	}
	

	function getPO(){
	}
	

	function getSIDListSG(){
	}
	
	
	/**
	*Ruft Liste aller SG ab
	 Ruft Name und ID ab aller passender Module ab getModullist([$id],[$status])
	* @param int $id die SG_ID
	* @param string $status optional für um nur SG mit einem bestimmten Status zu wählen  
	* @return mixed array mit DB-Resultaten, ['result'] enthält false bei DB-Fehler, array[sg_id][sg_name] das atribut heißt gleich dem DB-namen geordnet dem attribut Namen nach,false wenn Parameter falsch
	*/
	function getSGList(){
		switch(func_num_args()){
			case 0: return $this->getSG("sg_name,sg_id");
			case 1: return $this->getSG("sg_name,sg_id",func_get_arg(0));
			default: return false;
		}
	}
	
	/**
	*/
	function getSGDetails(){
		switch(func_num_args()){
			case 0: return $this->getModul("studiengang.*");
			case 1: return $this->getModul("studiengang.*",func_get_arg(0));
			default: return false;
	}
	
	
	//Inhalt ist mir nicht ganz klar --Diskusionsbedarf--
	function getTamplate(){
	}
	
	///Helper///
	
	/**
	* Erneut die buildResult aus Modul_Management, Füllt die DB-Resultate in eine array um (array[modulID][attribut])
	* @param mySql-Rsourcedatei $res
	* @return  array ['result'] enthält false bei DB-Fehler, array[modulID][attribut] das attribut heißt gleich dem DB-fieldnamen
	*/
	private function buildResult($res,$keyvalue){
		if(!$res)$rows['result']=false;//Fehlererkennung
		else{
			$rows['result']=true;
			$rnum=mysql_num_rows($res);# 0 wenn kein Treffer gefunden wurde
			$fnum = mysql_num_fields($res);
			for($i=0;$i<$rnum;$i++){
					$mod_id = mysql_result($res,$i,$keyvalue);
					for($j=0;$j<$fnum;$j++) $rows[$mod_id][mysql_field_name($res,$j)]=mysql_result($res,$i,$j);
			}
		}
		return $rows;
	}
	
	
}

?>