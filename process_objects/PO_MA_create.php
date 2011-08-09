<?php
class PO_MA_create
{
	function PO_MA_create($UM)
	{
		// instanzierte UniManager Klasse, klassenweit verfügbar machen
		$this->UM = $UM;
	}
	function initForm()
	{
		$SG_M = new SG_Management();
		// Hole alle Studiengänge zum anzeigen
		$sg = $SG_M->getSGList();
		var_dump($sg);
		$this->UM->VisualObject->showSGList($sg);
	}
	function createMA()
	{
	}
	function setMA()
	{
	}
}
?>