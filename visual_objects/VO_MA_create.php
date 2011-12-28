<?php
class VO_MA_create
{	
	function VO_MA_create($UM)
	{
		// instanzierte UniManager Klasse, klassenweit verfügbar machen
		$this->UM = $UM;
	}
	function showSGList($sg, $semester)
	{
		$this->UM->showfooter();
		$this->UM->showheader($this->UM->seite);
		$this->UM->tpl->assign("sglist", $sg);
		$this->UM->tpl->assign("semester", $semester);
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