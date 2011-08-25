<?php
class VO_SG_edit
{
function VO_SG_edit($UM)
{

$this->UM = $UM;
}
function showResult($error_occurred, $extra_message)
{
$this->UM->tpl->assign("error", $error_occurred);
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
// Zeige das Template f¶Ër diese Ausgabe an
$this->UM->tpl->display("SG_edit_SGList.tpl", session_id());
}

function showCreateSGForm($detail)
{
$this->UM->showfooter();
$this->UM->showheader($this->UM->seite);

$this->UM->tpl->assign("SGDetails", $detail);
$this->UM->tpl->display("SG_edit_CreateSGForm.tpl", session_id());
}


function showALLSGContent($sgdetail,$modullist,$list_all_moduls)
{
$this->UM->showfooter();
$this->UM->showheader($this->UM->seite);

$this->UM->tpl->assign("SGDetails", $detail);
$this->UM->tpl->display("SG_edit_ALLSGContent.tpl", session_id());
}

}
?>