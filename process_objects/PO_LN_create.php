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
		$res = $ModulM->getModullist(true);
		$modlist = $this->UM->checkManagerResults($res, "modul_id", "Module");
		// holt alle LN
		$res = $LNM->getLNList();
		//var_dump($res);
		$lnlist = $this->UM->checkManagerResults($res, "ln_id", "Leistungsnachweise");
		// hole alle Anmeldungen zu Leistungsnachweisen um Fehlerhafte Anmeldungen im vorfeld zu verhindern
		$res = $LNM->getLNA_Person($_SESSION["user_id"]);
		$lna = $this->UM->checkManagerResults($res, "lna_ln_id", "Leistungsnachweisanmeldungen");

		// füge die Infos sinnvoll zusammen
		foreach($lnlist as $var) {
			// LN_Examiner ist einer Personen-ID deswegen muss diese ausgetauscht werden!
			$id = $var['ln_examiner'];

			$res = $PM->getNameForID($id);
			
			$person = $res; //$this->UM->checkManagerResults($res, "id", "Personen");
			$LN[$var["ln_id"]]['ln_examiner'] = $person["vorname"]." ".$person["name"];
			
			// Falls es Vorraussetzungen gibt sind diese Modul-ID's und müssen daher ersetzt werden!
			if($var['ln_requirement'] && is_numeric($var['ln_requirement'])) {
				$LN[$var["ln_id"]]['ln_requirement'] = $modlist[$var["ln_requirement"]]["modul_name"];
			} else {
				$LN[$var["ln_id"]]['ln_requirement'] = $var['ln_requirement'];
			}
			// Der Modulname wird in ein Neues Feld gespeichert
			$LN[$var["ln_id"]]['ln_modul_name'] = $modlist[$var['ln_modul_id']]['modul_name'];
			// Und zur sicherheit noch in das vorhandene ln_modul_id Feld damit der VO macher sich bei der Ausgabe ganz nach der Tabelle richten kann!
			// Nur das alle Daten magischer weise von der PO schon umgwandelt worden sind ;)
			$LN[$var["ln_id"]]['ln_modul_id'] = $modlist[$var['ln_modul_id']]['modul_name'];
			$LN[$var["ln_id"]]['ln_date'] = $var["ln_date"];
			$LN[$var["ln_id"]]['ln_id'] = $var['ln_id'];
			if(is_array($lna[$var["ln_id"]]))
			{			
				$LN[$var["ln_id"]]["angemeldet"] = true; // bitte im VO auslesen und anmeldung dann verhindern
			}
		}
		$this->UM->VisualObject->showALL_LN_ForALLModul($LN);
	}
	// 1. Argument: Leistungsnachweis ID für die der User angemeldet werden soll
	function createLNA($LN_id)
	{
		$LNM = new LN_Management();
		
		$person_id = $_SESSION["user_id"];		
		// 1. Pruefen ob der Nutzer zu dieser LN schon eine Anmeldung hat!
		$res = $LNM->checkLNAforPersonID($person_id, $LN_id);
		if($res == true) {
			$this->UM->VisualObject->showResult(true, "Bereits zum Leistungsnachweis angemeldet");
		} else {
			$LNM->setLNA($person_id, $LN_id);
			$this->UM->VisualObject->showResult(false, "");			
		}
	}
}
?>