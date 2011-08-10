<?php
class PO_LN_create
{
	function PO_LN_create($UM)
	{
		// instanzierte UniManager Klasse, klassenweit verfügbar machen
		$this->UM = $UM;
	}
	function initForm()
	{
		$ModulM = new Modul_Management();
		$LNM = new LN_Management();
		$PM = new Person_Management();
		
		// holt alle Module und die Namen dazu
		$res = $ModulM->getModullist();
		$modlist = $this->UM->checkManagerResults($res, "modul_id", "Module");
		// holt alle LN
		$res = $LNM->getLNList();
		$lnlist = $this->UM->checkManagerResults($res, "ln_id", "Leistungsnachweise");

		// füge die Infos sinnvoll zusammen
		foreach($lnlist as $var) {
			// LN_Examiner ist einer Personen-ID deswegen muss diese ausgetauscht werden!
			$id = $var['ln_examiner'];
			$res = $PM->getNameForID($id);
            $person = $this->UM->checkManagerResults($res, "id", "Personen");
			$LN[$var["ln_id"]]['ln_examiner'] = $person[$id]["vorname"]." ".$person[$id]["name"];
			
			// Falls es Vorraussetzungen gibt sind diese Modul-ID's und müssen daher ersetzt werden!
			if($var['ln_requirement']) {
				$LN[$var["ln_id"]]['ln_requirement'] = $modlist[$var["ln_requirement"]]["modul_name"];
			} else {
				$LN[$var["ln_id"]]['ln_requirement'] = "";
			}
			// Der Modulname wird in ein Neues Feld gespeichert
			$LN[$var["ln_id"]]['ln_modul_name'] = $modlist[$var['ln_modul_id']]['modul_name'];
			// Und zur sicherheit noch in das vorhandene ln_modul_id Feld damit der VO macher sich bei der Ausgabe ganz nach der Tabelle richten kann!
			// Nur das alle Daten magischer weise von der PO schon umgwandelt worden sind ;)
			$LN[$var["ln_id"]]['ln_modul_id'] = $modlist[$var['ln_modul_id']]['modul_name'];
			$LN[$var["ln_id"]]['ln_date'] = $var["ln_date"];
			$LN[$var["ln_id"]]['ln_id'] = $var['ln_id'];
		}
		//$this->UM->tpl->assign("LN", $LN); Gehört in das VO!
		$this->UM->VisualObject->showALL_LN_ForALLModul($LN);
	}
	// 1. Argument: Leistungsnachweis ID für die der User angemeldet werden soll
	function createLNA($LN_id)
	{
		// do some things
	}
}
?>