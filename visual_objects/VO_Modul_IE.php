<?php
class VO_Modul_IE
{	
	function VO_Modul_IE($UM)
	{
		// instanzierte UniManager Klasse, klassenweit verfügbar machen
		$this->UM = $UM;
	}
	function showResult($error_occurred, $extra_message)
	{
		$this->UM->tpl->assign("error", $error_occurred);
                $this->UM->tpl->assign("extra_msg", $extra_message);
                $this->UM->showfooter();
                $this->UM->showheader($this->UM->seite);
                $this->UM->tpl->display("Modul_IE_Result.tpl", session_id());
	}
	function showModulList($mDetails)	
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
		$this->UM->tpl->assign("mod", $mDetails);
		$this->UM->tpl->display("Modul_IE_ModulDetails.tpl", session_id());
	}

}
?>