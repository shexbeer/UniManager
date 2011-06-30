<?php
class PO_LN_create
{
	// Properties
	//	public $test;
	function PO_LN_create($UM)
	{
		// instanzierte UniManager Klasse, klassenweit verfügbar machen
		$this->UM = $UM;
	}
	function initForm()
	{
		$ModulM = new Modul_Management();
		//$LNM = new LN_Management();
		
		// holt alle Module und die Namen dazu
		$modulliste = $ModulM->getModullist();
		// holt alle LN
		//$LNliste = $LNM->getLNList();
		
		// Testvariablen da Manager noch nicht vorhanden
		$LNListe[0]['modul_id'] = 1;		// gehört zu Modul ID
		$LNListe[0]['ln_id'] = 1;
		$LNListe[0]['ln_datum'] = "14.12.2017";
		$LNListe[0]['ln_vorraussetzung'] = NULL;
		$LNListe[0]['ln_raum'] = "KKB-2012";
		$LNListe[0]['ln_pruefer'] = "Prof. Jasper";
		$LNListe[1]['modul_id'] = 2;		// gehört zu Modul ID
		$LNListe[1]['ln_id'] = 2;
		$LNListe[1]['ln_datum'] = "28.12.2017";
		$LNListe[1]['ln_vorraussetzung'] = "HM2";
		$LNListe[1]['ln_raum'] = "RAM-2181";
		$LNListe[1]['ln_pruefer'] = "Prof. Ludwig";
		
		// füge die Infos sinnvoll zusammen
		// FIXME: Speed!
		for($i = 0; $i < count($LNListe); $i++) {
			$LN[$i]['ln_datum'] = $LNListe[$i]['ln_datum'];
			$LN[$i]['ln_pruefer'] = $LNListe[$i]['ln_pruefer'];
			$LN[$i]['ln_raum'] = $LNListe[$i]['ln_raum'];
			$LN[$i]['ln_vorraussetzungen'] = $LNListe[$i]['ln_vorraussetzung'];
			$LN[$i]['modul_name'] = $modulliste[$LNListe[$i]['modul_id']]['name'];
			$LN[$i]['ln_id'] = $LNListe[$i]['ln_id'];
		}
		$this->UM->tpl->assign("LN", $LN);
		$this->UM->VisualObject->showALL_LN_ForALLModul();
	}
	// 1. Argument: Leistungsnachweis ID für die der User angemeldet werden soll
	function createLNA($LN_id)
	{
		// do some things
	}
	function testClass()
	{
		$this->UM->VisualObject->testClass();
	}
}
?>