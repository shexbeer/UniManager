<?php

class SG_Management {

	///setter/// ohne Funktion weil noch keine Übergaben bekannt
	function createSG ($sgname,$sg_po,$sg_so,$sgmhb,$sgdekan){
        //hab mal die Übergabevariablen eingefügt Sebastian
	}
    
    
	/**
    * Diese Funktion schreibt die Details zu einem Studiengang in die Datenbank
    * @param mixed $sgdetails ein Array mit den Feldern sg_id,sg_name;sg_po;sg_so;sg_modulhandbuch;sg_dekan
    * @return bool true fuer Erfolg und false fuer Misserfolg beim Eintragen in die Datenbank
    */
   	function setSGdetails ($sgdetails){
        //Param. und Erklaerung hinzugefügt Seb.
	}
	
	function setPO ($sg_id){
        //Param. hinzugefügt Seb.
	}
	
	function setSO ($sg_id){
        //Param. hinzugefügt Seb.
	}
	
	function setDateForSG(){
	}
	
    /**
    * Speichert in der Datenbank ab, welche Module zu einem bestimmten Studiengang gehoeren
    * @param int $sg_id ID des Studienganges dessen Liste geaendert werden soll
    * @param mixed $modul_ID_list  Array mit den Feldern count und  modul_id das nacheinander alle zu dem Studiengang gehoerigen Module_IDs enthaelt
    * @return bool true fuer Erfolg und false fuer Misserfolg beim Eintragen in die Datenbank
    */
	function setModullisteForSG($sg_id,$modul_ID_list){
        //Parameter und Erkl. hinzugefuegt Seb.
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
	

	function getSO($sg_id){
        //Parameter hinzugefügt Seb.
	}
	

	function getPO($sg_id){
        //Parameter hinzugefügt Seb.
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
    }
	
	
	//Inhalt ist mir nicht ganz klar --Diskusionsbedarf--
	function getTamplate(){
        /*Soll die Vorlage für eine Studienordnung und eine Prüfungsordnung aus der Datenbank abrufen und zurückgeben; die Vorlagen müssen noch in der SQL Datenbank erstellt werden
        Zweck ist es bei der Erstellung auf ein schon vorgefertigtes Dokument zurückgreifen zu können, damit der Ersteller nicht soviel schreiben muss sondern nur noch die relevanten Informationen ersetzen muss
        Sebastian*/
        
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