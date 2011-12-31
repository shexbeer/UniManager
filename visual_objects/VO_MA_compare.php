<?php
class VO_MA_compare
{
	function VO_MA_compare($UM)
	{
		$this->UM = $UM;
	}
	function showResult($error_occurred, $extra_message)
	{
			$this->UM->tpl->assign("error", $error_occurred);
            $this->UM->tpl->assign("extra_msg", $extra_message);
            $this->UM->showfooter();
            $this->UM->showheader($this->UM->seite);
            $this->UM->tpl->display("MA_compare_Result.tpl", session_id());
	}
	function showSGList($sglist) 
	{
		$this->UM->showfooter();
		$this->UM->showheader($this->UM->seite);
		// Setze Variable mit Daten in eine Template Variable um 
		$this->UM->tpl->assign("sglist", $sglist);
		$this->UM->tpl->assign("currentSemester", $this->UM->getcurrentSemester());
		$this->UM->tpl->assign("nextSemester", $this->UM->getnextSemester());
		// Zeige das Template fuer diese Ausgabe an
		$this->UM->tpl->display("MA_compare_SGlist.tpl", session_id());
	}

	function showCompareList($sg, $semester, $modulangebot, $bedarf, $compareList)
	{
		$this->UM->showfooter();
		$this->UM->showheader($this->UM->seite);
		$this->UM->tpl->assign("sg", $sg);
		$this->UM->tpl->assign("modulangebot", $modulangebot);
		$this->UM->tpl->assign("bedarf", $bedarf);
		$this->UM->tpl->assign("forSemester", $semester);
		$this->UM->tpl->assign("compareList", $compareList);

		$this->UM->tpl->display("MA_compare_compareList.tpl", session_id());
	}

	function showWholeCompare()
	{
		$this->UM->showfooter();
		$this->UM->showheader($this->UM->seite);
		//$this->UM->tpl->assign("LNAList", $result);
		$this->UM->tpl->display("MA_compare_wholeCompare.tpl", session_id());
	}
}
?>