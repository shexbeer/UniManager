<?php
    class PO_LNA_show {
        function PO_LNA_show($UM)
        {
            //instanzierte Klasse UniManager klassenweit verfuegbar machen
            $this->UM= $UM;
        }
        function initform()
        {
        	$LNM = new LN_Management();
        	$ModM = new Modul_Management();
        	
        	$res = $LNM->getLNA_Person($_SESSION["user_id"]);
        	$lna = $this->UM->checkManagerResults($res,"lna_ln_id", "Leistungsnachweisanmeldungen");
        	
        	$res = $LNM->getLNlist();
        	$ln = $this->UM->checkManagerResults($res, "ln_id", "Leistungsnachweise");
			
			$res = $ModM->getModulList(true);
			$mod = $this->UM->checkManagerResults($res, "modul_id", "Module");
			
			if($lna) {
				foreach($lna as $var) {
					$id = $var["lna_id"];
					$data[$id]["lna_id"] = $id;
					$data[$id]["lna_registrationdate"] = $var["lna_registrationdate"];
					$data[$id]["lna_mark"] = $var["lna_mark"];
					$data[$id]["lna_modul_name"] = $mod[$ln[$var["lna_ln_id"]]["ln_modul_id"]]["modul_name"];
				}
			}
        	$this->UM->VisualObject->showLNA($data);
        }
    }
?>