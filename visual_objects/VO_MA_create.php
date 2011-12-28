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
		$this->UM->tpl->assign("sglist", $sg);
		$this->UM->tpl->assign("current_semester", $this->UM->getCurrentSemester());
		$this->UM->tpl->assign("next_semester", $this->UM->getNextSemester());
		$this->UM->tpl->display("MA_create_SGList.tpl", session_id());
	}
	function showMAedit($sg_id,$modullist,$po,$modulhb,$mark_semester)
	{
		$curr = $this->UM->getCurrentSemester();
		$next = $this->UM->getNextSemester();
		$this->UM->showfooter();
		$this->UM->showheader($this->UM->seite);
		$this->UM->tpl->assign("modullist", $modullist);
		$this->UM->tpl->assign("po", $po);
		$this->UM->tpl->assign("modulhb", $modulhb);
		$this->UM->tpl->assign("current_semester", $curr);
		$this->UM->tpl->assign("next_semester", $next);
		$this->UM->tpl->assign("mark_semester", $mark_semester);
		$this->UM->tpl->assign("sg_id", $sg_id);
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