<?php
/**
* viele der Funktionen sind nur Aufrufe von vorhandenen Funktionen aus dem Modul_Management
  somit dient die Klasse hauptsächlich der Bequemlichkeit der Benutzer
*/
require_once("Modul_Management.php");

class Modulangebot_Management{
	
	function Modulangebot_Management(){
		$this->MM = new Modul_Management;
	}
	
	/**
	* Ruft Modulangebot zu einem SG für ein bestimmtes kalendarisches Semester ab
	* @param int $id Die id des Studiengangs
	* @param string $sem das kalendarische semester Syntax SS2011 oder WS2011
	* @return mixed array mit DB-Resultaten false falls etwas schiefgelaufen ist, sonst:
			$result['result'] bool ob erfolgreich oder nicht
			$result[count]['status'] der Status jedes Eintrags
			$result[count]['sg'] die Studiengang-ID nochmal gespeichert
			$result[count]['event'] Die restdaten in Eventform für mögliche set-Aktionen (für Struktur siehe weiter unten)
	*/
	function getModulangebot($id,$sem, $sg_typ)
	{
		//$sql = "SELECT * FROM `modulangebot` WHERE `ma_semester`='".$sem."' AND `ma_sg`='".$id."';";
		$sql = "SELECT modul_id, modul_name, mauf_plansemester, ma_status, ma.ma_modul, modul_frequency
				FROM `modulangebot` AS ma 
				INNER JOIN `modul` AS m ON m.modul_id = ma.ma_modul 
				INNER JOIN `modulaufstellung`AS mauf ON mauf.mauf_modul_id = ma.ma_modul
				WHERE ma.`ma_semester`='".$sem."' 
				AND ma.`ma_sg`='".$id."' 
				AND mauf.mauf_typ = '".$sg_typ."'
				ORDER BY mauf_plansemester;";
		$res = mysql_query($sql);
		return $this->buildResult($res, "ma_modul");
	}
	
	/**
	* Ruft Modulangebot für ein komplettes bestimmtes kalendarisches Semester ab
	* @param int $id Die id des Studiengangs
	* @param string $sem das kalendarische semester Syntax SS2011 oder WS2011
	* @return mixed array mit DB-Resultaten false falls etwas schiefgelaufen ist, sonst:
			$result['result'] bool ob erfolgreich oder nicht
			$result[count]['status'] der Status jedes Eintrags
			$result[count]['sg'] die Studiengang-ID nochmal gespeichert
			$result[count]['event'] Die restdaten in Eventform für mögliche set-Aktionen (für Struktur siehe weiter unten)
	*/
	function getModulangebotForSem($sem)
	{
		$sql = "SELECT * FROM `modulangebot` WHERE `ma_semester`='".$sem."';";
		$res = mysql_query($sql);
		return $this->buildResultEvent($res);
	}
	
	/**
	* Helper zum Umbauen der DB-resourcen damit ein gültiger Eventeintrag entsteht
	*/
	function buildResultEvent($res)
	{
		if(!$res)$rows['result']=false;//Fehlererkennung
		else{
			$rows['result']=true;
			$rnum = mysql_num_rows($res);# 0 wenn kein Treffer gefunden wurde
			for($i=0;$i<$rnum;$i++)
			{
				$newevent['semester']=mysql_result($res,$i,'ma_semester');
				$newevent['time']=mysql_result($res,$i,'ma_time');
				$newevent['weekday']=mysql_result($res,$i,'ma_weekday');
				$newevent['week']=mysql_result($res,$i,'ma_week');
				$newevent['modul']=mysql_result($res,$i,'ma_modul');
				$newevent['lb']=mysql_result($res,$i,'ma_lb');
				$newevent['id']=mysql_result($res,$i, 'ma_id');
				$newevent['count']=mysql_result($res,$i, 'ma_count');
				$index = mysql_result($res,$i,'ma_count');
				$rows[$index]['status']=mysql_result($res,$i,'ma_status');
				$rows[$index]['sg']=mysql_result($res,$i,'ma_sg');
				$rows[$index]['event']=$newevent;
			}
		}
		return $rows;
	}
	
