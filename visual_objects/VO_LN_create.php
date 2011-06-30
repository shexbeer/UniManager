<?php
class VO_LN_create
{
	// Properties
	//	public $test = 'test';
		
	function VO_LN_create($UM)
	{
		// instanzierte UniManager Klasse, klassenweit verfügbar machen
		$this->UM = $UM;
	}
	function showResult()
	{
	}
	function showALL_LN_ForALLModul()
	{
		$this->UM->showfooter();
		$this->UM->showheader($this->UM->seite);
		$this->UM->tpl->display("LN_create_showLNList.tpl", session_id());
	}
	// Argumente sind die per POST übergebenen Variablen des Formulares
	function submit($POST_VARS) {
		
	}
	function testClass()
	{
		echo "do some dump things<br>";
	}
}
?>