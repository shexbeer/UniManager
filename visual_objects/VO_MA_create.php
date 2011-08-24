<?php
class VO_MA_create
{	
	function VO_MA_create($UM)
	{
		// instanzierte UniManager Klasse, klassenweit verfügbar machen
		$this->UM = $UM;
	}
	function showSGList($sg)
	{
		$this->UM->showfooter();
		$this->UM->showheader($this->UM->seite);
		$this->UM->tpl->assign("SG", $sg);
		$this->UM->tpl->display("MA_create_SGList.tpl", session_id());
	}
	function showMAedit($so,$modullist_sg,$modullist_all)        //hab mal die Parameter eingefuegt Sebastian
	{
		$this->UM->showfooter();
		$this->UM->showheader($this->UM->seite);
		$this->UM->tpl->display("MA_create_MAedit.tpl", session_id());
	}
	function showResult()
	{
		$this->UM->showfooter();
		$this->UM->showheader($this->UM->seite);
		$this->UM->tpl->display("MA_create_result.tpl", session_id());
	}
}
?>