	/**
	* Ruft den status für ein Modulangebot bzgl. Jahr und Studiengang
	* @param string $sem kalendarisches Semester
	* @param int $id ID des SG
	* @return array mit Zuständen pro SG und Hinweis falls Unterschiede vorhanden [count][[ma_status]/[ma_sg]]
	  ['result']enthält false bei DB-Fehler
	  ['diff']enthält true wenn Zustandsunterschiede vorhanden
	*/
	function getStatus($sem,$id=false){
		$where=NULL;
		if(!$id)$where="";
		else $where=" AND ma_sg='".$id."'";
		$sql = "SELECT ma_status,ma_sg FROM modulangebot WHERE ma_semester='".$sem."'".$where;
		$res = mysql_query($sql);
		return $this->buildResultforStatus($res);
	}
	
	
	/*
		Die Basis des Modulangebots sind Veranstaltungen bzw events.
		Diese setzen sich wie folgt zusammen und wird wie ein eigener Typ behandelt
		Die get Funktionen sollten Die Informationen in genau der Form zurück geben
		$arr['semester'] das kalendarische Semester (zB WS2001)
		$arr['time'] die Uhrzeit der Veranstaltung (sql_TIME 'hh:mm:ss')
		$arr['weekday'] der Wochentag (enum zB 'Dienstag')
		$arr['week'] die Woche als int(jede oder gerade oder ungerade)
		$arr['modul'] die modul id als int
		$arr['lb'] die Lehrbeauftragter id als int
	*/
	
	/**
	* Setzt den Status für das komplette Modulangebot eines Semesters oder nur für einen SG in einem Semester
	* @param string $status der Status auf den gestezt werden soll
	* @param string $sem das betroffene kalendarische Semester
	* @param int $id falls nicht false die id des SG für den der Status gestzt werden soll 
	* @return bool ob erfolgreich oder nicht
	*/
	function setModulangebotStatus($status, $sem, $id=false)
	{
		$where = "WHERE `ma_semester`='".$sem."'";
		if( !$id )
			$where = $where.";";
		else
			$where = $where." AND `ma_sg`='".$id."';";
		$sql = "UPDATE `modulangebot` SET `ma_status`='".$status."' ".$where;
		if( !mysql_query($sql) )
			return false; // Fehlschlag
		return true;
	}
	
