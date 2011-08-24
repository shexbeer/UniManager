<?php

class SG_Management {

	///setter/// ohne Funktion weil noch keine Übergaben bekannt
	function createSG ($sgname,$sg_po,$sg_so,$sgmhb,$sgdekan){
        //hab mal die Übergabevariablen eingefügt Sebastian
	}
    
    
	/**
    * Diese Funktion schreibt die Details zu einem Studiengang in die Datenbank
    * @param mixed $sgdetails ein Array mit den Feldern sg_id, sg_name, sg_po, sg_so, sg_modulhandbuch, sg_dekan
    * @return bool true fuer Erfolg und false fuer Misserfolg beim Eintragen in die Datenbank
    */
   	function setSGdetails ($sgdetails){
        //Param. und Erklaerung hinzugefügt Seb.
	}
	
	function setPO ($sg_id,$po){
        //Param. hinzugefügt Seb.
	}
	
	function setSO ($sg_id,$so){
        //Param. hinzugefügt Seb.
	}
	
	function setDateForSG(){
	}
	
    /**
    * Speichert in der Datenbank ab, welche Module zu einem bestimmten Studiengang gehoeren
    * @param int $sg_id ID des Studienganges dessen Liste gesetzt werden soll
    * @param mixed $modul_ID_list  Array mit den Feldern count, modul_id und plansemester das nacheinander alle zu dem Studiengang gehoerigen Module_IDs und die jewaligen Plansemester enthaelt
    * @return bool true fuer Erfolg und false fuer Misserfolg beim Eintragen in die Datenbank
    */
	function setModullisteForSG($sg_id,$modul_ID_list){
        //Parameter und Erkl. hinzugefuegt Seb.
	}
	
    
	function setSGstatus(){
	}
	
	///getter///
	
	
	
	/**
	* Ruft ruft SO eines SG ab 
	* @param int $id ID des SG
	* @return mixed array mit DB-Resultaten, ['result'] enthält false bei DB-Fehler, array[sg_id][sg_so]
	*/
	function getSO($id){
        $attr[0]="sg_id";
		$attr[1]="sg_id";
		$attr[2]="sg_so";
		return $this->getSG(false,$attr,$id);
	}
	

	/**
	* Ruft ruft PO eines SG ab 
	* @param int $id ID des SG
	* @return mixed array mit DB-Resultaten, ['result'] enthält false bei DB-Fehler, array[sg_id][sg_po]
	*/
	function getPO($id){
        $attr[0]="sg_id";
		$attr[1]="sg_id";
		$attr[2]="sg_po";
		return $this->getSG(false,$attr,$id);
	}
	
	/// ?????? was soll die holen?
	function getSIDListSG(){
	}
	
	
	/**
	* Ruft Name, ID und Status aller SG ab 
	* @param string $paramtype optional "status" um SGs nach status zu filtern oder "id" um einen bestimmten SG zu wählen
	* @param mixed $param int: bei id, string: bei status ('kreiert','konstruiert','beschlossen','abgestimmt','bestätigt')
	* @return mixed array mit DB-Resultaten, ['result'] enthält false bei DB-Fehler, array[sg_id][Attribut] das Attribut heißt gleich dem DB-namen
	*/
	function getSGlist($paramtype=false,$param=false){
		$attr[0]="sg_id";
		$attr[1]="sg_id";
		$attr[2]="sg_name";
		$attr[3]="sg_status";
		if(!$paramtype)return $this->getSG(false,$attr);
		if($paramtype=="status")return $this->getSG($param,$attr);
		if($paramtype=="id")return $this->getSG(false,$attr,$param);
	}
	
	/**
	* Ruft alle Details aller oder eines bestimmten SG ab 
	* @param string $paramtype optional "status" um SGs nach status zu filtern oder "id" um einen bestimmten SG zu wählen
	* @param mixed $param int: bei id, string: bei status ('kreiert','konstruiert','beschlossen','abgestimmt','bestätigt')
	* @return mixed array mit DB-Resultaten, ['result'] enthält false bei DB-Fehler, array[sg_id][Attribut] das Attribut heißt gleich dem DB-namen
	*/
	function getSGdetails($paramtype=false,$param=false){
		$attr[0]="sg_id";
		$attr[1]="studiengang.*";
		if(!$paramtype)return $this->getSG(false,$attr);
		if($paramtype=="status")return $this->getSG($param,$attr);
		if($paramtype=="id")return $this->getSG(false,$attr,$param);
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
	  setzt Eintrag "sg_so" auf false falls SO und PO in ein un der selben Datei liegen kann rausgenommen werden falls wir nur die Strings speichern
	* @param mySql-Rsourcedatei $res
	* @return array ['result'] enthält false bei DB-Fehler, array[modulID][attribut] das attribut heißt gleich dem DB-fieldnamen
	*/
	private function buildResult($res,$keyvalue){
		if(!$res)$rows['result']=false;//Fehlererkennung
		else{
			$rows['result']=true;
			$rnum=mysql_num_rows($res);# 0 wenn kein Treffer gefunden wurde
			$fnum=mysql_num_fields($res);
			for($i=0;$i<$rnum;$i++){
				$key = mysql_result($res,$i,$keyvalue);
				for($j=0;$j<$fnum;$j++)$rows[$key][mysql_field_name($res,$j)]=mysql_result($res,$i,$j);
			}
		}
		return $rows;
	}
	
	/**
	* Achtung sollte nicht direkt aufegrufen werden!! Ruft bestimmte atributte eines SG ab (Vorlage aus Modul_Management)
	  stark vereinfacht, da nach Sequenzdiagramm immer nur die allgemeine Liste oder ein bestimmter SG abgerufen wird --> keine JOINTS nötig
	* @param string $status der Status des SG 
	* @param string $attr die gesuchten Attribute als String mit Komma getrennt
	* @param string $id die SG-id wenn bestimmer SG gesucht wird.
	* @return mixed array mit DB-Resultaten, ['result'] enthält false bei DB-Fehler, array[modulID][attribut] das atribut heißt gleich dem DB-namen geordnet dem Attributnamen nach,false wenn Parameter falsch
	*/
	private function getSG($status,$attr,$id=false){
		$where="";
		$str="";
		for($i=1;$i<count($attr)-1;$i++)$str=$str.$attr[$i].",";
		$str=$str.$attr[count($attr)-1];
		if(!$status)$where="sg_status IS NOT NULL";
		else $where="sg_status='".$status."'";
		if(!$id){
			$sql = "SELECT ".$str." FROM studiengang WHERE ".$where;
			$res = mysql_query($sql);# false wenn Entity oder Attribut nicht existiert
			//2dim array array[sg_id][attribut] id ist in den attributen ebenfalls vorhanden 
			return $this->buildResult($res,$attr[0]);
		}
		else{ //wenn Parameter vorhanden ab hier Auswertung
			$sql = "SELECT ".$str." FROM studiengang WHERE ".$attr[0]."=".$id." AND ".$where;
			$res = mysql_query($sql);# false wenn Entity oder Attribut nicht existiert
			
			//2dim array array[sg_id][attribut] id ist in den attributen ebenfalls vorhanden 
			return $this->buildResult($res,$attr[0]);
		}
	}		
}

?>