<?php
/**
* viele der Funktionen sind nur Aufrufe von vorhandenen Funktionen aus dem Modul_Management
  somit dient die Klasse hauptsächlich der Bequemlichkeit der Benutzer
*/
require_once("Modul_Management.php");

class Modulangebot_Management{

	private $MM;
	
	function Modulangebot_Management(){
		$MM = new Modul_Management;
	}
	
	/**
	* Ruft Modulangebot zu einem SG für ein bestimmtes kalendarisches Semester ab
	* @param int $id Die id des Studiengangs
	* @param string $sem das kalendarische semester Syntax SS2011 oder WS2011
	* @return mixed array mit DB-Resultaten, ['result'] enthält false bei DB-Fehler, array[modulID][attribut] das atribut heißt gleich dem DB-namen unsortiert,false wenn Parameter falsch
	  attribut mauf_plansemester enthält das plan Semester bzgl. des Studiengangssomit kann in der ausgabe das entsprechend sotiert werden (z.B: was in dem Angebot für WS2011 bei BNC ist für BNC 1.Sem oder was BNC 3.Sem)
	*/
	function getModulangebot($id,$sem)
	{
		#TODO: NEED CHANGE
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
	
	function getModulangebotForSem($sem)
	{
	}
	
	/*
		Die Basis des Modulangebots sind Veranstaltungen bzw events.
		Diese setzen sich wie folgt zusammen und wird wie ein eigener Typ behandelt
		Die get Funktionen sollten Die Informationen in genau der Form zurück geben
		$arr['semester'] das kalendarische Semester (zB WS2001)
		$arr['time'] die Uhrzeit der Veranstaltung (sql_TIME)
		$arr['weekday'] der Wochentag (enum zB 'Dienstag')
		$arr['week'] die Woche als int(jede oder gerade oder ungerade)
		$arr['modul'] die modul id als int
		$arr['lb'] die Lehrbeauftragter id als int
	*/
	
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
			if( is_numeric($event['week']) )
			{
				$event['week']=intval($event['week']);
			}
			else 
				return false;
			if( !(	$event['week']==0 ||
					$event['week']==1 ||
					$event['week']==2 ) )
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
				return 88; //Event ist falsch
			if( !$diffsem )
			{
				if($sem==NULL)
					$sem=$event['semester'];
				if( $sem!=$event['semester'] )
					return false; //Semster sind unterschiedlich aber flag nicht gestezt
			}
		}
		
		// Überprüfen ob einige Events schon vorhanden sind vorhandene ignorieren
		foreach( $offer as $index => $event )
		{
			$arr=array();
			foreach( $event as $key => $value )
			{
				$arr[]="`ma_".$key."`='".$value."'";
			}
			$sql = "SELECT `ma_count` FROM `modulangebot` WHERE ".join($arr," AND ").";";
			$res = mysql_query($sql);
			if( mysql_fetch_row($res) )
				unset($offer[$index]);
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
}

?>