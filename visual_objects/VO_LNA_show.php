<?php
class VO_LNA_show
{	
	function VO_LNA_show($UM)
	{
		// instanzierte UniManager Klasse, klassenweit verfügbar machen
		$this->UM = $UM;
	}
	function showLNA($lna)
	{
		$this->UM->showfooter();
		$this->UM->showheader($this->UM->seite);
		$this->UM->tpl->assign("data", $lna);
		// Da dies das einzigste Template für LNA_show, entfaellt der anhang _LNA 
		$this->UM->tpl->display("LNA_show.tpl", session_id());
	}
}
?>