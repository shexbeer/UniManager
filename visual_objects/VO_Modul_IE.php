<?php
class VO_Modul_IE
{	
	function VO_Modul_IE($UM)
	{
		// instanzierte UniManager Klasse, klassenweit verfügbar machen
		$this->UM = $UM;
	}
	function showResult()
	{
	}
	function showModulList($mDetails)	// shex: fuer Fei, diese Fkt hab ich dir schonmal geschrieben inklusive der Template Datei, versuche was daraus zu lernen
	{
		// Setze Variablen für Footer und Header
		$this->UM->showfooter();
		$this->UM->showheader($this->UM->seite);
		
		// Setze Variable mit Daten in eine Template Variable um 
		$this->UM->tpl->assign("modDetails", $mDetails);
		// Zeige das Template für diese Ausgabe an
		$this->UM->tpl->display("Modul_IE_Modullist.tpl", session_id());
	}
	function showCreateModul() 
	{
	}

/*	Wahrscheinlich Fehlerhaft im Klassendiagramm
 *
 *	function showModulDetails() 
 *	{
 *	}
 */
}
?>