<?php

class SG_Management {

	/**
	* Erstellt neuen Studiengang mit den gegebenen Startwerten
	  es wird nur eine leere Hülse erstellt mit dem nötigsten, das wirklich da sein muss
	  der Status wird automatisch auf kreiert gesetzt sowie das Erstellungsdatum festgelegt
	* @param string $sgname Name des Studiengangs
	* @param int $sgdekan ID des Studiendekans für den neuen Studiengang
	* @param int $sgtyp Typ des Studiengangs
	* @return mixed die ID des SG als int wenn Erfolg, sonst false
	*/
	function createSG ($sgname,$sgdekan, $sgtyp){
		//Überprüfen ob der Name für den SG schon verwendet wird
		$sql = "SELECT `sg_name` FROM `studiengang` WHERE `sg_name` = '".$sgname."';";
		$res = mysql_query($sql);
		if(mysql_fetch_row($res))return false; //false falls der Namen schon vorhanden
		//Einfügen einer Zeile mit dem neuen Studiengang
		$sql = "INSERT INTO  `UniManager`.`studiengang` (`sg_name` ,`sg_dekan`, `sg_createdate`, `sg_status` , `sg_typ`) VALUES ('".$sgname."', '".$sgdekan."', CURDATE(), 'kreiert', '".$sgtyp."');";
		echo $sql;
		if(mysql_query($sql)){
			$sql = "SELECT LAST_INSERT_ID();"; //SG-ID für Rückgabe ermitteln
			$res = mysql_query($sql);
			$row = mysql_fetch_row($res);
			return $row[0];
		}
		else return false; //Fehler beim Ausführen des SQLquery
	}
    /**
	* Funktion zum lšschen eines SG
	  nur der Vollständigkeit halber, sollte in der Praxis nur im äußersten Notfall verwendet werden
	* @param int $sgid
	* @return bool ob erfolgreich oder nicht 
	*/
	function deleteSG($sgid)
	{
		$sql="DELETE FROM `studiengang` WHERE `sg_id`='".$sgid."';";
		if( mysql_query($sql) )
			return true;
		else
			return false;
	}
	
	/**
    * Mit dieser Funktion werden die Details gestezt oder upgedatet
    * @param mixed $sgdetails ein Array mit den Feldern sg_id, sg_name, sg_po, sg_so, sg_modulhandbuch, sg_dekan, sg_status
	  falls ein Feld nicht verändert werden soll darf es nicht gestezt werden --> sg_id ist das einzigste Pflichtfeld
    * @return bool true fuer Erfolg und false fuer Misserfolg beim Eintragen in die Datenbank
    */
   	function setSGdetails ($sgdetails){
		$arr=array();
		//Prüfen ob sg_id vorhanden
		if(isset ($sgdetails['sg_id']))
		{
			$sg_id=$sgdetails['sg_id'];
			unset($sgdetails['sg_id']);
		}
		else return false;
		foreach($sgdetails as $k => $v)
		{
			$arr[]="`".$k."`='".$v."'";
		}
		$sql = "UPDATE `studiengang` SET ";
		$sql = $sql.join(",",$arr);
		$sql = $sql." WHERE `sg_id`=".$sg_id.";";
		return mysql_query($sql);
	}
	
	/**
    * ermöglicht das bequeme setzen der PO ohne array
	  beutzt die setSGdetails, kann also auch dadurch ersetzt werden 	
	* @param int $sg_id ID des SG
	* @param string $po Prüfungsordnung
	* @return bool true fuer Erfolg und false fuer Misserfolg beim Eintragen in die Datenbank
    */
	function setPO ($sg_id,$po){
        $arr['sg_id']=$sg_id;
		$arr['sg_po']=$po;
		return $this->setSGdetails($arr);
	}
	
	/**
    * ermöglicht das bequeme setzen der SO ohne array
	  beutzt die setSGdetails, kann also auch dadurch ersetzt werden 	
	* @param int $sg_id ID des SG
	* @param string $so Prüfungsordnung
	* @return bool true fuer Erfolg und false fuer Misserfolg beim Eintragen in die Datenbank
    */
	function setSO ($sg_id,$so){
        $arr['sg_id']=$sg_id;
		$arr['sg_so']=$so;
		return $this->setSGdetails($arr);
	}
	
	/* Dürfte eigentlich nicht notwendig sein, da Datum automatisch bei erstellung gesetzt
	function setDateForSG(){
	}
	*/
	
