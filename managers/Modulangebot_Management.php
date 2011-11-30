<?php
/**
* viele der Funktionen sind nur Aufrufe von vorhandenen Funktionen aus dem Modul_Management
  somit dient die Klasse hauptsächlich der Bequemlichkeit der Benutzer
*/
require_once("Modul_Management.php");

class Modulaufstellung_Manegement{

	private $MM;
	
	function Modulaufstellung_Manegement(){
		$MM = new Modul_Management;
	}
	
	/**
	* Ruft Modulangebot zu einem SG für ein bestimmtes kalendarisches Semester ab
	* @param int $id Die id des Studiengangs
	* @param string $sem das kalendarische semester Syntax SS2011 oder WS2011
	* @return mixed array mit DB-Resultaten, ['result'] enthält false bei DB-Fehler, array[modulID][attribut] das atribut heißt gleich dem DB-namen unsortiert,false wenn Parameter falsch
	  attribut mauf_plansemester enthält das plan Semester bzgl. des Studiengangssomit kann in der ausgabe das entsprechend sotiert werden (z.B: was in dem Angebot für WS2011 bei BNC ist für BNC 1.Sem oder was BNC 3.Sem)
	*/
	function getModulangebot($id,$sem){
		return $MM->getModullist(true,"sg",$id,"total",$sem);
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
		return $this->buildResult($res);
	}
	
	private function buildResult($res){
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