	/**
	* überprüft ein Event auf gültigen Aufbau
	  sollte nach möglichkeit auch außerhalb verwendet werden um Fehler gleich zu vermeiden
	* @param $event das zu überprüfende Event
	* @return bool true ist richtig und Vollständig
	*/
	function checkEvent($event)
	{
		if( count($event)!=6 )
			return false;
		if( isset($event['semester']) )
		{
			$sem=str_split($event['semester'],2);
			if( !($sem[0]=='SS'||$sem[0]=='WS') )
				return false;
			if( !is_numeric($sem[1].$sem[2]) )
				return false;
		}
		else
			return false;
			
		if( isset($event['time']) )
		{
			$time=preg_split("!:!",$event['time']);
			if( count($time)>3 || count($time)<2 )
				return false;
			foreach( $time as $value )
			{
				if( !is_numeric($value))
					return false;
			}
		}
		else
			return false;
		
		if( isset($event['weekday']) )
		{
			if( !(	$event['weekday']=='Montag' ||
					$event['weekday']=='Dienstag' ||
					$event['weekday']=='Mittwoch' ||
					$event['weekday']=='Donnerstag' ||
					$event['weekday']=='Freitag' ||
					$event['weekday']=='Samstag' ||
					$event['weekday']=='Sonntag' ) )
				return false;
		}
		else
			return false;
			
		if( isset($event['week']) )
		{
			if( !(	$event['week']=="jede" ||
					$event['week']=="ungerade" ||
					$event['week']=="gerade" ) )
				return false;
		}
		else
			return false;
			
		if( isset($event['modul']) )
		{
			if( is_numeric($event['modul']) )
			{
				$event['modul']=intval($event['modul']);
			}
			else 
				return false;
		}
		else
			return false;	
			
		if( isset($event['lb']) )
		{
			if( is_numeric($event['lb']) )
			{
				$event['lb']=intval($event['lb']);
			}
			else 
				return false;
		}
		else
			return false;	
		return true;
	}
	/**
	* Setzt ein Array von Eventarrays als Angbeot für den Entsprechenden Studiengang
	  das Sem sollte in allen Events gleich sein (alles andere würde nicht viel Sinn machen)
	  !!!ACHTUNG Erstellt nur neue Einträge mit status "erstellt"
	* @param int $id Id des SG
	* @param mixed $offer ein 2dim array welches mehrere Events hinzufügt array[index]=Event[]
	* @param bool $diffsem für den Fall das einige Events doch in unterschiedlichen kal. Sem. gestzt werden sollen (auch wenn ich das unsinnig finde)
	* @return
	*/
	function setModulangebotPerSG( $id, $offer, $diffsem=false )
	{	
		$sem=NULL;
		// Eingaben werden zuerst überprüft
		foreach( $offer as $event )
		{
			if( !$this->checkEvent($event) )
				return false; //Event ist falsch
			if( !$diffsem )
			{
				if($sem==NULL)
					$sem=$event['semester'];
				if( $sem!=$event['semester'] )
					return false; //Semster sind unterschiedlich aber flag nicht gestezt
			}
		}
		// ALT: Überprüfen ob einige Events schon vorhanden sind vorhandene ignorieren
		// NEU: (by shex) Alte Events werden komplett rausgeworfen wenn eine neue gesetzt wird
		foreach( $offer as $index => $event )
		{
			$arr=array();
			foreach( $event as $key => $value )
			{
				$arr[]="`ma_".$key."`='".$value."'";
			}
			//$sql = "SELECT `ma_count` FROM `modulangebot` WHERE ".join($arr," AND ")." AND `ma_sg`='".$id."';";
			$sql = "DELETE FROM `modulangebot` WHERE `ma_semester`='".$event["semester"]."' AND `ma_sg`='".$id."';";
			$res = mysql_query($sql);
			//if( mysql_fetch_row($res) )
			//	unset($offer[$index]);
		}
		
		// Erstellen der Zeilen
		$count=array();
		foreach( $offer as $event )
		{
			$arrC=array();
			$arrV=array();
			foreach( $event as $key => $value )
			{
				$arrC[]="`ma_".$key."`";
				$arrV[]="'".$value."'";
			}
			$arrC[]="`ma_sg`";
			$arrC[]="`ma_status`";
			$arrV[]="'".$id."'";
			$arrV[]="'erstellt'";
			$sql = "INSERT INTO  `UniManager`.`modulangebot` (".join($arrC,", ").") VALUES (".join($arrV,", ").");";
			if( !mysql_query($sql) ) //Backroll wegen Fehler
			{
				foreach($count as $entry)
				{
					$sql ="DELETE FROM `modulangebot` WHERE `ma_count`='".$entry."';";
					if( !mysql_query($sql) ) return false; //worst case failure
				}
				return false; //Fehler beim Setzen einer Zeile
			}
			else
			{	
				$sql = "SELECT LAST_INSERT_ID();";
				$res = mysql_query($sql);
				$row = mysql_fetch_row($res);
				$count[] = $row[0];
			}
		}
		return true;
	}
	
