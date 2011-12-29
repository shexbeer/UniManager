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
	function showMAedit($sg_id,$lehrbeauftragte,$modullist,$po,$modulhb,$mark_semester, $MAs)
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
		$this->UM->tpl->assign("lehrbeauflist", $lehrbeauftragte);
		$this->UM->tpl->assign("sg_id", $sg_id);
		// array of bool.. [0] -> current Semester
		// [1] -> next Semester (true = MA exists)
		$this->UM->tpl->assign("mas", $MAs); 
		$this->UM->tpl->display("MA_create_MAedit.tpl", session_id());
	}
	function showResult($result, $message)
	{
		$this->UM->showfooter();
		$this->UM->showheader($this->UM->seite);
		$this->UM->tpl->assign("result", $result);
		$this->UM->tpl->assign("extra_msg", $message);
		$this->UM->tpl->display("MA_create_result.tpl", session_id());
	}
}
?>