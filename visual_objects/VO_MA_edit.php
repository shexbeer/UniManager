<?php
class VO_MA_edit
{	
	function VO_MA_edit($UM)
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
		$this->UM->tpl->display("MA_edit_SGList.tpl", session_id());
	}
	function showModulaufstellung($sg_id,$sgname,$sg_typ,$lehrbeauftragte,$lb_ma,$compareList,$modullist,$modulangebot,$po,$modulhb,$semester,$ma_status)
	{
		$curr = $this->UM->getCurrentSemester();
		$next = $this->UM->getNextSemester();
		$this->UM->showfooter();
		$this->UM->showheader($this->UM->seite);
		$this->UM->tpl->assign("modullist", $modullist);
		$this->UM->tpl->assign("modulangebot", $modulangebot);
		$this->UM->tpl->assign("compareList", $compareList);
		
		$this->UM->tpl->assign("po", $po);
		$this->UM->tpl->assign("modulhb", $modulhb);
		$this->UM->tpl->assign("current_semester", $curr);
		$this->UM->tpl->assign("next_semester", $next);
		$this->UM->tpl->assign("forSemester", $semester);
		$this->UM->tpl->assign("lehrbeauflist", $lehrbeauftragte);
		$this->UM->tpl->assign("sg_id", $sg_id);
		$this->UM->tpl->assign("sg_typ", $sg_typ);
		$this->UM->tpl->assign("lbForMA", $lb_ma);
		$this->UM->tpl->assign("sg_name", $sgname);
		$this->UM->tpl->assign("ma_status", utf8_encode($ma_status));
		
		$this->UM->tpl->display("MA_edit_Modulaufstellung.tpl", session_id());
	}
	function showResult($result, $message)
	{
		$this->UM->showfooter();
		$this->UM->showheader($this->UM->seite);
		$this->UM->tpl->assign("result", $result);
		$this->UM->tpl->assign("extra_msg", $message);
		$this->UM->tpl->display("MA_edit_result.tpl", session_id());
	}
}
?>