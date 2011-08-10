<?php
class VO_LN_create
{	
	function VO_LN_create($UM)
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
		$this->UM->tpl->display("LN_create_Result.tpl", session_id());
	}
	function showALL_LN_ForALLModul($LN)
	{
		$this->UM->showfooter();
		$this->UM->showheader($this->UM->seite);
		$this->UM->tpl->assign("LN", $LN);
		$this->UM->tpl->display("LN_create_LNList.tpl", session_id());
	}
}
?>