	/**
	* Setzt ein Event mit einem array SG-IDs. Wenn Event schon vorhanen, dann werden zusätzliche SGs hinzugefügt.
	  Ansonsten werden einträge mit einem neuen Event erstellt
	* @param int $id Id des SG
	* @param array $sgs Array mit den SG-ID's
	* @param bool $diffsem für den Fall das einige Events doch in unterschiedlichen kal. Sem. gestzt werden sollen (auch wenn ich das unsinnig finde)
	* @return
	*/
	function addSGtoEvent( $event, $sgs)
	{
		// Check event
		if( !$this->checkEvent($event) )
			return false;
		
		// Überprüfen ob einige Sg dem Event schon zugeordnet sind
		$arr=array();
		foreach( $event as $key => $value )
		{
			$arr[]="`ma_".$key."`='".$value."'";
		}
		foreach( $sgs as $index => $id )
		{
			$sql = "SELECT `ma_count` FROM `modulangebot` WHERE ".join($arr," AND ")." AND `ma_sg`='".$id."';";
			$res = mysql_query($sql);
			if( mysql_fetch_row($res) )
				unset($sgs[$index]);
		}
		
		// Erstellen der Zeilen
		$count=array();
		$arr=array();
		foreach( $event as $key => $value )
		{
			$arrC[]="`ma_".$key."`";
			$arrV[]="'".$value."'";
		}
		foreach( $sgs as $id )
		{
			$sql = "INSERT INTO  `UniManager`.`modulangebot` (".join($arrC,", ").", `ma_sg`, `ma_status`) VALUES (".join($arrV,", ").", '".$id."', 'erstellt');";
			if( !mysql_query($sql) ) //Backroll wegen Fehler
			{
				foreach($count as $entry)
				{
					$sql ="DELETE FROM `modulangebot` WHERE `ma_count`='".$entry."';";
					if( !mysql_query($sql) ) return false; //worst case failure
				}
				return false; //Fehler beim Setzen einer Zeile
			}
			else
			{	
				$sql = "SELECT LAST_INSERT_ID();";
				$res = mysql_query($sql);
				$row = mysql_fetch_row($res);
				$count[] = $row[0];
			}
		}
		return true;
	}
	
	function removeSGfromEvent($sgid, $event)
	{
		// Check event
		if( !$this->checkEvent($event) )
			return false; // Event ungültig
		$arr=array();
		foreach( $event as $key => $value )
		{
			$arr[]="`ma_".$key."`='".$value."'";
		}
		$sql = "DELETE FROM `modulangebot` WHERE ".join($arr," AND ")." AND `ma_sg`='".$sgid."'";
		if( !mysql_query($sql) )
			return false; // Löschen gescheitert
		return true;
	}
	function removeMA($sgid, $semester) 
	{
		$sql="DELETE FROM `modulangebot` WHERE `ma_sg`='".$sgid."' AND `ma_semester`='".$semester.";";
		if( mysql_query($sql) )
			return true;
		else
			return false;
	}
	
	/**
	* Funtion zum ersetzen der Daten eines alten durch ein neues Event (zB um Uhrzeit oder Tag zu ändern)
	* @param $oldevent
	* @param $newevent
	* @return bool ob erfolgreich oder nicht
	*/
	function updateEvent( $oldevent, $newevent)
	{
		if( !$this->checkEvent($newevent) )
			return false; // neues Event ungültig	
		if( !$this->checkEvent($oldevent) )
			return false; // altes Event ungültig (wenn Prozess Modell logisch korrekt dann sollte das nie false werden)
		
		$oldarr=array();
		$newarr=array();
		foreach( $oldevent as $key => $value )
		{
			$oldarr[]="`ma_".$key."`='".$value."'";
		}
		foreach( $newevent as $key => $value )
		{
			$newarr[]="`ma_".$key."`='".$value."'";
		}
		
		$sql = "UPDATE `modulangebot` SET ".join($newarr,", ")." WHERE ".join($oldarr," AND ").";";
		if( !mysql_query($sql) )
			return false; // Update fehlgeschlagen
		return true;
	}
	
