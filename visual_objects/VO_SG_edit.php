<?php
class VO_SG_edit
{
	function VO_SG_edit($UM)
	{
		$this->UM = $UM;
	}
	function showResult($result, $extra_message)
	{
		$this->UM->tpl->assign("result", $result);
        $this->UM->tpl->assign("extra_msg", $extra_message);
        $this->UM->showfooter();
        $this->UM->showheader($this->UM->seite);
        $this->UM->tpl->display("SG_edit_Result.tpl", session_id());
	}
	function showSGList($result) 
	{
		// Setze Variablen fuer Footer und Header
		$this->UM->showfooter();
		$this->UM->showheader($this->UM->seite);

		// Setze Variable mit Daten in eine Template Variable um
		$this->UM->tpl->assign("SGList", $result);
		// Zeige das Template f��r diese Ausgabe an
		$this->UM->tpl->display("SG_edit_SGList.tpl", session_id());
	}

	function showCreateSGForm($dekanlist)
	{
		$this->UM->showfooter();
		$this->UM->showheader($this->UM->seite);
		$this->UM->tpl->assign("dekanlist", $dekanlist);
		$this->UM->tpl->display("SG_edit_CreateSGForm.tpl", session_id());
	}


	function showALLSGContent($sgdetail ,$dekans, $modullist)
	{
		$this->UM->showfooter();
		$this->UM->showheader($this->UM->seite);
		$this->UM->tpl->assign("sg", $sgdetail);
		$this->UM->tpl->assign("dekanlist", $dekans);
		$this->UM->tpl->assign("modullist", $modullist);
		$this->UM->tpl->display("SG_edit_ALLSGContent.tpl", session_id());
	}

}
?>