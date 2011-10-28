<?php
class VO_LN_edit
{
	function VO_LN_edit($UM)
	{
		$this->UM = $UM;
	}
	function showResult($error_occurred, $extra_message)
	{
			$this->UM->tpl->assign("error", $error_occurred);
            $this->UM->tpl->assign("extra_msg", $extra_message);
            $this->UM->showfooter();
            $this->UM->showheader($this->UM->seite);
            $this->UM->tpl->display("LN_Edit_Result.tpl", session_id());
	}
	function showModulList($result) 
	{
		$this->UM->showfooter();
		$this->UM->showheader($this->UM->seite);
		// Setze Variable mit Daten in eine Template Variable um 
		$this->UM->tpl->assign("modList", $result);
		// Zeige das Template fuer diese Ausgabe an
		$this->UM->tpl->display("LN_edit_Modullist.tpl", session_id());
	}

	function showLNAList($result)
	{
		$this->UM->showfooter();
		$this->UM->showheader($this->UM->seite);
		$this->UM->tpl->assign("LNAList", $result);
		$this->UM->tpl->display("LN_edit_LNAList.tpl", session_id());
	}



//function showCreateModul()

/* Wahrscheinlich Fehlerhaft im Klassendiagramm -> stimmt, habs auch in keinem Sequenzdiagramm gefunden; Sebastian
*
* function showModulDetails()
* {
* }
*/
}
?>