	/* Funktion checkt ob es ein Modulangebot fŸr ein bestimmtes Semester eines bestimmten Studiengangs gibt
	* @param $sg_id	Studiengang
	* @param $semester, Plansemester ('WS2012')
	* @return bool ob es einen gibt, oder nicht
	*/
	function checkModulangebotForSG($sg_id, $semester)
	{
		$sql = "SELECT ma_count,ma_sg FROM `modulangebot`WHERE `ma_sg` = '".$sg_id."' AND `ma_semester` = '".$semester."';";
		$res = mysql_query($sql);
		if(mysql_num_rows($res) == 0) {
			return false;
		} else {
			return mysql_result($res, 0, "ma_count");
		}
	}
	function getLehrbeauftragterForMA($ma_count) {
		$sql = "SELECT ma.ma_count, p.person_vorname, p.person_name, p.person_id, ma.ma_lb FROM `modulangebot` AS ma 
				INNER JOIN `lehrbeauftragter`AS lb ON ma.ma_lb = lb.lehrbeauftr_id 
				INNER JOIN `person` AS p ON lb.lehrbeauftr_personenid=p.person_id 
				WHERE ma.ma_count=".$ma_count.";";
		$res = mysql_query($sql);
		return $this->buildResult($res, "ma_count");
	}
	
	function getBedarf($sg_id, $semester) {
		 //Modulliste zum Studiengang holen und ueberpruefen
		$modullist_unchecked=$this->MM->getModullist(true,"sg",$sg_id);
		$modullist=$this->checkManagerResults($modullist_unchecked,"modul_id","Modulliste");
		$oddOrEven = $this->checkIfOddOrEvenSemester($semester);
        foreach($modullist as $key => $var) 
        {
        	if($oddOrEven == "odd") 
        	{
				if(($var["mauf_plansemester"] % 2) == 0) //odd
				{
					$result[$key] = $var;
				}
			} else {
				if(($var["mauf_plansemester"] % 2) == 1) //even
				{
					$result[$key] = $var;
				}
			}
        }
        
		return $result;
	}
	
	//HELPER
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
			if($rnum == 0) {
				$rows['result']=false;
			}
			else {
				$fnum=mysql_num_fields($res);
				for($i=0;$i<$rnum;$i++){
					$key = mysql_result($res,$i,$keyvalue);
					for($j=0;$j<$fnum;$j++)$rows[$key][mysql_field_name($res,$j)]=mysql_result($res,$i,$j);
				}
			}
		}
		return $rows;
	}
	private function checkIfOddOrEvenSemester($sem) { // WS => 1.,3.,5.,7... SS=>2.,4.,6.,8...
		if(strncmp($sem, "WS", 2) == 0) // String ist WSXXXX String
			return "odd";
		else
			return "even";
	}
	
	private function buildResultforStatus($res)
	{
		$mod_id=NULL;
		$count=0;
		$rows['diff']=false;
		if(!$res)$rows['result']=false;//Fehlererkennung
		else{
			$rows['result']=true;
			$rnum=mysql_num_rows($res);# 0 wenn kein Treffer gefunden wurde
			$fnum=mysql_num_fields($res);
			for($i=0;$i<$rnum;$i++){
				if($mod_id != mysql_result($res,$i,"ma_sg")){
					$mod_id = mysql_result($res,$i,"ma_sg");
					for($j=0;$j<$fnum;$j++) $rows[$count][mysql_field_name($res,$j)]=mysql_result($res,$i,$j);
					if($count>0)
						if($rows[$count]['ma_status']!=$rows[$count-1]['ma_status'])$rows['diff']=true;
					$count++;
				}
			}
		}
		return $rows;
	}
	private function checkManagerResults($results, $index_description_in_results, $error_description = '')
	{
		//var_dump($results);
		foreach($results as $var) {
			// Wenn Ergebniss kein Array, dann ist es die Result Meldung des Managers
			if(!is_array($var)) {
				if(!$var) {
					// Ein Fehler ist aufgetreten
					if($error_description == '') {
						$extra_error = '';
					} else {
						$extra_error = 'Fehler ist Aufgetreten bei der Abfrage der '.$error_description;
					}
					$this->trigger_error(3, $extra_error , true, true);
				}
			} else {// Wenn $var Array ist, dann ist es teil des results
				// wenn ein event im Result muss es anders aufgebaut sein
				if(!is_array($var["event"])) {
					
					$results_edited[$var[$index_description_in_results]] = $var;
				} else { 
					$results_edited[$var["event"][$index_description_in_results]] = $var;
				}
			}
		}
		return $results_edited;
	}
}

?>