    /**
    * Speichert in der Datenbank ab, welche Module zu einem bestimmten Studiengang gehoeren
	  ACHTUNG!!! Liste muss immer komplett angegeben werden alte Daten werden gelöscht.
    * @param int $sg_id ID des Studienganges dessen Liste gesetzt werden soll
	* @param string $typ Typ des Studiengangs Bachelor, Master, Diplom
    * @param mixed $modul_ID_list  2 dim Array mit den Feldern [count],[modul_id,plansemester,typ] das nacheinander alle zu dem Studiengang gehoerigen Module_IDs, Plansemester und den Typ enthaelt
    * @return bool true fuer Erfolg und false fuer Misserfolg beim Eintragen in die Datenbank
    */
	function setModullisteForSG($sg_id,$typ,$modul_ID_list){
		//ermitteln und speicher alter Modulaufstellung
        $sqlselect="SELECT `mauf_rowid` FROM `unimanager`.`modulaufstellung` WHERE `mauf_sg_id`='".$sg_id."';";
		$res = mysql_query($sqlselect); 
		if(!$res)return false; //DB-Fehler
		
		//Aufbauen des WHERE-Statements für den späteren DELET query
		$DelArrOld;
		$isold=false;
		while($row=mysql_fetch_row($res))
		{
			$DelArrOld[]="`mauf_rowid`='".$row[0]."'";
			$isold=true; //mindestens ein Treffer und somit alte Aufstellung vorhanden
		}
		
		$isset=true;
		//setzen der neuen modulaufstellung
		$DelArrNew;
		//var_dump($modul_ID_list);
		foreach ($modul_ID_list as $modul)
		{
			if (!isset($modul['modul_id'])||!isset($modul['plansemester'])) return false;
			$sqlinsert="INSERT INTO `unimanager`.`modulaufstellung` (`mauf_modul_id`, `mauf_sg_id`, `mauf_plansemester`, `mauf_typ`) VALUE ('".$modul['modul_id']."', '".$sg_id."', '".$modul['plansemester']."', '".$typ."');";
			
			if(mysql_query($sqlinsert))
			{
				$row = mysql_fetch_row(mysql_query("SELECT LAST_INSERT_ID();"));
				$DelArrNew[]="`mauf_rowid`='".$row[0]."'"; //speichern der ID für möglichen Rollback
			}
			else
			{
				$isset=false;
				break;
			}
		}
		
		//löschen der alten aufstellung wenn vorhanden und neue erfoglreich gestzt wurde
		if($isset&&$isold)
		{
			$DelWhere=join(" OR ",$DelArrOld);
			$sqldelete="DELETE FROM `unimanager`.`modulaufstellung` WHERE ".$DelWhere.";";
			
			return mysql_query($sqldelete);
		}
		//Rollback der neuen Aufstellung da nicht vollständig
		if(!$isset)
		{
			$DelWhere=join(" OR ",$DelArrNew);
			$sqldelete="DELETE FROM `unimanager`.`modulaufstellung` WHERE ".$DelWhere.";";
			return mysql_query($sqldelete);
		}
		return $isset;
	}
	
    /**
    * ermöglicht das bequeme setzen des Status ohne array
	  beutzt die setSGdetails, kann also auch dadurch ersetzt werden 	
	* @param int $sg_id ID des SG
	* @param string $status Status des SG ('kreiert','konstruiert','beschlossen','abgestimmt','bestätigt')
	* @return bool true fuer Erfolg und false fuer Misserfolg beim Eintragen in die Datenbank
    */
	function setSGstatus($sg_id,$status){
		$arr['sg_id']=$sg_id;
		$arr['sg_status']=$status;
		return $this->setSGdetails($arr);
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
	/**
	* Ruft ruft Modulhandbuch eines SG ab 
	* @param int $id ID des SG
	* @return mixed array mit DB-Resultaten, ['result'] enthält false bei DB-Fehler, array[sg_id][sg_po]
	*/
	function getModulhandbuch($id){
        $attr[0]="sg_id";
		$attr[1]="sg_id";
		$attr[2]="sg_modulhandbuch";
		return $this->getSG(false,$attr,$id);
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
		$attr[4]="sg_dekan";
		$attr[5]="sg_typ";
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
	
	
	/*Soll die Vorlage fŸr eine Studienordnung und eine PrŸfungsordnung aus der Datenbank abrufen und zurŸckgeben; die Vorlagen mŸssen noch in der SQL Datenbank erstellt werden
        Zweck ist es bei der Erstellung auf ein schon vorgefertigtes Dokument zurŸckgreifen zu kšnnen, damit der Ersteller nicht soviel schreiben muss sondern nur noch die relevanten Informationen ersetzen muss
        Sebastian*/
	function getTemplate($typ, $titelseite, $content, $ziele, $footerseite, $modullist) {
        $UM = new UniManager();
        $etemps = $UM->checkPOSOTemplates();
        switch($typ) {
        	case "Bachelor":
        		if($etemps[0] == true) $path = $UM->getPOSOTemplatePath($typ);
        		break;
        	case "Master":
        		if($etemps[1] == true) $path = $UM->getPOSOTemplatePath($typ);
        		break;
        	case "Diplom":
        		if($etemps[2] == true) $path = $UM->getPOSOTemplatePath($typ);
        		break;
    	} 
    	if(!$path) return false;
    	$UM->tpl->assign("titelseite", $titelseite);
		$UM->tpl->assign("c", $content);
		$UM->tpl->assign("footer", $footerseite);
		$UM->tpl->assign("ziele", $ziele);
		$UM->tpl->assign("modullist", $modullist);
    	$template = $UM->tpl->fetch($path);
    	return $template;
	}
	function getSGNameforID ($sg_id) {
		$sql = "SELECT sg_id, sg_name FROM `studiengang` WHERE sg_id='".$sg_id."'";
		$res = mysql_query($sql);
		return $this->buildResult($res, "sg_id");
	}
	
	function getSGTypForID ($sg_id) {
		$sql = "SELECT sg_id, sg_typ FROM `studiengang` WHERE sg_id='".$sg_id."'";
		$res = mysql_query($sql);
		return $this->buildResult($res, "sg_id");
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