<?php
class VO_LN_create
{	
	function VO_LN_create($UM)
	{
		// instanzierte UniManager Klasse, klassenweit verfügbar machen
		$this->UM = $UM;
	}
	function showResult()
	{
	}
	function showALL_LN_ForALLModul($LN)
	{
		$this->UM->showfooter();
		$this->UM->showheader($this->UM->seite);
		$this->UM->tpl->assign("LN", $LN);
		$this->UM->tpl->display("LN_create_showLNList.tpl", session_id());
	}
	// Argumente sind die per POST übergebenen Variablen des Formulares
	function submit($POST_VARS) {
		
	}
}
?>