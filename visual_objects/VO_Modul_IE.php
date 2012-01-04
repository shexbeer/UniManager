<?php
class VO_Modul_IE
{	
	function VO_Modul_IE($UM)
	{
		// instanzierte UniManager Klasse, klassenweit verfügbar machen
		$this->UM = $UM;
	}
	function showResult($result, $extra_message)
	{
		$this->UM->tpl->assign("result", $result);
		$this->UM->tpl->assign("extra_msg", $extra_message);
		$this->UM->showfooter();
		$this->UM->showheader($this->UM->seite);
		$this->UM->tpl->display("Modul_IE_Result.tpl", session_id());
    }
    function showaddResult($result, $extra_message)
    {
        $this->UM->tpl->assign("result", $result);
        $this->UM->tpl->assign("extra_msg", $extra_message);
        $this->UM->showfooter();
        $this->UM->showheader($this->UM->seite);
        $this->UM->tpl->display("Modul_IE_addResult.tpl", session_id());
    }
	function showCreateModul($list,$error=false)
    {
        //var_dump($error);
        $this->UM->tpl->assign("list",$list);
        if (isset($error)){
            $this->UM->tpl->assign("error",$error);
        }
        $this->UM->showfooter();
        $this->UM->showheader($this->UM->seite);
        $this->UM->tpl->display("Modul_IE_ShowCreateModul.tpl", session_id());
    }
    function showModulList($mDetails,$a_list)	
	{
		// Setze Variablen für Footer und Header
		$this->UM->showfooter();
		$this->UM->showheader($this->UM->seite);
		// Setze Variable mit Daten in eine Template Variable um
        $this->UM->tpl->assign("a_list", $a_list);
		$this->UM->tpl->assign("modDetails", $mDetails);
		// Zeige das Template für diese Ausgabe an
		$this->UM->tpl->display("Modul_IE_Modullist.tpl", session_id());
	}
	 function showModulDetails($mDetails,$lehrendelist) 
	{
		$this->UM->showfooter();
		$this->UM->showheader($this->UM->seite);
		$this->UM->tpl->assign("mod", $mDetails);
        $this->UM->tpl->assign("lehrendelist", $lehrendelist);
		$this->UM->tpl->display("Modul_IE_ModulDetails.tpl", session_id());
	}
    function showChangeDetails($chDetails,$lehrendelist)
    {
        $this->UM->showfooter();
        $this->UM->showheader($this->UM->seite);
        //var_dump($chDetails,$lehrendelist);
        $this->UM->tpl->assign("list",$chDetails);
        $this->UM->tpl->assign("lehrendelist",$lehrendelist);
        $this->UM->tpl->display("Modul_IE_ChangeDetails.tpl", session_id());
    }
}
?>