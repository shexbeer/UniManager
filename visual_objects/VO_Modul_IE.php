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
		$this->UM->tpl->assign("error", $error_occurred);
                $this->UM->tpl->assign("extra_msg", $extra_message);
                $this->UM->showfooter();
                $this->UM->showheader($this->UM->seite);
                $this->UM->tpl->display("Modul_IE_Result.tpl", session_id());
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
	 function showModulDetails($mDetails) 
	{
		$this->UM->showfooter();
		$this->UM->showheader($this->UM->seite);
		
		$this->UM->tpl->assign("modDetails", $mDetails);
		$this->UM->tpl->display("Modul_IE_ModulDetails.tpl", session_id());
	}
//function showCreateModul()

/*	Wahrscheinlich Fehlerhaft im Klassendiagramm  -> stimmt, habs auch in keinem Sequenzdiagramm gefunden; Sebastian
 *
 *	function showModulDetails() 
 *	{
 *	}
 */
}
?>